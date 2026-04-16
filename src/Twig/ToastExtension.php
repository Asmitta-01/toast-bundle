<?php

namespace Asmitta\ToastBundle\Twig;

use Asmitta\ToastBundle\Enum\ToastPosition;
use Twig\Environment;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use Asmitta\ToastBundle\Enum\ToastType;
use Asmitta\ToastBundle\Service\ToastContainerConfig;
use Asmitta\ToastBundle\Service\ToastItemConfig;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\FlashBagAwareSessionInterface;

class ToastExtension extends AbstractExtension
{
    public function __construct(
        private RequestStack $requestStack,
        private Environment $twig,
        private ToastContainerConfig $toastContainerConfig,
        private ToastItemConfig $toastItemConfig
    ) {}

    public function getFunctions(): array
    {
        return [
            new TwigFunction('render_toasts', [$this, 'renderToasts'], ['is_safe' => ['html']]),
        ];
    }

    public function renderToasts(): string
    {
        $mainRequest = $this->requestStack->getMainRequest();
        if ($mainRequest === null || !$mainRequest->hasSession()) {
            return '';
        }

        $session = $mainRequest->getSession();
        /** @var FlashBagInterface $flashBag */
        $flashBag = $session instanceof FlashBagAwareSessionInterface
            ? $session->getFlashBag()
            : $session->getBag('flashes');
        $flashes = $flashBag->all();
        if (count($flashes) == 0) {
            return '';
        }

        if ($this->toastContainerConfig->getMaxToasts() !== null) {
            $flashes = array_map(function ($toasts) {
                return array_slice($toasts, 0, $this->toastContainerConfig->getMaxToasts());
            }, $flashes);
        }

        $toastTypes = [];
        foreach (array_keys($flashes) as $type) {
            $toastTypes[$type] = $this->mapFlashType($type)->value;
        }

        return $this->twig->render('@AsmittaToast/toast_container.html.twig', [
            'flashes' => $flashes,
            'toast_types' => $toastTypes,
            'position' => $this->mapToastPosition($this->toastContainerConfig->getPosition()),
            'timer' => $this->toastItemConfig->getTimer(),
            'is_dismissible' => $this->toastItemConfig->isDismissible(),
            'show_progress_bar' => $this->toastItemConfig->showProgressBar(),
            'template' => $this->toastItemConfig->getTemplate(),
        ]);
    }

    private function mapFlashType(string $type): ToastType
    {
        return match ($type) {
            'success' => ToastType::SUCCESS,
            'warning' => ToastType::WARNING,
            'error', 'danger' => ToastType::DANGER,
            default => ToastType::INFO,
        };
    }

    /**
     * Maps toast position enum to corresponding CSS classes for positioning
     * @param string $position The position value to map
     * @return string CSS classes for positioning the toast
     */
    private function mapToastPosition(string $position): string
    {
        $position = ToastPosition::from($position);
        return match ($position) {
            ToastPosition::TOP_LEFT => 'asmitta-top-0 asmitta-start-0',
            ToastPosition::TOP_RIGHT => 'asmitta-top-0 asmitta-end-0',
            ToastPosition::TOP_CENTER => 'asmitta-top-0 asmitta-start-50 asmitta-translate-middle-x',
            ToastPosition::BOTTOM_LEFT => 'asmitta-bottom-0 asmitta-start-0',
            ToastPosition::BOTTOM_RIGHT => 'asmitta-bottom-0 asmitta-end-0',
            ToastPosition::BOTTOM_CENTER => 'asmitta-bottom-0 asmitta-start-50 asmitta-translate-middle-x',
            ToastPosition::CENTER => 'asmitta-top-50 asmitta-start-50 asmitta-translate-middle',
        };
    }
}
