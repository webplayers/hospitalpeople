<?php
namespace app\index\controller;

use app\common\model\Hpeople;
use think\Controller;
use think\Db;
use PHPExcel_IOFactory;
use PHPExcel;


class Daochu extends Common
{
    /*岗位信息导出*/
    public function gangweixinxidaochu()
    {
        vendor("phpexcel.PHPExcel");
        $restkeshi = Db::name('htopkeshi')->select();
        $PHPExcel = new PHPExcel(); //实例化PHPExcel类，类似于在桌面上新建一个Excel表格
        $PHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', '岗位')
            ->setCellValue('C1', '人数')
            ->setCellValue('D1', '岗位描述')
            ->setCellValue('E1', '任职条件');

        $PHPSheet = $PHPExcel->getActiveSheet(); //获得当前活动sheet的操作对象
        $PHPSheet->setTitle('demo'); //给当前活动sheet设置名称
        $i = 2;  //定义一个i变量，目的是在循环输出数据是控制行数
        $count = count($restkeshi);  //计算有多少条数据
        for ($i = 2; $i <= $count + 1; $i++) {
            $PHPSheet->setCellValue('A' . $i, $restkeshi[$i - 2]['ks_id']);
            $PHPSheet->setCellValue('B' . $i, $restkeshi[$i - 2]['ks_name']);
            $PHPSheet->setCellValue('C' . $i, $restkeshi[$i - 2]['ks_count']);
            $PHPSheet->setCellValue('D' . $i, $restkeshi[$i - 2]['des']);
            $PHPSheet->setCellValue('E' . $i, $restkeshi[$i - 2]['req']);
        }
        $PHPWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');//按照指定格式生成Excel文件，‘Excel2007’表示生成2007版本的xlsx，‘Excel5’表示生成2003版本Excel文件
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//告诉浏览器输出07Excel文件
//header('Content-Type:application/vnd.ms-excel');//告诉浏览器将要输出Excel03版本文件
        header('Content-Disposition: attachment;filename="科室信息.xlsx"');//告诉浏览器输出浏览器名称
        header('Cache-Control: max-age=0');//禁止缓存
        $PHPWriter->save("php://output");
    }

    /*临聘人员信息导出*/
    public function lingpidaochu()
    {
        vendor("phpexcel.PHPExcel");
        $restkeshi = (new Hpeople())->linpgetall();
        $PHPExcel = new PHPExcel(); //实例化PHPExcel类，类似于在桌面上新建一个Excel表格
        $PHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '人员编码')
            ->setCellValue('B1', '姓名')
            ->setCellValue('C1', '性别')
            ->setCellValue('D1', '年龄')
            ->setCellValue('E1', '学历学位')
            ->setCellValue('F1', '所属机构')
            ->setCellValue('G1', '状态')
            ->setCellValue('H1', '通讯地址')
            ->setCellValue('I1', '联系方式');

        $PHPSheet = $PHPExcel->getActiveSheet(); //获得当前活动sheet的操作对象
        $PHPSheet->setTitle('临聘人员'); //给当前活动sheet设置名称
        $i = 2;  //定义一个i变量，目的是在循环输出数据是控制行数
        $count = count($restkeshi);  //计算有多少条数据
        for ($i = 2; $i <= $count + 1; $i++) {
            $PHPSheet->setCellValue('A' . $i, $restkeshi[$i - 2]['linpid']);
            $PHPSheet->setCellValue('B' . $i, $restkeshi[$i - 2]['name']);
            $PHPSheet->setCellValue('C' . $i, $restkeshi[$i - 2]['sex']);
            $PHPSheet->setCellValue('D' . $i, $restkeshi[$i - 2]['age']);
            $PHPSheet->setCellValue('E' . $i, $restkeshi[$i - 2]['xueli']);
            $PHPSheet->setCellValue('F' . $i, $restkeshi[$i - 2]['ks_name']);
            $PHPSheet->setCellValue('G' . $i, $restkeshi[$i - 2]['status']);
            $PHPSheet->setCellValue('H' . $i, $restkeshi[$i - 2]['address']);
            $PHPSheet->setCellValue('I' . $i, $restkeshi[$i - 2]['phone']);
        }
        $PHPWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');//按照指定格式生成Excel文件，‘Excel2007’表示生成2007版本的xlsx，‘Excel5’表示生成2003版本Excel文件
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//告诉浏览器输出07Excel文件
//header('Content-Type:application/vnd.ms-excel');//告诉浏览器将要输出Excel03版本文件
        header('Content-Disposition: attachment;filename="临聘人员信息.xlsx"');//告诉浏览器输出浏览器名称
        header('Cache-Control: max-age=0');//禁止缓存
        $PHPWriter->save("php://output");
    }

    /*正式员工信息导出*/
    public function shenshidaochu()
    {
        vendor("phpexcel.PHPExcel");
        $restkeshi = (new Hpeople())->zsgetall("3");
        $PHPExcel = new PHPExcel(); //实例化PHPExcel类，类似于在桌面上新建一个Excel表格
        $PHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '人员编码')
            ->setCellValue('B1', '姓名')
            ->setCellValue('C1', '性别')
            ->setCellValue('D1', '年龄')
            ->setCellValue('E1', '学历学位')
            ->setCellValue('F1', '所属机构')
            ->setCellValue('G1', '状态')
            ->setCellValue('H1', '通讯地址')
            ->setCellValue('I1', '联系方式');

        $PHPSheet = $PHPExcel->getActiveSheet(); //获得当前活动sheet的操作对象
        $PHPSheet->setTitle('正式员工'); //给当前活动sheet设置名称
        $i = 2;  //定义一个i变量，目的是在循环输出数据是控制行数
        $count = count($restkeshi);  //计算有多少条数据
        for ($i = 2; $i <= $count + 1; $i++) {
            $PHPSheet->setCellValue('A' . $i, $restkeshi[$i - 2]['linpid']);
            $PHPSheet->setCellValue('B' . $i, $restkeshi[$i - 2]['name']);
            $PHPSheet->setCellValue('C' . $i, $restkeshi[$i - 2]['sex']);
            $PHPSheet->setCellValue('D' . $i, $restkeshi[$i - 2]['age']);
            $PHPSheet->setCellValue('E' . $i, $restkeshi[$i - 2]['xueli']);
            $PHPSheet->setCellValue('F' . $i, $restkeshi[$i - 2]['ks_name']);
            $PHPSheet->setCellValue('G' . $i, $restkeshi[$i - 2]['status']);
            $PHPSheet->setCellValue('H' . $i, $restkeshi[$i - 2]['address']);
            $PHPSheet->setCellValue('I' . $i, $restkeshi[$i - 2]['phone']);
        }
        $PHPWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');//按照指定格式生成Excel文件，‘Excel2007’表示生成2007版本的xlsx，‘Excel5’表示生成2003版本Excel文件
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//告诉浏览器输出07Excel文件
//header('Content-Type:application/vnd.ms-excel');//告诉浏览器将要输出Excel03版本文件
        header('Content-Disposition: attachment;filename="正式员工信息.xlsx"');//告诉浏览器输出浏览器名称
        header('Cache-Control: max-age=0');//禁止缓存
        $PHPWriter->save("php://output");
    }

    /*退休员工信息导出*/
    public function tuixiudaochu()
    {
        vendor("phpexcel.PHPExcel");
        $restkeshi = (new Hpeople())->zsgetall("4");
        $PHPExcel = new PHPExcel(); //实例化PHPExcel类，类似于在桌面上新建一个Excel表格
        $PHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '人员编码')
            ->setCellValue('B1', '姓名')
            ->setCellValue('C1', '性别')
            ->setCellValue('D1', '年龄')
            ->setCellValue('E1', '学历学位')
            ->setCellValue('F1', '所属机构')
            ->setCellValue('G1', '状态')
            ->setCellValue('H1', '通讯地址')
            ->setCellValue('I1', '联系方式');

        $PHPSheet = $PHPExcel->getActiveSheet(); //获得当前活动sheet的操作对象
        $PHPSheet->setTitle('退休员工'); //给当前活动sheet设置名称
        $i = 2;  //定义一个i变量，目的是在循环输出数据是控制行数
        $count = count($restkeshi);  //计算有多少条数据
        for ($i = 2; $i <= $count + 1; $i++) {
            $PHPSheet->setCellValue('A' . $i, $restkeshi[$i - 2]['linpid']);
            $PHPSheet->setCellValue('B' . $i, $restkeshi[$i - 2]['name']);
            $PHPSheet->setCellValue('C' . $i, $restkeshi[$i - 2]['sex']);
            $PHPSheet->setCellValue('D' . $i, $restkeshi[$i - 2]['age']);
            $PHPSheet->setCellValue('E' . $i, $restkeshi[$i - 2]['xueli']);
            $PHPSheet->setCellValue('F' . $i, $restkeshi[$i - 2]['ks_name']);
            $PHPSheet->setCellValue('G' . $i, $restkeshi[$i - 2]['status']);
            $PHPSheet->setCellValue('H' . $i, $restkeshi[$i - 2]['address']);
            $PHPSheet->setCellValue('I' . $i, $restkeshi[$i - 2]['phone']);
        }
        $PHPWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');//按照指定格式生成Excel文件，‘Excel2007’表示生成2007版本的xlsx，‘Excel5’表示生成2003版本Excel文件
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//告诉浏览器输出07Excel文件
//header('Content-Type:application/vnd.ms-excel');//告诉浏览器将要输出Excel03版本文件
        header('Content-Disposition: attachment;filename="退休员工信息.xlsx"');//告诉浏览器输出浏览器名称
        header('Cache-Control: max-age=0');//禁止缓存
        $PHPWriter->save("php://output");
    }

    /*工资信息导出*/
    public function gongzi()
    {
        vendor("phpexcel.PHPExcel");
        $PHPExcel = new PHPExcel(); //实例化PHPExcel类，类似于在桌面上新建一个Excel表格
        $PHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '编码')
            ->setCellValue('B1', '姓名')
            ->setCellValue('C1', '所在科室')
            ->setCellValue('D1', '基本工资')
            ->setCellValue('E1', '岗位津贴')
            ->setCellValue('F1', '生活补贴')
            ->setCellValue('G1', '养老保险')
            ->setCellValue('H1', '失业保险')
            ->setCellValue('I1', '社保')
            ->setCellValue('J1', '个人税')
            ->setCellValue('K1', '扣合计')
            ->setCellValue('L1', '实领工资')
            ->setCellValue('M1', '月份');

        $PHPSheet = $PHPExcel->getActiveSheet(); //获得当前活动sheet的操作对象
        $PHPSheet->setTitle('工资信息'); //给当前活动sheet设置名称
        $PHPSheet->setCellValue('A2', '14144415331');
        $PHPSheet->setCellValue('B2','王聪');
        $PHPSheet->setCellValue('C2','放射科' );
        $PHPSheet->setCellValue('D2','4526');
        $PHPSheet->setCellValue('E2', '2541');
        $PHPSheet->setCellValue('F2', '1562');
        $PHPSheet->setCellValue('G2', '114');
        $PHPSheet->setCellValue('H2', '125');
        $PHPSheet->setCellValue('I2', '135');
        $PHPSheet->setCellValue('J2', '142');
        $PHPSheet->setCellValue('K2', '628');
        $PHPSheet->setCellValue('L2', '8001');
        $PHPSheet->setCellValue('M2','3' );


        $PHPWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');//按照指定格式生成Excel文件，‘Excel2007’表示生成2007版本的xlsx，‘Excel5’表示生成2003版本Excel文件
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//告诉浏览器输出07Excel文件
//header('Content-Type:application/vnd.ms-excel');//告诉浏览器将要输出Excel03版本文件
        header('Content-Disposition: attachment;filename="工资信息.xlsx"');//告诉浏览器输出浏览器名称
        header('Cache-Control: max-age=0');//禁止缓存
        $PHPWriter->save("php://output");
    }
}
