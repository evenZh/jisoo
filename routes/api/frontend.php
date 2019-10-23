<?php



$api->group(['prefix' => '/frontend', 'namespace' => 'Frontend'], function ($api){

    $api->get('user/list', 'UserController@list');
    $api->post('token', 'UserController@token');

    $api->post('update', 'UserController@update');


    $api->group(['middleware' => 'auth:api'],  function($api) {

        $api->get('banner/{id}', 'BannerController@getBanner');
        $api->post('banner/list', 'BannerController@list');




    });

});



