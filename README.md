# SARHSS PROJECT

This Laravel project has been successfully upgraded to **Laravel 12**.

## 🚀 Upgrade Summary

The project has been upgraded from Laravel 8 to Laravel 12 with the following major changes:

### Framework & Dependencies
- **Laravel Framework**: 8.x → 12.19.2
- **PHP Requirements**: ^7.3|^8.0 → ^8.2 (minimum PHP 8.2 required)
- **PHPUnit**: 9.x → 11.x
- **Vite**: Replaced Laravel Mix with Vite for asset compilation

### Frontend Changes
- **Asset Compilation**: Switched from Laravel Mix to Vite
- **Bootstrap**: Updated to Bootstrap 5.3.0
- **JavaScript**: Migrated from require() to ES6 imports
- **Fonts**: Changed from Google Fonts to Bunny Fonts for privacy

### Database & Migrations
- **Anonymous Migrations**: All migrations converted to anonymous class format
- **Password Resets**: Table renamed from `password_resets` to `password_reset_tokens`
- **Sessions**: Added database sessions support
- **Casts**: Updated to use the new `casts()` method format

### Middleware Updates
- **TrustProxies**: Updated to use Laravel's built-in middleware instead of fideloper/proxy
- **CORS**: Removed fruitcake/laravel-cors in favor of Laravel's built-in CORS
- **Middleware Aliases**: Updated `$routeMiddleware` to `$middlewareAliases`

### Code Quality
- **Laravel Pint**: Added for code formatting (replaces PHP CS Fixer)
- **Type Hints**: Added proper type hints throughout the codebase
- **DocBlock Updates**: Improved PHPDoc comments with proper types

## 📋 Requirements

- PHP 8.2 or higher
- Composer 2.x
- Node.js 18.x or higher
- SQLite (configured as default) or MySQL/PostgreSQL

## 🛠 Installation

1. **Install PHP dependencies:**
   ```bash
   composer install
   ```

2. **Install JavaScript dependencies:**
   ```bash
   npm install
   ```

3. **Environment setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup:**
   ```bash
   php artisan migrate
   ```

5. **Build assets:**
   ```bash
   npm run build    # For production
   npm run dev      # For development
   ```

## 🏃‍♂️ Development

- **Start development server:** `php artisan serve`
- **Watch assets:** `npm run dev`
- **Format code:** `./vendor/bin/pint`
- **Run tests:** `php artisan test`

## 🔒 Authentication

The default Laravel 8 Auth::routes() has been removed. To add authentication:

1. **Laravel Breeze** (recommended for simple auth):
   ```bash
   composer require laravel/breeze --dev
   php artisan breeze:install
   ```

2. **Laravel Jetstream** (for advanced features):
   ```bash
   composer require laravel/jetstream
   php artisan jetstream:install livewire
   ```

## 🧪 Testing

Run the test suite:
```bash
php artisan test
```

## 📦 New Features Available in Laravel 12

- Enhanced Eloquent features
- Improved validation rules
- Better queue handling
- Advanced Blade components
- Enhanced collections
- Improved debugging tools

---

*Project upgraded to Laravel 12 on June 17, 2025*