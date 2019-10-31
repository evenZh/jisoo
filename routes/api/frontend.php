<?php



$api->group(['prefix' => '/frontend', 'namespace' => 'Frontend'], function ($api){

    $api->get('user/list', 'UserController@list');
    $api->post('token', 'UserController@token');

    $api->post('update', 'UserController@update');

    // banner
    $api->get('banner/{id}', 'BannerController@getBanner');
    $api->post('banner/list', 'BannerController@list');

    // 主题
    $api->get('theme/index', 'ThemeController@index');
    $api->get('theme/detail', 'ThemeController@detail');

    // 最近新品
    $api->get('product/recent', 'ProductController@recent');
    $api->get('product/update', 'ProductController@update');

    // 菜单
    $api->get('category/index', 'CategoryController@index');



    $api->group(['middleware' => 'auth:api'],  function($api) {






    });

});



