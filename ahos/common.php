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
use app\common\model\Htopjia;

class Common extends Controller
{
    protected function _initialize(){
        if (!session('admin.admin_username')) {
            $this->redirect('index/login/login');
        }
        $this->nbar();
        $this->keshis();
        $this->message();
        $this->keshi();
    }
    /*左侧菜单栏选项*/
    protected function nbar(){
        $sessionid= session('admin.id');
        $permession = Db::name('hr_permission')
            ->where('ms_nameid',$sessionid)
            ->field('ms_content')
            ->find();
        $data = ($permession['ms_content']);
        $ss = explode(",",$data);
        if(in_array("*",$ss)){
            $postsList = Db::name('hr_leftmenu')
                ->where('pid', 0)
                ->order('weigh desc')
                ->select();
        }else{
            $postsList = Db::name('hr_leftmenu')
                ->where('pid', 0)
                ->where('id','in',$ss)
                ->order('weigh desc')
                ->select();
        }
        $acc=null;
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
    /*科室列表*/
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
    /*信息处理个数*/
    protected function message(){
        $tijiaojiacount = (new Htopjia())->tijiaojiacount();
        $needjiacount = (new Htopjia())->needjiacount();
        $endjiacount = (new Htopjia())->endjiacount();
        $refusejiacount = (new Htopjia())->refusejiacount();
        $xiaojiacount = (new Htopjia())->xiaojiacount();
        $this->assign('tijiaojiacount', $tijiaojiacount);
        $this->assign('needjiacount', $needjiacount);
        $this->assign('endjiacount', $endjiacount);
        $this->assign('refusejiacount', $refusejiacount);
        $this->assign('xiaojiacount', $xiaojiacount);
    }
    /*科室信息*/
    protected function keshi(){
        $ks_name = Db::name('htopkeshi')->where('ks_pid','<>','0')->field('ks_id,ks_name')->select();
        $this->assign("ks_name",$ks_name);
    }
}
// 应用公共文件