<?php


namespace app\admin\controller;


use think\Controller;
use think\Db;
use think\Exception;
use think\JWT;

class Login extends Controller
{
    public function index()
    {
        try {
            $data = $this->request->post();
            $salt = config('salt');
            $password = $data['password'];
            $data['password'] = md5(crypt($password, md5($salt)));
//            $data['password'] = md5($password);
            $res = Db::table('manager')->where($data)->find();

            if ($res) {
                $payload = ['id' => $res['id'], 'names' => $res['names']];
//            签发token
//            负载
                $token = JWT::getToken($payload, config('jwtkey'));
                return json([
                    'code' => config('code.success'),
                    'msg' => '登录成功',
                    'data' => [
                        'token' => $token,
                        'names' => $res['names']
                    ]
                ]);
            } else {
                return json([
                    'code' => config('code.fail'),
                    'msg' => '登录失败'
                ]);
            }
        } catch (Exception $exception) {
            return json([
                'code' => config('code.fail'),
                'msg' => '失败',
            ]);
        }

    }
}