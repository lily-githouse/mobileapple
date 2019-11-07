<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Exception;
use think\Request;

class Index extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
//    分类  商品
//    数据格式  [{'id'=>,'cname'=>,'cthumb'=>,goods'=>[{商品信息}]}]
//    先拿到分类
        try {
            $cate = Db::table('category')->field('id,cname,cthumb')->order('id', 'asc')
                ->limit(0, 4)->select();
            $len = count($cate);
            //遍历商品
            if ($len) {
                for ($i = 0; $i < $len; $i++) {
                    $cid = $cate[$i]['id'];
                    $goods = Db::table('goods')->field('gid,gthumb,gmprice,gsale,gname,norms')->limit(0, 3)->where('cid', $cid)->select();
                    $cate[$i]['goods'] = $goods;
                }
                return json([
                    'code' => config('code.success'),
                    'msg' => '商品获取成功',
                    'data' => $cate,
                ]);
            } else {
                return json([
                    'code' => config('code.success'),
                    'msg' => '暂无商品'
                ]);
            }
        } catch (Exception $exception) {
            return json([
                'code' => config('code.fail'),
                'msg' => '服务器异常'
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
     * @param \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param \think\Request $request
     * @param int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
