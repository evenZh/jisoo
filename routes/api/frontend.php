<?php



$api->group(['prefix' => '/frontend', 'namespace' => 'Frontend'], function ($api){

    $api->get('user/list', 'UserController@list');
    $api->get('banner/{id}', 'BannerController@getBanner');

    $api->group(['middleware' => 'auth:api'],  function($api) {

        //$api->post('auth/login', '');



    });

});



