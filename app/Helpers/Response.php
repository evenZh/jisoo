<?php

/**
 * 接口返回格式
 */


/**
 * @param $code
 * @param null $msg
 * @param null $data
 * @return array
 */
function response_json($code, $msg = null, $data = null)
{
    $err_code = config('error.code');
    $response = [
        'code' => $code,
        'msg' => $msg ? $msg : (isset($err_code[$code]) ? $err_code[$code] : '未知错误'),
        'data' => $data
    ];

    return $response;
}

/**
 * @param null $msg 错误信息
 * @return array
 */
function response_fail($msg = null)
{
    return response_json(-1, $msg, null);
}

/**
 * @param null $data
 * @return array
 */
function response_success($data = null)
{
    return response_json(0, 'success', $data);
}




