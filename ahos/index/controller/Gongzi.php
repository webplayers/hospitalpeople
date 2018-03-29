<?php
namespace app\index\controller;
use app\common\model\Htopmenu;
use app\common\model\Htoppaiban;
use app\common\model\Htopkeshi;
use think\Controller;

class Gongzi extends Common
{
    /*联系开发人员*/
    public function index(){
        return $this->fetch('index');
    }
}
