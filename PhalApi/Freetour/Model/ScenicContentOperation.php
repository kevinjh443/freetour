<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/4/2 0002
 * Time: 22:55
 */

class Model_ScenicContentOperation {

    private function getFileDBRootPath(){
        return dirname(dirname(__FILE__)).'/FileDB/';
    }

    public function addScenicId() {
        $res = array('path' => '');
        if (is_dir($this->getFileDBRootPath())) {
            $scenic_num = 0;
            $filenames = scandir($this->getFileDBRootPath());
            foreach ($filenames as $filename) {
                //$res['path'] .= $filename.' ';
                if (is_numeric($filename)) {
                    $scenic_num++;
                }
            }

            $scenic_num += 1;
            if (mkdir($this->getFileDBRootPath().$scenic_num)) {
                $res['path'] = $scenic_num;
            } else {
                $res['path'] = -1;
            }
        }
        return $res;
    }

    /**
     * 创建目录
     * @param  string $dir 要创建的穆里
     * @return boolean          创建状态，true-成功，false-失败
     */
    public function mkdir($dir){
        if(is_dir($dir)){
            return true;
        }

        if(mkdir($dir, 0777, true)){
            return true;
        } else {
            //$error = "目录 {$dir} 创建失败！";
            return false;
        }
    }
}