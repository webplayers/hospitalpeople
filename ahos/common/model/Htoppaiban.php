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
        $jigou = session('admin.jigouid');
        $dengji = session('admin.dengji');
        $adList = Db::name('htoppaiban')
            ->alias('a')
            ->join('person b', 'b.per_id= a.nameid', 'LEFT')
            ->join('htopkeshi c', 'c.ks_id= b.jigouid', 'LEFT')
            ->where('b.jigouid', $jigou)
            ->where('b.dengji', '<', $dengji)
            ->order('a.pb_id desc')
            ->paginate(5);
        return $adList;
    }

    public function findone($data)
    {
        $adList = Db::name('htoppaiban')
            ->alias('a')
            ->join('person b', 'b.per_id= a.nameid', 'LEFT')
            ->join('htopkeshi c', 'c.ks_id= b.jigouid', 'LEFT')
            ->where('a.nameid', $data)
            ->find();
        return $adList;
    }

    public function searchfindone($data)
    {
        $adList = Db::name('htoppaiban')
            ->alias('a')
            ->join('person b', 'b.per_id= a.nameid', 'LEFT')
            ->join('htopkeshi c', 'c.ks_id= b.jigouid', 'LEFT')
            ->where('b.name', 'like', "%$data%")
            ->order('a.pb_id desc')
            ->paginate();
        return $adList;
    }

    public function savepaiban($data)
    {
        $id = $data['nameid'];
        unset($data['nameid']);
        $one = $this->where('nameid', $id)->update($data);
        return $one;
    }

    public function savepeople($da)
    {
        $data['nameid'] = $da;
        $data['time1'] = '08:00-16:00';
        $data['ta1'] = '0';
        $data['ta2'] = '0';
        $data['ta3'] = '0';
        $data['ta4'] = '0';
        $data['ta5'] = '0';
        $data['ta6'] = '0';
        $data['ta7'] = '0';
        $data['time2'] = '16:00-24:00';
        $data['tb1'] = '0';
        $data['tb2'] = '0';
        $data['tb3'] = '0';
        $data['tb4'] = '0';
        $data['tb5'] = '0';
        $data['tb6'] = '0';
        $data['tb7'] = '0';
        $data['time3'] = '00:00-08:00';
        $data['tc1'] = '0';
        $data['tc2'] = '0';
        $data['tc3'] = '0';
        $data['tc4'] = '0';
        $data['tc5'] = '0';
        $data['tc6'] = '0';
        $data['tc7'] = '0';
        $one = $this->insert($data);
        return $one;
    }
}