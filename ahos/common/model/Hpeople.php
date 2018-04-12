<?php

namespace app\common\model;

use think\Loader;
use think\Model;
use think\Validate;
use think\Db;

class Hpeople extends Model
{
    protected $table = 'person';

    /*登录*/
    public function logins($data)
    {
        //1.执行验证
        $validate = Loader::validate('User');
        //如果验证不通过
        if (!$validate->check($data)) {
            return ['valid' => 0, 'msg' => $validate->getError()];
        }
        //2.比对用户名和密码是否正确
        $userInfo = $this->where('name', $data['admin_username'])->where('psw', $data['admin_password'])->find();
        //halt($userInfo);
        if (!$userInfo) {
            //说明在数据库未匹配到相关数据
            return ['valid' => 0, 'msg' => '用户名或者密码不正确'];
        }
        //3.将用户信息存入到session中
        session('admin.admin_username', $userInfo['name']);
        session('admin.id', $userInfo['per_id']);
        session('admin.dengji', $userInfo['dengji']);
        return ['valid' => 1, 'msg' => '登录成功'];
    }

    /*临聘所有人员*/
    public function linpgetall()
    {
        $postsList = Db::name('person')
            ->alias('a')
            ->join('htopkeshi b', 'b.ks_id= a.jigouid', 'LEFT')
            ->where('a.status', '<', 3)
            ->order('a.per_id desc')
            ->paginate(10);
        return $postsList;
    }

    /*查找临聘所有人员*/
    public function searchlinp($data)
    {
        $da = $data['searchname'];
        $allban = Db::name('person')
            ->alias('a')
            ->join('htopkeshi b', 'b.ks_id= a.jigouid', 'LEFT')
            ->where('status', '<', 3)
            ->where('name', 'like', "%$da%")
            ->paginate(10);
        return $allban;
    }

    /*正式员工*/
    public function zsgetall($data)
    {
        $allban = Db::name('person')
            ->alias('a')
            ->join('htopkeshi b', 'b.ks_id= a.jigouid', 'LEFT')
            ->where('status', '=', $data)
            ->paginate(10);

        return $allban;
    }

    /*查找单个信息*/
    public function findone($data)
    {
        $oneban = $this->where('per_id', $data)->find();//存储数据
        return $oneban;
    }

    /*存储人员信息*/
    public function saveone($data)
    {
        $oneban = $this->insertGetId($data);//存储数据
        return $oneban;
    }
    /*更新信息*/
    public function updateperson($data){
        $id=$data['id'];
        $upone= $this->where('per_id',$id)->strict(false)->update($data);
        return $upone;
    }
}