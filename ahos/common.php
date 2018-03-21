<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace app\index\controller;

use think\Controller;
use think\Lang;
use think\Request;
use think\Db;
class Common extends Controller
{
    protected function _initialize(){
        $this->nbar();
    }
    protected function nbar(){
        $this->assign('ab',"123");
    }
}
// 应用公共文件