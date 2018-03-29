<?php
namespace app\index\controller;
use app\common\model\Htopmenu;
use app\common\model\Htoppaiban;
use app\common\model\Htopkeshi;
use think\Controller;

class Shihuan extends Common
{
    /*事项环节*/
    public function index(){
        return $this->fetch('index');
    }
}
