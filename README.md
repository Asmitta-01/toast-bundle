# ToastBundle

A Symfony bundle for displaying Bootstrap toast messages from flash messages.

## Installation

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Applications that use Symfony Flex

Open a command console, enter your project directory and execute:

```console
composer require asmitta-01/toast-bundle
```

## Configuration

Enable the bundle in `config/bundles.php`:

```php
return [
    // ...
    Asmitta\ToastBundle\AsmittaToastBundle::class => ['all' => true],
];
```

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

### 2. Include Bootstrap CSS and JS in your template

```html
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

- Automatic mapping of flash message types to Bootstrap toast variants
- Auto-hide after 5 seconds
- Positioned at top-right corner
- Responsive design
- No additional configuration required
