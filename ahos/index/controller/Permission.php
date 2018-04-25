<?php
namespace app\index\controller;
use think\Controller;
use app\common\model\Hpeople;
use app\common\model\Htoppaiban;
use app\common\model\Htopjia;
use app\common\model\Htopdaka;
use think\Db;

class Permission extends Common
{
    /*权限*/
    public function index(){
        $postsList = Db::name('person')
            ->alias('a')
            ->join('htopkeshi b', 'b.ks_id= a.jigouid', 'LEFT')
            ->where('a.status', '>', 5)
            ->order('a.per_id desc')
            ->paginate(10);
        $this->assign('guanli', $postsList);
        return $this->fetch('index');
    }
    /*编辑权限*/
    public function permission($selected = []){
        $nameid = input('param.user_id');
        if (request()->isPost()) {
            $data = input('post.');
            $datas= $data['data'];
            $ids = $data['id'];
            $nos = Db::name('hr_permission')->where('ms_nameid',$ids)->find();
            if($nos){
                $selected = Db::name('hr_permission')->where('ms_nameid',$ids)->update(['ms_content' => $datas]);
            }else{
                $selected=Db::name('hr_permission')->data(['ms_nameid'=>$ids,'ms_content'=>$datas])->insert();
            }
            echo $selected;
            exit;
        }
        $nodeList = [];
        $ruleList = Db::name('hr_leftmenu')->order('weigh desc')->select();
        $selected = Db::name('hr_permission')->where('ms_nameid',$nameid)->find();
        $se = explode(",",$selected['ms_content']);
        foreach ($ruleList as $k => $v)
        {
            $state = in_array($v['id'], $se);
            $nodeList[] = array('id' => $v['id'], 'pid' => $v['pid'],'parent' => $v['pid'] ? $v['pid'] : '#', 'text' => $v['title'], 'type' => 'menu', 'state' => $state);
        }
        $this->assign('quanxian', $nodeList);
        $this->assign('nameid', $nameid);
        return $this->fetch('permission');
    }
    /*增加管理人员*/
    public function addadmin(){
        if (request()->isPost()) {
            $data = input('post.');
            $data['linpid'] = date("dHis") . rand(100, 999);
            $data['status'] = '6';
            $restkeshi = (new Hpeople())->saveone($data);
            $paiban = (new Htoppaiban())->savepeople($restkeshi);
            if ($restkeshi&&$paiban) {
                echo 1;
                exit;
            } else {
                echo 0;
                exit;
            }
        }
        return $this->fetch('addadmin');
    }
}
