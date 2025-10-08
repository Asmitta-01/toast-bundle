# Templating

The bundle provides three(03) toast items templates actually:

- `@AsmittaToast/toast_items/default.html.twig` (Default)
- `@AsmittaToast/toast_items/with_icon.html.twig`
- `@AsmittaToast/toast_items/colored_icon.html.twig`

:warning: If you're using a template displaying icons, **you should include bootstrap icons package** in your view:

```html
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
```

You can create custom templates and specify their path here. Ensure your custom template accepts the following variables: `type`, `message`, `toast_type`, `timer`, `is_dismissible`, `show_progress_bar`(See [default template](../templates/toast_items/default.html.twig)).
