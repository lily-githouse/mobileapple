<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
\think\Route::resource('api/category','admin/category');
\think\Route::resource('api/upload','admin/upload');
\think\Route::resource('api/goods','admin/goods');


\think\Route::resource('api/index','index/index');
\think\Route::resource('api/cate','index/category');
\think\Route::resource('api/list1','index/list1');
\think\Route::resource('api/goodscate','index/goods');
\think\Route::resource('api/detail','index/detail');
\think\Route::resource('api/users','index/users');
\think\Route::resource('api/login','index/login');
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
