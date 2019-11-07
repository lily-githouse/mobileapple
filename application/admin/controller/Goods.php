<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Exception;
use think\Request;

class Goods extends Controller

{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
//        将模型作为构造函数的一个属性，不用重复引入
//        $this->model=model('Goods');
    }

    protected function _initialize()
    {
        checkToken();
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {


//        连表查询
//        两次

//        分页
        try {
            $data = $this->request->get();

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
            //定义搜索数组，写搜索条件
            $sarr = [];
            if (isset($data['cid']) && !empty($data['cid'])) {
                $sarr['cid'] = $data['cid'];
            }
            if (isset($data['gname']) && !empty($data['gname'])) {
                $sarr['gname'] = ['like', '%' . $data['gname'] . '%'];
            }
            if (isset($data['min_price']) && !empty($data['min_price']) && isset($data['max_price']) && !empty($data['max_price']) && $data['min_price'] < $data['max_price']) {
                $sarr['gsale'] = [
                    'between', [$data['min_price'], [$data['max_price']]]
                ];
            }
//            写完搜索条件后在查询语句加上where
//            给goods表起别名g
            $result = Db::table('goods')->alias('g')->join('category', 'g.cid=category.id')
                ->field('g.gid,g.gname,g.gthumb,g.gdetail,g.gbanner,g.gsock,g.brand,g.norms,g.gmprice,g.gsale,g.description,category.cname')
                ->where($sarr)
                ->paginate($limit, false, [   //每页条数，简单分页
                    "page" => $page,
                ]);
            // 总数
            $count = $result->total();
            // 查询到的数据
            $goods = $result->items();

//            $model = model('Goods');
//            $res = $model->query();
            if ($count > 0 && count($goods) > 0) {
                return json([
                    'code' => config('code.success'),
                    'data' => $goods,
                    'count' => $count,
                    'msg' => '商品获取成功'
                ]);
            } else {
                return json([
                    'code' => config('code.success'),
                    'msg' => '暂无数据'
                ]);
            }
        } catch (Exception $exception) {
            return json([
                'code' => config('code.fail'),
                'msg' => '服务器错误，请联系管理员'
            ]);
        }
    }


    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public
    function create()
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
        //接收数据
        $data = $this->request->post();

        $res = model('Goods')->insert($data);
        if ($res > 0) {
            return json([
                'code' => config('code.success'),
                'msg' => '商品插入成功',
                'data' => $res
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '商品插入失败'
            ]);
        }
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
        $res = model('Goods')->rea($id);
        if ($res) {
            return json([
                'code' => config('code.success'),
                'data' => $res,
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
     * 显示编辑资源表单页.
     *
     * @param int $id
     * @return \think\Response
     */
    public
    function edit($id)
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
    public
    function update(Request $request, $id)
    {
        //
        $data = $this->request->put();
        $res = model('Goods')->edit($data, $id);
        if ($res > 0) {
            return json([
                'code' => config('code.success'),
                'data' => $res,
                'msg' => '商品更新成功'
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '更新失败'
            ]);
        }
    }

    /**
     * 删除指定资源
     *
     * @param int $id
     * @return \think\Response
     */
    public
    function delete($id)
    {
        //
        $res = model('Goods')->del($id);
        if ($res > 0) {
            return json([
                'code' => config('code.success'),
                'msg' => '商品删除成功',
                'data' => $res
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '商品删除失败'
            ]);
        }
    }
}
