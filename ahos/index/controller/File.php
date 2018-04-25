<?php
namespace app\index\controller;
use app\common\model\Htopmenu;
use app\common\model\Htoppaiban;
use app\common\model\Htopkeshi;
use think\Controller;
use think\Db;

class File extends Common
{
    /*证照*/
    public function index(){
        return $this->fetch('index');
    }
}
