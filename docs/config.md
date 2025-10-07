# Configuration

## Setup

Create a configuration file at `config/packages/asmitta_toast.yaml`:

```yaml
asmitta_toast:
  toast_container:
    position: bottom-center
    max_toasts: null
  toast_item:
    timer: 5000
    progress_bar: false
    dismissible: true
```

## Configuration Options

### toast_container

**position** (string, default: `bottom-center`)

- Controls where toasts appear on screen
- Allowed values: `top-left`, `top-center`, `top-right`, `bottom-left`, `bottom-center`, `bottom-right`, `center`

**max_toasts** (integer|null, default: `null`)

- Limits the number of toasts displayed per type
- Set to `null` for unlimited toasts
- Example: `3` will show maximum 3 success toasts, 3 error toasts, etc.

### toast_item

**timer** (integer, default: `5000`)

- Auto-hide delay in milliseconds
- Set to `0` to disable auto-hide
- Example: `4000` = 4 seconds

**progress_bar** (boolean, default: `false`)

- Shows a progress bar indicating remaining time
- Only visible when `timer > 0`

**dismissible** (boolean, default: `true`)

- Adds a close button to manually dismiss toasts
- When `false`, toasts can only be dismissed by timer
