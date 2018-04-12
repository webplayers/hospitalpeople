<?php

namespace app\common\model;

use think\Loader;
use think\Model;
use think\Validate;
use think\Db;

class Htopjia extends Model
{
    protected $pk = 'id';
    protected $table = 'htopjia';

    /*存储请休假数据*/
    public function store($data)
    {
        if ($this->save($data)) {
            return 1;
        } else {
            return 0;
        }
    }

    /*提交请假的数据*/
    public function tijiaojia()
    {
        $adList = Db::name('htopjia')
            ->alias('a')
            ->join('person b', 'b.per_id= a.nameid', 'LEFT')
            ->join('htopkeshi c','c.ks_id= b.jigouid','LEFT')
            ->where('a.jia_st', '1')
            ->order('a.jia_id desc')
            ->paginate(10);
        return $adList;
    }

    /*提交请假的数据总数*/
    public function tijiaojiacount()
    {
        $account = Db::name('htopjia')->where('jia_st', '1')->count();
        return $account;
    }
    /*需要处理请假的数据*/
    public function needjia()
    {
        $adList = Db::name('htopjia')
            ->alias('a')
            ->join('person b', 'b.per_id= a.nameid', 'LEFT')
            ->join('htopkeshi c','c.ks_id= b.jigouid','LEFT')
            ->where('a.jia_st', '2')
            ->order('a.jia_id desc')
            ->paginate(10);
        return $adList;
    }

    /*需要处理请假的数据总数*/
    public function needjiacount()
    {
        $account = Db::name('htopjia')->where('jia_st', '2')->count();
        return $account;
    }
    /*处理完成请假的数据*/
    public function endjia()
    {
        $adList = Db::name('htopjia')
            ->alias('a')
            ->join('person b', 'b.per_id= a.nameid', 'LEFT')
            ->join('htopkeshi c','c.ks_id= b.jigouid','LEFT')
            ->where('a.jia_st', '3')
            ->order('a.jia_id desc')
            ->paginate(10);
        return $adList;
    }

    /*处理完成请假的数据*/
    public function xiaojia()
    {
        $adList = Db::name('htopjia')
            ->alias('a')
            ->join('person b', 'b.per_id= a.nameid', 'LEFT')
            ->join('htopkeshi c','c.ks_id= b.jigouid','LEFT')
            ->where('a.jia_st', '4')
            ->order('a.jia_id desc')
            ->paginate(10);
        return $adList;
    }
    /*未通过请假的数据*/
    public function refusejia()
    {
        $adList = Db::name('htopjia')
            ->alias('a')
            ->join('person b', 'b.per_id= a.nameid', 'LEFT')
            ->join('htopkeshi c','c.ks_id= b.jigouid','LEFT')
            ->where('a.jia_st', '0')
            ->order('a.jia_id desc')
            ->paginate(10);
        return $adList;
    }
    /*未通过请假的数据总数*/
    public function refusejiacount()
    {
        $account = Db::name('htopjia')->where('jia_st', '0')->count();
        return $account;
    }
    /*处理完成请假的数据总数*/
    public function endjiacount()
    {
        $account = Db::name('htopjia')->where('jia_st', '3')->count();
        return $account;
    }
    /*销假总数*/
    public function xiaojiacount()
    {
        $account = Db::name('htopjia')->where('jia_st', '4')->count();
        return $account;
    }
    /*个人请假总数*/
    public function alljiacount()
    {
        $nameid=session('admin.id');
        $adList = Db::name('htopjia')
            ->alias('a')
            ->join('person b','b.per_id= a.nameid','LEFT')
            ->where('a.nameid',"$nameid")
            ->join('htopkeshi c','c.ks_id= b.jigouid','LEFT')
            ->order('a.jia_id desc')
            ->paginate(5);
        return $adList;
    }
    /*更新请假信息假总数*/
    public function updatashenqing($data)
    {
        $reason="1.申请人提交申请<br>"."2.审批人:".session('admin.admin_username')."---审批时间:".date("Y-m-d H:i:s")."</br>附加说明:".$data['jia_guochen'];
        $adList=$this->where('jia_id', $data['jia_id'])->update(["jia_st" => $data['jia_st'],"jia_guochen"=>"$reason"]);
        return $adList;
    }
    /*个人信息查询筛选*/
    public function peoplesearch($data)
    {
        $startdata=$data['startdata'];
        $enddata=$data['enddata'];

        $nameid=session('admin.id');
        $adList = Db::name('htopjia')
            ->alias('a')
            ->join('person b','b.per_id= a.nameid','LEFT')
            ->join('htopkeshi c','c.ks_id= b.jigouid','LEFT')
            ->where('a.nameid',"$nameid")
            ->where('a.startdata','>',"$startdata")
            ->where('a.startdata','<',"$enddata")
            ->order('a.jia_id desc')
            ->paginate(5);
        return $adList;
    }
}