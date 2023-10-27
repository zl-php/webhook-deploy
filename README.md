Laravel webhook deploy
==================

## Install
Install via composer
```bash
composer require xxxx  #暂未发布
```

发布配置
```php
php artisan vendor:publish --provider="Zuogechengxu\Webhook\Deploy\WebhookDeployServiceProvider"
```

添加路由
```php 
use Zuogechengxu\Webhook\Deploy\Controllers\WebhookDeployController;

Route::post('deploy', [WebhookDeployController::class, 'deploy']);
```
