<?php


namespace app\common\model;


use think\Model;
use think\Db;

class Goods extends Model
{
//    protected $autoWriteTimestamp=true;
//添加商品
    public function insert($data)
    {
//    时间为0?---数据库字段类型错误
        $data['create_time'] = time();
        $data['update_time'] = time();
//        允许多添加表里没有的字段
        return $this->allowField(true)->save($data);
    }

//查看商品
    public function query()
    {
        return $this->select();
    }

//    删除商品
    public function del($id)
    {
        return $this->where('gid',$id)->delete();

    }

    //读取指定商品
    public function rea($id)
    {
        return $this->field('gname,gthumb,cid,gmprice,gsale,gdetail,gbanner,gsock,description,brand,status,norms')->where('gid', $id)->find();
    }

//    更新商品
    public function edit($data, $id)
    {
        return $this->allowField('gname,gthumb,cid,gmprice,gsale,gdetail,gbanner,gsock,description,brand,status,norms')->save($data, ['id' => $id]);
    }
}