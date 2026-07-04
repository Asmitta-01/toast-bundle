<?php

use Asmitta\ToastBundle\Service\ToastContainerConfig;
use Asmitta\ToastBundle\Service\ToastItemConfig;
use Asmitta\ToastBundle\Twig\ToastExtension;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;

return static function (ContainerConfigurator $container): void {
    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
        ->private();

    $services->load('Asmitta\\ToastBundle\\', '../src/')
        ->exclude([
            '../src/DependencyInjection/',
            '../src/Entity/',
            '../src/Kernel.php',
            '../src/Tests/',
        ]);

    $services->set('asmitta_toast.toast_container')
        ->class(ToastContainerConfig::class);

    $services->set('asmitta_toast.toast_item')
        ->class(ToastItemConfig::class);

    $services->set(ToastExtension::class)
        ->args([
            new Reference('request_stack'),
            new Reference('twig'),
            new Reference('asmitta_toast.toast_container'),
            new Reference('asmitta_toast.toast_item'),
            false,
        ])
        ->tag('twig.extension');

    $services->alias('asmitta_toast.twig.extension', ToastExtension::class);
};
