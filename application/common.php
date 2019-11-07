<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\JWT;

// 应用公共文件

/**
 * 校验token
 * 1.接收到token
 *   header get post =>token
 *      1,1判断
 *          存在->验证；不存在->返回
 * 2.校验
 *  JWT::verify('','')
 *
 */
function checkToken()
{
    $token = request()->header('token');
    $getToken = request()->get('token');
    $postToken = request()->post('token');
    if ($getToken) {
        $getToken = request()->get('token');
    } else if ($postToken) {
        $postToken = request()->post('token');
    } else if ($token) {
        $token = request()->header('token');
    } else {
        json(['code' => 401, 'msg' => 'token不能为空'])->send();
        exit();
    }

    $result = JWT::verify($token, config('jwtkey'));
}
