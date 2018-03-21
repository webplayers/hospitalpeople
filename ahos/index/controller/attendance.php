<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-03-19
 * Time: 下午 14:46
 */
namespace app\index\controller;
use app\common\model\Htopmenu;
use app\common\model\Htoppaiban;
use app\common\model\Htopkeshi;
use think\Controller;

class Attendance extends Commons
{
    public function index(){
        return $this->fetch('index');
    }
    public function test(){
        return $this->fetch('text');
    }
}