<?php
namespace app\index\controller;
use app\common\model\Hpeople;
use think\Controller;
use think\Db;

class Login extends Controller
{
    public function login()
    {
        //测试数据库连接
        if (request()->isPost()) {
            $data = input('post.');
            $res = (new Hpeople())->logins($data);
            if ($res['valid']) {
                //说明登录成功
                echo 1;
                exit;
            } else {
                //说明登录失败
                echo $res['msg'];
                exit;
            }
        }
        //加载我们登录页面
        return $this->fetch('login');
    }
}
