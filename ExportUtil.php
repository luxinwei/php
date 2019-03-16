<?php

class ExportUtil{

    public function export()
    {
        $where = "1=1";
        $count = M('table')->where($where)->count();
        $limit = 1000;
        $ppp = ceil($count / $limit);
        $pp = range(1, $ppp);
        foreach ($pp as $kkk => $vvv) {
            $offset = ($vvv - 1) * $limit;
            $res[$kkk] = M('table')->where($where)->limit($offset, $limit)->select();
            $str[$kkk] = "表头1,表头2,表头3,表头4,表头5,表头6,表头7,表头8,表头9";
            $exl11[$kkk] = explode(',', $str[$kkk]);
            foreach ($res[$kkk] as $k => $v) {
                $exl[$kkk][] = array(
                    $v['biaotou1'], $v['biaotou2'], $v['biaotou3'], $v['biaotou4'], $v['biaotou5'], $v['biaotou6'], $v['biaotou7'], $v['biaotou8'], $v['biaotou9']
                );
            }

            $this->exportToExcel('table_' . time() . $vvv . '.csv', $exl11[$kkk], $exl[$kkk]);
        }
    }


    protected function exportToExcel($filename, $titleArray = array(), $dataArray = array()){
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', 0);
        ob_end_clean();
        ob_start();
        header('Content-Type:text/csv');
        header('Content-Disposition:filename=' . $filename);
        $fp = fopen('php://output', 'w');
        fwrite($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
        fputcsv($fp, $titleArray);
        $index = 0;
        foreach ($dataArray as $item) {
            if ($index == 1000) {
                $index = 0;
                ob_flush();
                flush();
            }
            $index++;
            fputcsv($fp, $item);
        }

        ob_flush();
        flush();
        ob_end_clean();
    }
}
