<?php
namespace app\index\controller;
use app\common\model\Htopmenu;
use app\common\model\Htoppaiban;
use app\common\model\Htopkeshi;
use think\Controller;

class Setting extends Controller
{
    /*联系开发人员*/
    public function lianxi(){
        return $this->fetch('lianxi');
    }
    /*问题上报*/
    public function quse(){
        return $this->fetch('quse');
    }
    /*关于我们*/
    public function aboutme(){
        return $this->fetch('aboutme');
    }
    /*改变密码*/
    public function changepsw(){
        return $this->fetch('changepsw');
    }
}
