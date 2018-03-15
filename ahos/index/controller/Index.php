<?php
namespace app\index\controller;

use app\common\model\Hpeople;
use app\common\model\Htopkeshi;
use app\common\model\Htopmenu;
use app\common\model\Htopjia;
use app\common\model\Htopdaka;
use think\Controller;
use think\Db;
use PHPExcel_IOFactory;
use PHPExcel;


class Index extends Common
{
    /*主菜单*/
    public function index()
    {
        $restmenu = (new Htopmenu())->getall();
        $this->assign('menu', $restmenu);
        return $this->fetch('index');
    }

    /*岗位列表*/
    public function gangwei()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $restkeshi = (new Htopkeshi())->findone($data['likename']);
            $this->assign('keshi', $restkeshi);
        } else {
            $restkeshi = (new Htopkeshi())->getall();
            $this->assign('keshi', $restkeshi);
        }
        $possun = Db::name('htopkeshi')->sum('ks_count');
        $this->assign('kssum', $possun);
        $pos = Db::name('htopkeshi')->field('ks_name as label,ks_count as value,ks_color as color,ks_color as highlight')->select();
        $this->assign('yuan', json_encode($pos));
        return $this->fetch('gangwei');
    }

    /*增加岗位*/
    public function form()
    {
        return $this->fetch('form');
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

    /*提交请休控制器*/
    public function formqingxiu()
    {
        $tijiaojiacount = (new Htopjia())->tijiaojiacount();
        $needjiacount = (new Htopjia())->needjiacount();
        $endjiacount = (new Htopjia())->endjiacount();
        $refusejiacount = (new Htopjia())->refusejiacount();
        $xiaojiacount = (new Htopjia())->xiaojiacount();
        $this->assign('tijiaojiacount', $tijiaojiacount);
        $this->assign('needjiacount', $needjiacount);
        $this->assign('endjiacount', $endjiacount);
        $this->assign('refusejiacount', $refusejiacount);
        $this->assign('xiaojiacount', $xiaojiacount);

        $res = (new Htopjia())->tijiaojia();
        $this->assign('jia', $res);
        return $this->fetch('formqingxiu');
    }

    /*需要处理请休控制器*/
    public function qingxiuneed()
    {
        $tijiaojiacount = (new Htopjia())->tijiaojiacount();
        $needjiacount = (new Htopjia())->needjiacount();
        $endjiacount = (new Htopjia())->endjiacount();
        $refusejiacount = (new Htopjia())->refusejiacount();
        $xiaojiacount = (new Htopjia())->xiaojiacount();
        $this->assign('tijiaojiacount', $tijiaojiacount);
        $this->assign('needjiacount', $needjiacount);
        $this->assign('endjiacount', $endjiacount);
        $this->assign('refusejiacount', $refusejiacount);
        $this->assign('xiaojiacount', $xiaojiacount);

        $res = (new Htopjia())->needjia();
        $this->assign('jia', $res);
        return $this->fetch('qingxiuneed');
    }

    /*处理完成请休控制器*/
    public function qingxiuend()
    {
        $tijiaojiacount = (new Htopjia())->tijiaojiacount();
        $needjiacount = (new Htopjia())->needjiacount();
        $endjiacount = (new Htopjia())->endjiacount();
        $refusejiacount = (new Htopjia())->refusejiacount();
        $xiaojiacount = (new Htopjia())->xiaojiacount();
        $this->assign('tijiaojiacount', $tijiaojiacount);
        $this->assign('needjiacount', $needjiacount);
        $this->assign('endjiacount', $endjiacount);
        $this->assign('refusejiacount', $refusejiacount);
        $this->assign('xiaojiacount', $xiaojiacount);

        $res = (new Htopjia())->endjia();
        $this->assign('jia', $res);
        return $this->fetch('qingxiuend');
    }
/*销假请休控制器*/
    public function qingxiuxiaojia(){
        $tijiaojiacount = (new Htopjia())->tijiaojiacount();
        $needjiacount = (new Htopjia())->needjiacount();
        $endjiacount = (new Htopjia())->endjiacount();
        $refusejiacount = (new Htopjia())->refusejiacount();
        $xiaojiacount = (new Htopjia())->xiaojiacount();
        $this->assign('tijiaojiacount', $tijiaojiacount);
        $this->assign('needjiacount', $needjiacount);
        $this->assign('endjiacount', $endjiacount);
        $this->assign('refusejiacount', $refusejiacount);
        $this->assign('xiaojiacount', $xiaojiacount);

        $res = (new Htopjia())->xiaojia();
        $this->assign('jia', $res);
        return $this->fetch('qingxiuxiaojia');
    }
    /*处理完成请休控制器*/
    public function qingxiurefuse()
    {
        $tijiaojiacount = (new Htopjia())->tijiaojiacount();
        $needjiacount = (new Htopjia())->needjiacount();
        $endjiacount = (new Htopjia())->endjiacount();
        $refusejiacount = (new Htopjia())->refusejiacount();
        $xiaojiacount = (new Htopjia())->xiaojiacount();
        $this->assign('tijiaojiacount', $tijiaojiacount);
        $this->assign('needjiacount', $needjiacount);
        $this->assign('endjiacount', $endjiacount);
        $this->assign('refusejiacount', $refusejiacount);
        $this->assign('xiaojiacount', $xiaojiacount);

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
        $par = session('admin.id');
        $id = session('admin.id');
        $restmenu = (new Htopdaka())->findall($par);
        $this->assign('shangban', $restmenu);
        $pos = Db::name('person_dk')->where('dk_nameid', $id)->field('dk_date as start,dk_dkname as title,dk_color as backgroundColor')->select();
        $poss = Db::name('Htopjia')->where('jia_st', '3')->where('nameid', $id)->field('startdata as start,enddata as end ,jiastatus as title')->select();
        $pingjie = array_merge($pos, $poss);
        $this->assign('kaoqing', json_encode($pingjie));

        return $this->fetch('shenpi');
    }

    /*审批控制器*/
    public function shenpiname()
    {
        $tijiaojiacount = (new Htopjia())->tijiaojiacount();
        $needjiacount = (new Htopjia())->needjiacount();
        $endjiacount = (new Htopjia())->endjiacount();
        $refusejiacount = (new Htopjia())->refusejiacount();
        $xiaojiacount = (new Htopjia())->xiaojiacount();
        $this->assign('tijiaojiacount', $tijiaojiacount);
        $this->assign('needjiacount', $needjiacount);
        $this->assign('endjiacount', $endjiacount);
        $this->assign('refusejiacount', $refusejiacount);
        $this->assign('xiaojiacount', $xiaojiacount);

        if (request()->isPost()) {
            $data = input('post.');
            $res = (new Htopjia())->updatashenqing($data);
            if ($res) {
                echo 1;
                exit;
            } else {
                echo 2;
                exit;
            }
        }
        $pmt_id = input('param.pmt_id');
        $this->assign('jia_id', $pmt_id);
        return $this->fetch('shenpiname');
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
            echo "<script> alert('今日已打卡');parent.location.href='index/index/index'; </script>";
        } else {
            $restmenu = (new Htopdaka())->save($data);
            if ($restmenu) {
                echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
                echo "<script> alert('打卡成功');parent.location.href='index/index/index'; </script>";
            } else {
                echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
                echo "<script> alert('打卡失败');parent.location.href='index/index/index'; </script>";
            }
        }
        exit;
    }

    /*销假记录*/
    public function xiaojia()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $reson = Db::name('htopjia')->where('jia_id', 20)->field('jia_guochen')->find();
            $res=$reson['jia_guochen']."</br>3.销假成功，销假时间：".date("Y-m-d H:i:s");
            $pos = Db::name('htopjia')->where('jia_id', $data['jiaid'])->update(["jia_st" => "4","jia_guochen"=>$res]);
            if ($pos) {
                echo 1;
                exit;
            } else {
                echo 2;
                exit;
            }
        }
        $res = (new Htopjia())->endjia();
        $xiao = (new Htopjia())->xiaojia();
        $this->assign('jia', $res);
        $this->assign('xiao', $xiao);
        return $this->fetch("xiaojia");
    }
}
