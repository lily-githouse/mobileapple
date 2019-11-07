<?php

namespace app\admin\controller;

use think\Controller;
use think\Exception;
use think\Request;
use think\Db;

class Category extends Controller
{
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
        try {
            $res = model('Category')->query();
            if ($res) {
                return json([
                    'code' => config('code.success'),
                    'data' => $res
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
    public function create()
    {
        //
        echo 'create';
    }

    /**
     * 保存新建的资源
     *
     * @param \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //权限 身份
        //请求方式为post
        //验证发过来的参数
        $data = $this->request->post();
//        $validate = validate('Category');
//        //如果验证不通过
//        if (!$validate->scene('insert')->check($data)) {
//            return json([
//                'code' => config('code.fail'),
//                'msg' => $validate->getError()
//            ]);
//
//        }
//        return json([
//            'code' => config('code.success'),
//            'msg' => '分类添加成功'
//        ]);
        $model = model('Category');
        $result = $model->insert($data);
        if ($result > 0) {
            return json([
                'code' => config('code.success'),
                'msg' => '分类添加成功'
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '分类添加失败'
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
        $res = model('Category')->rea($id);
        if ($res) {
            return json([
                'code' => config('code.success'),
                'data' => $res
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
    public function edit($id)
    {
        //
        echo 'edit';
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
        $data=$this->request->put();
        $res = model('Category')->edit($data, $id);
        if ($res > 0) {
            return json([
                'code' => config('code.success'),
                'data' => $res,
                'msg' => '更新成功'
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
    public function delete($id)
    {
        //
        $res = model('Category')->del($id);
        if ($res > 0) {
            return json([
                'code' => config('code.success'),
                'msg' => '分类删除成功'
            ]);
        } else {
            return json([
                'code' => config('code.fail'),
                'msg' => '分类删除失败'
            ]);
        }
    }
}
