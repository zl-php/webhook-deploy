<?php
/**
 * User：zhoulei
 * File: WebhookDeployServiceProvider.php
 * Date: 2023/10/27 14:54
 * Email: <lei_0668@sina.com>
 */
namespace Zuogechengxu\Webhook\Deploy;

use Illuminate\Support\ServiceProvider;

class WebhookDeployServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (method_exists($this, 'publishes')) {
            $this->publishes([
                __DIR__ . '/config/webhook_deploy.php' => $this->config_path('webhook_deploy.php')
            ]);
        }
    }

    public function register(){}

    private function config_path($path = '')
    {
        return function_exists('config_path') ? config_path($path) : app()->basePath().DIRECTORY_SEPARATOR.'config'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}
