<?php
namespace app\index\controller;
use app\common\model\Htopmenu;
use app\common\model\Htoppaiban;
use app\common\model\Htopkeshi;
use think\Controller;
use think\Db;

class Jinshen extends Common
{
    /*晋升首页*/
    public function index(){
        $pos = Db::name('person')
            ->alias('a')
            ->join('htopkeshi b', 'b.ks_id= a.jigouid', 'LEFT')
            ->paginate(20);
        $this->assign('zs', $pos);
        return $this->fetch('index');
    }
}
