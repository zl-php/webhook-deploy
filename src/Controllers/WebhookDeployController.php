<?php
/**
 * User：zhoulei
 * File: WebhookDeployController.php
 * Date: 2023/10/27 15:42
 * Email: <lei_0668@sina.com>
 */

namespace Zuogechengxu\Webhook\Deploy\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class WebhookDeployController extends BaseController
{
    /**
     * @var array file
     */
    private $config;

    /**
     * @var string token
     */
    private $token = '';

    /**
     * @var string timestamp
     */
    private $timestamp = '';


    public function __construct()
    {
        $this->config = function_exists('config') ? config('webhook_deploy') : [];
    }


    public function deploy(Request $request)
    {
        // 验证 header
        $header = getallheaders();
        if (empty($header) || !is_array($header))
            $this->log('header参数不合法!');

        $this->token = trim($header['X-Gitee-Token']);
        $this->timestamp = trim($header['X-Gitee-Timestamp']);

        if ((time() - $this->timestamp) > 300)
            $this->log('header参数不合法');

        // 验签
        $this->verify();

        // 接收参数
        $param = $request->input();
        if (empty($param))
            $this->log('send fail');

        $project_path = $this->config['project_path'];
        if ($param['ref']=='refs/heads/master' && $param['total_commits_count'] > 0 && file_exists($project_path . "/.git")){
            exec("cd " . $project_path . " && git pull origin master" . " 2>&1", $output, $exit);
            $this->log($output);
        }
    }

    /**
     * @return void
     */
    private function verify()
    {
        $signStr = $this->timestamp . "\n" . $this->config['webhook_secret'];
        $hash = base64_encode(hash_hmac('sha256', $signStr,  $this->config['webhook_secret'], true));
        if (!hash_equals($this->token, $hash))
            $this->log("签名验证失败". "\n" . "gitee签名：" . $this->token . "\n" . "本地签名：" . $hash . "\n" . "签名串：". $signStr);
    }

    /**
     * @param $info
     * @return void
     */
    private function log($info)
    {
        Log::channel($this->config['log_channel'])->info($info);
        die();
    }
}
