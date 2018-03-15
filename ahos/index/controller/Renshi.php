<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Renshi extends Controller
{
    public function zyjskh()
    {
        return $this->fetch('zyjskh');
    }

    public function htdqkhgl()
    {
        return $this->fetch('htdqkhgl');
    }

    public function zcpyqmkh()
    {
        return $this->fetch('zcpyqmkh');
    }

    public function ydyfkh()
    {
        return $this->fetch('ydyfkh');
    }

    public function ndkh()
    {
        return $this->fetch('ndkh');
    }

    public function xsjsgl()
    {
        return $this->fetch('xsjsgl');
    }
}
