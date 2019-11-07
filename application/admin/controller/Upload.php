<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Validate;

class Upload extends Controller
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
        //
        $file = $request->file('file');
//        指定上传图片的大小为20k,
        $info = $file->validate(['size'=>20*1024,'ext'=>'webp,jpeg,jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        if ($info) {
//             拼接成绝对路径
            $savename = UPLOAD_PATH . $info->getSaveName();
            return json([
                'code' => config('code.success'),
                'msg' => '图片上传成功',
                'src' => $savename
            ]);
        } else {
            // 上传失败获取错误信息
            echo $file->getError();
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
