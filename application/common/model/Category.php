<?php


namespace app\common\model;


use think\Model;
use think\Db;

class Category extends Model

//protected $autowritet
{
//    插入分类
    public function insert($data)
    {
        $data['create_time'] = time();
        $data['update_time'] = time();
        return $this->allowField(true)->save($data);
    }

//    查看分类
    public function query()
    {
        return $this->select();
    }

//    删除分类
    public function del($id)
    {
        return $this->where('id', $id)->delete();
    }

//    读取指定分类
    public function rea($id)
    {
        return $this->field('id,cname,cthumb,csort')->where('id', $id)->find();
    }

//    编辑分类
    public function edit($data,$id)
    {
        return $this->allowField(['cname','cthumb','csort'])->save($data,['id'=>$id]);
    }


}