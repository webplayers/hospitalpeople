<?php
namespace app\index\controller;

use think\Controller;
use think\Request;

class Commons extends Controller
{

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        //执行登录验证
        if (!session('admin.admin_username')) {
            $this->redirect('index/login/login');
        }
    }
}