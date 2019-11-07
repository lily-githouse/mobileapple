<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;

class Goods extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = $this->request->get();
        $cid=$data['cid'];
//        $gsale=$data['gsale'];
        if (isset($data['page']) && !empty($data['page'])) {
            $page = $data['page'];
        } else {
            $page = 1;
        }
        if (isset($data['limit']) && !empty($data['limit'])) {
            $limit = $data['limit'];
        } else {
            $limit = 2;
        }
//        ->order('gsale',$gsale)
        $result = Db::table('goods')->where('cid',$cid)
            ->field('gid,gname,gthumb,gdetail,brand,norms,gmprice,gsale,description')
            ->paginate($limit, false, [   //每页条数，简单分页
                "page" => $page,

            ]);
        // 总数
        $count = $result->total();
        // 查询到的数据
        $goods = $result->items();
        if ($count > 0 && count($goods) > 0) {
            return json([
                'code' => config('code.success'),
                'data' => $goods,
                'total' => $count,
                'msg' => '商品获取成功'
            ]);
        } else {
            return json([
                'code' => config('code.success'),
                'msg' => '暂无数据'
            ]);
        }
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
