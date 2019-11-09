<?php

/**
 * 校验ID参数
 * @param $id
 * @return bool
 */
function IdValidator($id)
{
    $data = [
        'id' => $id
    ];

    $validator = Validator::make($data, [
        'id' => 'integer|min:1'
    ]);

    if ($validator->fails()) {
        return false;
    } else {
        return true;
    }
}


function model_save($model, $map)
{
    foreach ($map as $k => $v) {
        $model[$k] = $v;
    }
    $model->save();

    return $model;
}

// 自定义分页
function custom_paginate($model, $page, $limit = 5)
{
    $start = $limit * ($page - 1);

    return $model->limit($limit)->offset($start)->get();
}






