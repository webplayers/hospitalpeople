<?php

namespace app\common\model;

use think\Loader;
use think\Model;
use think\Validate;

class Htopdaka extends Model
{
    protected $table = 'person_dk';

    /*存储人员信息*/
    public function saveone($data)
    {
        $oneban = $this->save($data);//存储数据
        return $oneban;
    }
    /*查找人员信息*/
    public function findall($data)
    {
        $oneban = $this->where('dk_nameid',$data)->select();//存储数据
        return $oneban;
    }
}