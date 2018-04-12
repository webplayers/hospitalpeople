<?php
namespace app\index\controller;

use app\common\model\Htopkeshi;
use app\common\model\Htopmenu;
use app\common\model\Htopjia;
use app\common\model\Htopdaka;
use think\Controller;
use think\Db;


class Personal extends Common
{
    /*科室管理*/
    public function keshiguanli()
    {
        $restmenu = (new Htopmenu())->getall();
        $this->assign('menu', $restmenu);
        return $this->fetch('keshiguanli');
    }


    /*请休提交*/
    public function qingxiu()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $data['tijiaodata'] = date("Y-m-d h:i:sa");
            $restkeshi = (new Htopjia())->store($data);
            if ($restkeshi) {
                echo 1;
                exit;
            } else {
                echo 2;
                exit;
            }
        }
        return $this->fetch('qingxiu');
    }


    /*处理完成请休控制器*/
    public function qingxiurefuse()
    {
        $res = (new Htopjia())->refusejia();
        $this->assign('jia', $res);
        return $this->fetch('qingxiurefuse');
    }

    /*个人全部请休控制器*/
    public function shenpi()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $res = (new Htopjia())->peoplesearch($data);
            $this->assign('jia', $res);
        } else {
            $res = (new Htopjia())->alljiacount();
            $this->assign('jia', $res);
        }
        $id = session('admin.id');
        $restmenu = (new Htopdaka())->findall($id);
        $this->assign('shangban', $restmenu);
        $pos = Db::name('person_dk')->where('dk_nameid', $id)->field('dk_date as start,dk_dkname as title,dk_color as backgroundColor')->select();
        $poss = Db::name('Htopjia')->where('jia_st','in', '3,4')->where('nameid', $id)->field('startdata as start,enddata as end ,jiastatus as title')->select();
        $pingjie = array_merge($pos, $poss);
        $this->assign('kaoqing', json_encode($pingjie));

        return $this->fetch('shenpi');
    }


    /*送审控制器*/
    public function songshen()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $pos = Db::name('htopjia')->where('jia_id', $data['jiaid'])->update(["jia_st" => "2"]);
            if ($pos) {
                echo 1;
                exit;
            } else {
                echo 2;
                exit;
            }
        }
    }

    /*休假控制器*/
    public function xiujia()
    {
        return $this->fetch('xiujia');
    }

    /*出差控制器*/
    public function chuchai()
    {
        return $this->fetch('chuchai');
    }

    /*培训控制器*/
    public function peixun()
    {
        return $this->fetch('peixun');
    }

    /*加班控制器*/
    public function jiaban()
    {
        return $this->fetch('jiaban');
    }

    /*上班打卡*/
    public function daka()
    {
        $data['dk_nameid'] = session('admin.id');
        $data['dk_date'] = date("Y-m-d");
        $resone = $pos = Db::name('person_dk')->where('dk_nameid', session('admin.id'))->where('dk_date', date("Y-m-d"))->find();
        if ($resone) {
            echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
            echo "<script> alert('今日已打卡');history.back(-1); </script>";
        } else {
            $restmenu = (new Htopdaka())->save($data);
            if ($restmenu) {
                echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
                echo "<script> alert('打卡成功'); history.back(-1);</script>";
            } else {
                echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
                echo "<script> alert('打卡失败');history.back(-1); </script>";
            }
        }
        exit;
    }

    /*销假记录*/
    public function xiaojia()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $reson = Db::name('htopjia')->where('jia_id', $data['jiaid'])->field('jia_guochen')->find();
            $res = $reson['jia_guochen'] . "</br>3.销假成功，销假时间：" . date("Y-m-d H:i:s");
            $pos = Db::name('htopjia')->where('jia_id', $data['jiaid'])->update(["jia_st" => "4", "jia_guochen" => $res]);
            if ($pos) {
                echo 1;
                exit;
            } else {
                echo 2;
                exit;
            }
        }
        $nameid=session('admin.id');
        $xiao = Db::name('htopjia')
            ->alias('a')
            ->join('person b', 'b.per_id= a.nameid', 'LEFT')
            ->join('htopkeshi c','c.ks_id= b.jigouid','LEFT')
            ->where('a.jia_st', '4')
            ->where('a.nameid',"$nameid")
            ->order('a.jia_id desc')
            ->paginate(10);
        $res = Db::name('htopjia')
            ->alias('a')
            ->join('person b', 'b.per_id= a.nameid', 'LEFT')
            ->join('htopkeshi c','c.ks_id= b.jigouid','LEFT')
            ->where('a.jia_st', '3')
            ->where('a.nameid',"$nameid")
            ->order('a.jia_id desc')
            ->paginate(10);

        $this->assign('jia', $res);
        $this->assign('xiao', $xiao);
        return $this->fetch("xiaojia");
    }

    /*审批控制器*/
    public function shenpisee()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $dataid = $data['jiaid'];
            $adList = Db::name('htopjia')
                ->where('jia_id', "$dataid")
                ->find();
            if ($adList['jia_id']) {
                echo $adList['jia_guochen'];
                exit;
            } else {
                echo "错误查询";
                exit;
            }
        }
    }
}
