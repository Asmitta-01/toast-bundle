<?php

namespace Asmitta\ToastBundle;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

/**
 * @author Brayan Tiwa <tiwabrayan@gmail.com>
 * @copyright 2025 Brayan Tiwa 
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class AsmittaToastBundle extends AbstractBundle implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
    }
}
