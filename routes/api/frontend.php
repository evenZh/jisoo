<?php



$api->group(['prefix' => '/frontend', 'namespace' => 'Frontend'], function ($api){

    $api->get('user/list', 'UserController@list');
    //$api->get('banner/{id}', 'BannerController@getBanner');
    $api->post('login', 'UserController@login');


    $api->group(['middleware' => 'api.auth'],  function($api) {

        $api->get('banner/{id}', 'BannerController@getBanner');




    });

});



