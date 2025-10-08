# ToastBundle

A Symfony bundle for displaying [Bootstrap toasts](https://getbootstrap.com/docs/5.3/components/toasts/) from flash messages.

## Installation

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Open a command console, enter your project directory and execute:

```console
composer require asmitta-01/toast-bundle
```

## Configuration

if your application dont't use Symfony Flex, enable the bundle in `config/bundles.php`:

```php
return [
    // ...
    Asmitta\ToastBundle\AsmittaToastBundle::class => ['all' => true],
];
```

Create a configuration file at `config/packages/asmitta_toast.yaml`.

## Resources

- [Configuration file](./config.md)
- [Templating](./templating.md)
