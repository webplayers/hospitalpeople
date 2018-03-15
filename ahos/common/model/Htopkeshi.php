<?php

namespace app\common\model;

use think\Loader;
use think\Model;
use think\Validate;
class Htopkeshi extends Model
{
    protected $pk = 'ks_id';
    protected $table = 'htopkeshi';
    public function getall()
    {
        $allnenu = $this->paginate(10);//存储数据
        return $allnenu;
    }
    public function findone($data)
    {
        $allnenu = $this->where('ks_name','like',"%$data%")->paginate(10);//存储数据
        return $allnenu;
    }
}