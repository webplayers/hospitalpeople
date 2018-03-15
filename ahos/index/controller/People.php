<?php
namespace app\index\controller;

use app\common\model\Hpeople;
use app\common\model\Htopdaka;
use think\Controller;
use think\Db;

class People extends Controller
{
    public function lingpin()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $restkeshi = (new Hpeople())->searchlinp($data);
            $this->assign('linp', $restkeshi);
        } else {
            $restkeshi = (new Hpeople())->linpgetall();
            $this->assign('linp', $restkeshi);
        }
        return $this->fetch('lingpin');
    }

    public function form()
    {
        return $this->fetch('form');
    }

    /*正式员工*/
    public function people()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $dat = $data['tsearch'];
            $pos = Db::name('person')
                ->alias('a')
                ->join('htopkeshi b', 'b.ks_id= a.jigouid', 'LEFT')
                ->where('status', '3')
                ->where('name', 'like', "%$dat%")
                ->paginate(10);
            $this->assign('zs', $pos);
        } else {
            $restkeshi = (new Hpeople())->zsgetall("3");
            $this->assign('zs', $restkeshi);
        }
        return $this->fetch('people');
    }

    /*退休员工*/
    public function tuixiu()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $dat = $data['tsearch'];
            $pos = Db::name('person')->where('status', '4')->where('name', 'like', "%$dat%")->paginate(10);
            $this->assign('zs', $pos);
        } else {
            $restkeshi = (new Hpeople())->zsgetall("4");
            $this->assign('zs', $restkeshi);
        }
        return $this->fetch('tuixiu');
    }

    /*增加人员*/
    public function lingpientry()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $data['linpid'] = date("dHis") . rand(100, 999);
            $data['status'] = '1';
            $data['dengji'] = '0';
            $restkeshi = (new Hpeople())->saveone($data);
            if ($restkeshi) {
                echo 1;
                exit;
            } else {
                echo 0;
                exit;
            }
        }
        $restkeshi = Db::name('htopkeshi')->select();
        $this->assign('keshi', $restkeshi);
        return $this->fetch('lingpientry');
    }

    /*人员详情*/
    public function lingpindetail()
    {
        $par = input('param.user_id');
        $restkeshi = (new Hpeople())->findone($par);
        $restmenu = (new Htopdaka())->findall($par);
        $coun = count($restmenu);
        $coun1 = 21 - count($restmenu);
        $this->assign('cun', $coun);
        $this->assign('cun1', $coun1);
        $this->assign('shangban', $restmenu);
        $this->assign('people', $restkeshi);
        return $this->fetch('lingpindetail');
    }

    /*考勤统计*/
    public function kaoqingtongji()
    {
        $id = input('param.user_id');
//        $pos = Db::name('person_dk')->field('ks_name as label,ks_count as value,ks_color as color,ks_color as highlight')->select();
        $pos = Db::name('person_dk')->where('dk_nameid', $id)->field('dk_date as start,dk_dkname as title,dk_color as backgroundColor')->select();
        $poss = Db::name('Htopjia')->where('jia_st', '3')->where('nameid', $id)->field('startdata as start,enddata as end ,jiastatus as title')->select();
        $pingjie = array_merge($pos, $poss);
        $this->assign('kaoqing', json_encode($pingjie));
        $personone = Db::name('person')->where('per_id', $id)->find();
        $this->assign('person', $personone);
        return $this->fetch('kaoqingtongji');
    }

    /*完成实习*/
    public function wanchengshixi()
    {
//        $pos = Db::name('person_dk')->
    }

    /*转正式工*/
    public function zhuanshenshigong()
    {

    }

    /*正式员工编辑*/
    public function editpeople()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $restkeshi = (new Hpeople())->updateperson($data);
            if ($restkeshi) {
                echo 1;
                exit;
            } else {
                echo 0;
                exit;
            }
        }
        $id = input('param.user_id');
        $peopleone = (new Hpeople())->findone($id);
        $restkeshi = Db::name('htopkeshi')->select();
        $this->assign('keshi', $restkeshi);
        $this->assign('peopleone', $peopleone);
        return $this->fetch("editpeople");
    }
    /*工资*/
    public function gongzi()
    {
        $id = input('param.user_id');
        $peopleone = (new Hpeople())->findone($id);
        $this->assign('peopleone', $peopleone);
        return $this->fetch('gongzi');
    }
}
