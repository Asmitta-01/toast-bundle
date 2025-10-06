<?php

namespace Asmitta\ToastBundle\Twig;

use Twig\Environment;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use Asmitta\ToastBundle\Enum\ToastType;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class ToastExtension extends AbstractExtension
{
    private FlashBagInterface $flashBag;

    public function __construct(
        private RequestStack $requestStack,
        private Environment $twig
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
        if ($mainRequest === null) {
            return '';
        }

        $this->flashBag = $this->requestStack->getSession()->getBag('flashes');
        $flashes = $this->flashBag->all();
        if (count($flashes) == 0) {
            return '';
        }

        $toastTypes = [];
        foreach (array_keys($flashes) as $type) {
            $toastTypes[$type] = $this->mapFlashType($type)->value;
        }

        return $this->twig->render('@AsmittaToast/toast_container.html.twig', [
            'flashes' => $flashes,
            'toast_types' => $toastTypes,
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
}
