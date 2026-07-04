# Changelog

## 0.4.1

### Changed

- Automatic CSS/JS asset loading is now enabled by default through `render_toasts()`
- Added configuration option `auto_load_assets` (default: `true`) to opt out of automatic loading

### Fixed

- Removed duplicate toast initialization risk when scripts are included more than once

## 0.4.0

### Added

- Symfony 8 compatibility

### Changed

- Removed the Bootstrap CSS and JavaScript runtime dependency for toast rendering
- Toast markup and utility classes are now prefixed with `asmitta-`
- The root toast CSS class is now `asmitta-toast` instead of `toast`

### Fixed

- Flash bag access is now compatible with Symfony 8 session handling

## 0.3.1

Fixed

- Fallback defaults when config is missing during container build

## 0.3.0

Added

- Progress bar line in toasts
- Customizable toast items templates

## 0.2.0

Added

- Configurable toast positioning (7 positions)
- Customizable timer settings

## 0.1.0

Added

- Toast type enum (INFO, SUCCESS, WARNING, DANGER)
- Twig extension with `render_toasts()` function
- Bootstrap toast rendering from flash messages
