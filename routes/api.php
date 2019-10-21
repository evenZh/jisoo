<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
], function($api) {

    // 前端接口路由
    require __DIR__.'/api/frontend.php';


});
