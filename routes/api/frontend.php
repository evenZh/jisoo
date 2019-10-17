<?php



$api->group(['prefix' => '/frontend', 'namespace' => 'Frontend'], function ($api){

    $api->group(['middleware' => 'auth:api'],  function($api) {

        //$api->post('auth/login', '');



    });

});



