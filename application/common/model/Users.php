<?php


namespace app\common\model;


use think\Model;

class Users extends Model
{
    protected $autoWriteTimestamp=true;
    public function ins($data){
        return $this->allowField(true)->save($data);

    }

    public function queryusers($where){
        return $this->where($where)->select();
    }

}