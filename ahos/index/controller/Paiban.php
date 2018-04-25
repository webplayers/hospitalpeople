<?php
namespace app\index\controller;

use app\common\model\Htopmenu;
use app\common\model\Htoppaiban;
use app\common\model\Htopkeshi;
use think\Controller;
use think\Db;

class Paiban extends Common
{
    public function paiban()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $searchname = $data['searchname'];
            $restban = (new Htoppaiban())->searchfindone($searchname);
            $this->assign('ban', $restban);
        } else {
            $restban = (new Htoppaiban())->getall();
            $this->assign('ban', $restban);
        }
        return $this->fetch('paiban');
    }

    public function dpaiban()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $restban = (new Htoppaiban())->savepaiban($data);
            echo $restban;
            exit;
        }
        $pmt_id = input('param.name');
        $restban = (new Htoppaiban())->findone($pmt_id);
        $this->assign('pban', $restban);
        return $this->fetch('dpaiban');
    }

    public function testsave()
    {
        $data['time1'] = '08:00-16:00';
        $data['ta1'] = '0';
        $data['ta2'] = '0';
        $data['ta3'] = '0';
        $data['ta4'] = '0';
        $data['ta5'] = '0';
        $data['ta6'] = '0';
        $data['ta7'] = '0';
        $data['time2'] = '16:00-24:00';
        $data['tb1'] = '0';
        $data['tb2'] = '0';
        $data['tb3'] = '0';
        $data['tb4'] = '0';
        $data['tb5'] = '0';
        $data['tb6'] = '0';
        $data['tb7'] = '0';
        $data['time3'] = '00:00-08:00';
        $data['tc1'] = '0';
        $data['tc2'] = '0';
        $data['tc3'] = '0';
        $data['tc4'] = '0';
        $data['tc5'] = '0';
        $data['tc6'] = '0';
        $data['tc7'] = '0';
//        $adLists = Db::name('person')->select();
//        foreach ($adLists as $key => $value) {
//            $data['nameid']=$value['per_id'];
//            $da = Db::name('htoppaiban')->insert($data);
//            var_dump($da);
//        }
    }

}
