<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // api异常处理
        app('Dingo\Api\Exception\Handler')->register(function (\Exception $exception) {

            // 打印错误日志
            \Log::error($exception);

            // 用户认证异常
            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return response(response_json(401), 200);
            }

            // 参数校验失败
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                $msg = '参数错误';
                foreach ($exception->errors() as $key => $value) {
                    $msg = $value[0];
                    break;
                }
                return response(response_json(200, $msg), 200);
            }

            // dingo问题 路由不存在，自定义返回200，报错
            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                return response(response_json(404), 404);
            }

            // dingo异常
            if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {

                $status_code = $exception->getStatusCode();
                if ($status_code == 422) {
                    $msg = '参数错误';
                    foreach (json_decode($exception->getErrors()) as $key => $value) {
                        $msg = $value[0];
                        break;
                    }
                    return response(response_json($status_code, $msg), 200);
                }

                return response(response_json($status_code), 200);
            }

            //其他异常
            return response(response_json(500), 200);

        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
