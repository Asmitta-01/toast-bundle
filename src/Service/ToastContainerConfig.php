<?php

namespace Asmitta\ToastBundle\Service;

class ToastContainerConfig
{
    public function __construct(
        private ?int $maxToasts,
        private string $position
    ) {}

    public function getMaxToasts(): ?int
    {
        return $this->maxToasts;
    }

    public function getPosition(): string
    {
        return $this->position;
    }
}
