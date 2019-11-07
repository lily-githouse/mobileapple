<?php


namespace app\admin\validate;


use think\Validate;

class Category extends Validate
{
protected  $rule=[
    'cname'=>'require|min:2',
    'cthumb'=>'require',
    'csort'=>'require|number'
];
protected $message=[
    'cname.require'=>'cname字段必填',
    'cname.min'=>'cname字段最小2个字符',
    'cthumb'=>'cthumb字段必填'
];
protected $scene=[
    'insert'=>['cname','cthumb','csort'],
];
}