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
        $oneban = $this->save($data);
        return $oneban;
    }
    /*查找人员信息*/
    public function findall($data)
    {
        $da=date('Y-m-d', (time() - ((date('w') == 0 ? 7 : date('w')) + 14) * 24 * 3600));
        $oneban = $this->where('dk_nameid',$data)->where('dk_date','>',$da)->select();
        return $oneban;
    }
}