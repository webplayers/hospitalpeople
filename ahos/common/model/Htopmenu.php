<?php

namespace app\common\model;

use think\Loader;
use think\Model;
use think\Validate;
class Htopmenu extends Model
{
    protected $pk = 'id';
    protected $table = 'htopmenu';
    public function getall()
    {
        $dengji=session('admin.dengji');
        $allnenu = $this->where('meu_dengji','<=',$dengji)->select();//存储数据
        return $allnenu;
    }
}