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
        if (!session('admin.admin_username')) {
            $this->redirect('index/login/login');
        }
        $this->nbar();
        $this->keshis();
    }
    protected function nbar(){
        $postsList = Db::name('hr_leftmenu')
            ->where('pid', 0)
            ->order('weigh desc')
            ->select();

        foreach ($postsList as $key => $value) {
            // 左侧菜单权限
            $left = Db::name('hr_leftmenu')->where('pid',$value['id'])->select();
            if($left){
                foreach ($left as $v) {
                    $acc[] = $v;
                }
            }
        }
        $this->assign("leftmenus",$postsList);
        $this->assign("leftzi",$acc);
    }
    protected function keshis()
    {
        $postsListz = Db::name('htopkeshi')
            ->where('ks_pid','0')
            ->select();

        foreach ($postsListz as $key => $value) {
            // 左侧菜单权限
            $left = Db::name('htopkeshi')->where('ks_pid',$value['ks_id'])->select();
            if($left){
                foreach ($left as $v) {
                    $acc[] = $v;
                }
            }
        }
        foreach ($acc as $key => $value) {
            // 左侧菜单权限
            $lefts = Db::name('htopkeshi')->where('ks_pid',$value['ks_id'])->select();
            if($lefts){
                foreach ($lefts as $vs) {
                    $gaa[] = $vs;
                }
            }
        }
        $this->assign("keshi",$postsListz);
        $this->assign("zkeshi",$acc);
        $this->assign("szkeshi",$gaa);
    }
}
// 应用公共文件