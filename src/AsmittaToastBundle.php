<?php

namespace Asmitta\ToastBundle;

use Asmitta\ToastBundle\Twig\ToastExtension;
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

        $autoLoadAssets = $config['auto_load_assets'] ?? true;
        $containerConfig = $config['toast_container'] ?? [];
        $itemConfig = $config['toast_item'] ?? [];

        $container->services()
            ->get(ToastExtension::class)
            ->arg('$autoLoadAssets', $autoLoadAssets)
            ->get('asmitta_toast.toast_container')
            ->arg(0, $containerConfig['max_toasts'] ?? null)
            ->arg(1, $containerConfig['position'] ?? 'bottom-center')
            ->get('asmitta_toast.toast_item')
            ->arg(0, $itemConfig['timer'] ?? 5000)
            ->arg(1, $itemConfig['dismissible'] ?? true)
            ->arg(2, $itemConfig['progress_bar'] ?? false)
            ->arg(3, $itemConfig['template'] ?? '@AsmittaToast/toast_items/default.html.twig')
        ;
    }
}
