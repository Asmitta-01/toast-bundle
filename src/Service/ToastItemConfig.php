<?php

namespace Asmitta\ToastBundle\Service;

class ToastItemConfig
{
    public function __construct(
        private int $timer,
        private bool $dismissible,
        private bool $showProgressBar,
        private string $template
    ) {}

    public function getTimer(): int
    {
        return $this->timer;
    }

    public function isDismissible(): bool
    {
        return $this->dismissible;
    }

    public function showProgressBar(): bool
    {
        return $this->showProgressBar;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }
}
