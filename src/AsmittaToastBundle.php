<?php

namespace Asmitta\ToastBundle;

use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

/**
 * @author Brayan Tiwa <tiwabrayan@gmail.com>
 * @copyright 2025 Brayan Tiwa 
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class AsmittaToastBundle extends AbstractBundle
{
    protected string $extensionAlias = 'asmitta_toast';

    public function getPath(): string
    {
        return dirname(__DIR__);
    }

    /**
     * @link See https://symfony.com/doc/current/bundles/configuration.html#using-the-abstractbundle-class
     */
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->import('../config/definition.php');
    }

    /**
     * @param mixed[] $config
     */
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.php');

        $container->services()
            ->get('asmitta_toast.toast_container')
            ->arg(0, $config['toast_container']['max_toasts'])
            ->arg(1, $config['toast_container']['position'])
            ->get('asmitta_toast.toast_item')
            ->arg(0, $config['toast_item']['timer'])
            ->arg(1, $config['toast_item']['dismissible'])
            ->arg(2, $config['toast_item']['progress_bar'])
        ;
    }
}
