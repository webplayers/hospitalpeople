<?php
namespace app\index\controller;
use app\common\model\Htopmenu;
use app\common\model\Htoppaiban;
use app\common\model\Htopkeshi;
use think\Controller;

class Paiban extends Controller
{
    public function paiban()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $restban = (new Htoppaiban())->searchfindone($data['searchname']);
            $this->assign('ban', $restban);
        }else{
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
}
