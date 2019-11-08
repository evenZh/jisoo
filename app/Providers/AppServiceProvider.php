<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Debug\Exception\FatalThrowableError;

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
                return response(response_json(401), 401);
            }

            // 参数校验失败
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                $msg = '参数错误';
                foreach ($exception->errors() as $key => $value) {
                    $msg = $value[0];
                    break;
                }
                return response(response_json(400, $msg), 400);
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
            return response(response_json(666), 200);

        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // sql打印
        if (env('APP_DEBUG') === true) {
            \DB::listen(function ($query) {
                \Log::channel('sql')->info($query->sql);
                \Log::channel('sql')->info($query->bindings);
                \Log::channel('sql')->info($query->time);
            });
        }
    }
}
