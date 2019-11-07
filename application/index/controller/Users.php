<?php

namespace app\index\controller;

use think\Controller;
use think\Exception;
use think\Request;

class Users extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
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
        //username password tel

        $data = $this->request->post();

        try {
            $res = model('Users')->queryusers(['tel' => $data['tel']]);
            if (count($res) > 0) {
                return json([
                    'code' => 404,
                    'msg' => '该手机号已注册',
                ]);
            }
            $res = model('Users')->queryusers(['username' => $data['username']]);
            if (count($res) > 0) {
                return json([
                    'code' => 404,
                    'msg' => '该用户名已注册',
                ]);
            }
//            $data['password'] = md5(crypt($data['password']), config('salt'));
//            $data['password'] =
            $result = model('Users')->ins($data);
            if ($result > 0) {
                return json([
                    'code' => config('code.success'),
                    'msg' => '用户注册成功'
                ]);
            } else {
                return json([
                    'code' => config('code.fail'),
                    'msg' => '注册失败'
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
