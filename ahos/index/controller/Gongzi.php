<?php
namespace app\index\controller;

use app\common\model\Htopmenu;
use app\common\model\Htoppaiban;
use app\common\model\Htopkeshi;
use think\Controller;
use think\Db;

class Gongzi extends Common
{
    /*联系开发人员*/
    public function index()
    {
        $par = session('admin.id');
        $ke = null;
        $gongzi = Db::name('hr_wages')
            ->alias('a')
            ->join('person b', 'b.per_id= a.wg_pid', 'LEFT')
            ->where('a.wg_pid', $par)
            ->order('a.wg_id desc')
            ->select();
        $this->assign('gongzi', $gongzi);
        $year = Db::name('hr_wages')->field('wg_year')->Distinct(true)->select();
        foreach ($year as $key => $valueyear) {
            $per = Db::name('person')->where('per_id', $par)->field('name,xueli,linpid')->find();
            $linpid = $per['linpid'];
            $name = $per['name'];
            $zhicheng = $per['xueli'];
            $ye = $valueyear['wg_year'];
            $data[$ye]['wg_year'] = $ye;
            $data[$ye]['linpid'] = $linpid;
            $data[$ye]['name'] = $name;
            $data[$ye]['zhicheng'] = $zhicheng;
            $yeardata[] = Db::name('hr_wages')->where('wg_year', $valueyear['wg_year'])->where('wg_pid', $par)->select();
        }
        if ($yeardata[0]) {
            foreach ($yeardata as $key => $value) {
                $wg_gwgz = 0;
                $wg_xjgz = 0;
                $wg_jxgz = 0;
                $wg_zcbt = 0;
                $wg_slb = 0;
                $wg_db = 0;
                $wg_txbt = 0;
                $wg_txb = 0;
                $wg_jtbt = 0;
                $wg_zbb = 0;
                $wg_ylx = 0;
                $wg_syx = 0;
                $wg_yilx = 0;
                $wg_fjj = 0;
                foreach ($value as $keyss => $valuess) {
                    $wg_gwgz += $valuess['wg_gwgz'];
                    $wg_xjgz += $valuess['wg_xjgz'];
                    $wg_jxgz += $valuess['wg_jxgz'];
                    $wg_zcbt += $valuess['wg_zcbt'];
                    $wg_slb += $valuess['wg_slb'];
                    $wg_db += $valuess['wg_db'];
                    $wg_txbt += $valuess['wg_txbt'];
                    $wg_txb += $valuess['wg_txb'];
                    $wg_jtbt += $valuess['wg_jtbt'];
                    $wg_zbb += $valuess['wg_zbb'];
                    $wg_ylx += $valuess['wg_ylx'];
                    $wg_syx += $valuess['wg_syx'];
                    $wg_yilx += $valuess['wg_yilx'];
                    $wg_fjj += $valuess['wg_fjj'];
                    $data[$valuess['wg_year']]['wg_gwgz'] = $wg_gwgz;
                    $data[$valuess['wg_year']]['wg_xjgz'] = $wg_xjgz;
                    $data[$valuess['wg_year']]['wg_jxgz'] = $wg_jxgz;
                    $data[$valuess['wg_year']]['wg_zcbt'] = $wg_zcbt;
                    $data[$valuess['wg_year']]['wg_slb'] = $wg_slb;
                    $data[$valuess['wg_year']]['wg_db'] = $wg_db;
                    $data[$valuess['wg_year']]['wg_txbt'] = $wg_txbt;
                    $data[$valuess['wg_year']]['wg_txb'] = $wg_txb;
                    $data[$valuess['wg_year']]['wg_jtbt'] = $wg_jtbt;
                    $data[$valuess['wg_year']]['wg_zbb'] = $wg_zbb;
                    $data[$valuess['wg_year']]['wg_ylx'] = $wg_ylx;
                    $data[$valuess['wg_year']]['wg_syx'] = $wg_syx;
                    $data[$valuess['wg_year']]['wg_yilx'] = $wg_yilx;
                    $data[$valuess['wg_year']]['wg_fjj'] = $wg_fjj;
                }
            }
        } else {
            $data = null;
        }
        $chgongzi = Db::name('hr_cgwages')->where('cg_pid',$par)->select();
        $this->assign('chgongzi', $chgongzi);
        $this->assign('yeardata', $data);
        return $this->fetch('index');
    }

    public function saves()
    {


        $gongzi = Db::name('person')->select();
        foreach ($gongzi as $key => $value) {
            $data['wg_pid'] = $value['per_id'];
            $data['wg_year'] = 2017;
            $data['wg_yf'] = 11;
            $data['wg_gwgz'] = rand(5000, 8000);
            $data['wg_xjgz'] = rand(3000, 5000);
            $data['wg_jxgz'] = rand(1000, 2000);
            $data['wg_zcbt'] = rand(1000, 2000);
            $data['wg_slb'] = rand(1000, 2000);
            $data['wg_db'] = rand(2000, 4000);
            $data['wg_txbt'] = rand(1000, 2000);
            $data['wg_txb'] = rand(1000, 2000);
            $data['wg_jtbt'] = rand(1000, 2000);
            $data['wg_zbb'] = rand(1000, 2000);
            $data['wg_ylx'] = rand(300, 800);
            $data['wg_syx'] = rand(300, 800);
            $data['wg_yilx'] = rand(300, 800);
            $data['wg_fjj'] = rand(1000, 2000);
//            $gongzsi = Db::name('hr_wages')->insert($data);
//            var_dump($gongzsi);
        }
    }
}
