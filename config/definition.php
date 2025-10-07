<?php

use Asmitta\ToastBundle\Enum\ToastPosition;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;

// @formatter:off
return static function (DefinitionConfigurator $definition): void {
    $definition->rootNode()
        ->children()
            ->arrayNode('toast_container')
                ->children()
                    ->integerNode('max_toasts')->defaultNull()->end()
                    ->stringNode('position')
                        ->defaultValue(ToastPosition::BOTTOM_CENTER->value)
                        ->validate()
                            ->ifTrue(fn($value) => ToastPosition::tryFrom($value) === null)
                            ->thenInvalid('Invalid toast position "%s". Allowed positions are: ' . join(', ', ToastPosition::values()))
                        ->end()
                    ->end()
                ->end()
            ->end()
            ->arrayNode('toast_item')
                ->children()
                    ->integerNode('timer')->defaultValue(5000)->end()
                    ->booleanNode('dismissible')->defaultTrue()->end()
                    ->booleanNode('progress_bar')->defaultFalse()->end()
                ->end()
            ->end()
        ->end()
    ;
};
