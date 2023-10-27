<?php
/**
 * User：zhoulei
 * File: webhook_deploy.php
 * Date: 2023/10/27 15:01
 * Email: <lei_0668@sina.com>
 */
return [
    /*
    |--------------------------------------------------------------------------
    | WEBHOOK DEPLOY CONFIG
    |--------------------------------------------------------------------------
    |
    */

    'webhook_secret'=> '',
    'project_path'  => '/data/www',
    'log_channel'  => env('WEBHOOK_DEPLOY_LOG_CHANNEL', 'daily'),
];
