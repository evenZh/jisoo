<?php



$api->group(['prefix' => '/frontend', 'namespace' => 'Frontend'], function ($api){

    $api->get('user/list', 'UserController@list');
    $api->post('token', 'UserController@token');

    $api->post('update', 'UserController@update');

    // banner
    $api->get('banner/test', 'BannerController@test');

    $api->get('banner/{id}', 'BannerController@getBanner');

    // 主题
    $api->get('theme/index', 'ThemeController@index');
    $api->get('theme/detail', 'ThemeController@detail');

    // 商品
    $api->get('product/recent', 'ProductController@recent');
    $api->get('product/getAllInCategory', 'ProductController@getAllInCategory');
    $api->get('product/detail', 'ProductController@detail');


    // 菜单
    $api->get('category/index', 'CategoryController@index');

    $api->post('wechat/token', 'UserController@wechatToken');

    // 用户地址
    $api->post('user/address', 'UserAddressController@createOrUpdate');

    // 订单
    $api->post('order/create', 'OrderController@create');


    $api->group(['middleware' => 'auth:api'],  function($api) {






    });

});



