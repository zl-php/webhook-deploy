Laravel log viewer
==================

## Install (Laravel)
Install via composer
```bash
composer require rap2hpoutre/laravel-log-viewer
```

Add Service Provider to `config/app.php` in `providers` section
```php
Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider::class,
```

Add a route in your web routes file:
```php 
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
```
