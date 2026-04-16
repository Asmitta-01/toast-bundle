# ToastBundle

[![Static Analysis](https://github.com/Asmitta-01/toast-bundle/actions/workflows/static-analysis.yml/badge.svg)](https://github.com/Asmitta-01/toast-bundle/actions/workflows/static-analysis.yml)

A Symfony bundle for displaying toast notifications from flash messages, with no Bootstrap CSS or JavaScript dependency.

## Installation

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Open a command console, enter your project directory and execute:

```console
composer require asmitta-01/toast-bundle
```

The bundle is compatible with Symfony 6, 7 and 8.

If your application exposes bundle assets through the public directory, install them after requiring the package:

```console
php bin/console assets:install
```

## Configuration

If your application doesn't use Symfony Flex, enable the bundle in `config/bundles.php`:

```php
return [
    // ...
    Asmitta\ToastBundle\AsmittaToastBundle::class => ['all' => true],
];
```

Create a configuration file at `config/packages/asmitta_toast.yaml`, see [docs/config.md](./docs/config.md).

## Usage

### 1. Add flash messages in your controller

```php
use Asmitta\ToastBundle\Enum\ToastType;

public function someAction(Request $request): Response
{
    $this->addFlash('success', 'Operation completed successfully!'); // 'success' or ToastType::SUCCESS->value
    $this->addFlash('warning', 'Please check your input.');
    $this->addFlash('error', 'Something went wrong.');
    $this->addFlash('info', 'Here is some information.');
    
    return $this->render('your_template.html.twig');
}
```

### 2. Include the bundle CSS assets in your template

```html
<link href="{{ asset('bundles/asmittaToast/css/toast.css') }}" rel="stylesheet">
<link href="{{ asset('bundles/asmittaToast/css/spacing.css') }}" rel="stylesheet">
```

If you use the progress bar option, also include:

```html
<link href="{{ asset('bundles/asmittaToast/css/toast-progress-bar.css') }}" rel="stylesheet">
```

The bundle ships its own toast behavior, so no Bootstrap JavaScript include is required.

If you use the `with_icon` or `colored_icon` templates, include Bootstrap Icons in your page:

```html
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
```

### 3. Add the toast function to your template

```twig
{{ render_toasts() }}
```

## Toast Types

The bundle supports these flash message types:

- `success` → Green toast
- `warning` → Yellow toast  
- `error` or `danger` → Red toast
- `info` (default) → Light Blue toast

## Features

- Automatic mapping of flash message types to toast variants
- Configurable auto-hide timer (default: 5 seconds)
- Flexible positioning (7 positions available, see [ToastPosition Enum](./src/Enum/ToastPosition.php))
- Limit maximum toasts per type
- Optional progress bar showing remaining time
- Dismissible toasts with close button
- Responsive design
- Twig template-based rendering
- Full configuration support
- No Bootstrap CSS or JavaScript dependency
- Symfony 6, 7 and 8 compatibility

## Breaking Changes In 0.4.0

- The root toast class changed from `toast` to `asmitta-toast`
- Bootstrap toast classes and utility classes were replaced by `asmitta-` prefixed classes
- Bootstrap JavaScript is no longer used or required for rendering toasts
