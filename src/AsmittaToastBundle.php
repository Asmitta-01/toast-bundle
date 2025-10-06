<?php

namespace Asmitta\ToastBundle;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Brayan Tiwa <tiwabrayan@gmail.com>
 * @copyright 2025 Brayan Tiwa 
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class AsmittaToastBundle extends Bundle implements CompilerPassInterface
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }

    public function process(ContainerBuilder $container): void
    {
    }
}
