<?php


namespace app\admin\validate;


use think\Validate;

class Goods extends Validate
{
protected  $rule=[
    'gname'=>'require|min:2',
    'gthumb'=>'require',
    'cid'=>'require',
    'gmprice'=>'require',
    'gsale'=>'require',
    'gsock'=>'require',
    'gdetail'=>'require',
    'gbanner'=>'require',

];
protected $message=[
    'gname.require'=>'gname字段必填',
    'gname.min'=>'gname字段最小2个字符',
    'gthumb'=>'gthumb字段必填'
];
protected $scene=[
    'insert'=>['gname','gthumb','cid','gmprice','gsale','gsock','gdetail','gbanner'],
];
}