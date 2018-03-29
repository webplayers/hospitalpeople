<?php
namespace app\index\controller;
use app\common\model\Htopmenu;
use app\common\model\Htoppaiban;
use app\common\model\Htopkeshi;
use think\Controller;

class Retire extends Common
{
    /*退休首页*/
    public function index(){
        return $this->fetch('index');
    }
}
