<?php

namespace app\common\model;

use think\Loader;
use think\Model;
use think\Validate;
use think\Db;

class Htoppaiban extends Model
{
    protected $table = 'htoppaiban';

    public function getall()
    {
        $adList = Db::name('htoppaiban')
            ->alias('a')
            ->join('person b', 'b.per_id= a.nameid', 'LEFT')
            ->join('htopkeshi c','c.ks_id= b.jigouid','LEFT')
            ->order('a.pb_id desc')
            ->paginate(5);
        return $adList;
    }

    public function findone($data)
    {
        $adList = Db::name('htoppaiban')
            ->alias('a')
            ->join('person b', 'b.per_id= a.nameid', 'LEFT')
            ->join('htopkeshi c','c.ks_id= b.jigouid','LEFT')
            ->where('a.nameid', $data)
            ->find();
        return $adList;
    }

    public function searchfindone($data)
    {
        $adList = Db::name('htoppaiban')
            ->alias('a')
            ->join('person b', 'b.per_id= a.nameid', 'LEFT')
            ->join('htopkeshi c','c.ks_id= b.jigouid','LEFT')
            ->where('b.name', 'like', "%$data%")
            ->order('a.pb_id desc')
            ->paginate();
        return $adList;
    }

    public function savepaiban($data)
    {
        $id=$data['nameid'];
        unset($data['nameid']);
        $one=$this->where('nameid',$id)->update($data);
        return $one;
    }
}