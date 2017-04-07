<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/4/1 0002
 * Time: 22:55
 */

class Model_ScenicContentOperation {

    private $_TAG = 'Model_ScenicContentOperation';

    private function getFileDBRootPath(){
        $file_DB_root_path = dirname(dirname(__FILE__)).'/FileDB/';
        if (!is_dir($file_DB_root_path)) {
            mkdir($file_DB_root_path);
        }
        return $file_DB_root_path;
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

    private function queryAllScenicIdFromDB() {
        try {
            $scenic_ids = array();
            $filenames = scandir($this->getFileDBRootPath());
            foreach ($filenames as $filename) {
                if (is_numeric($filename)) {
                    array_push($scenic_ids, intval($filename, 10));
                }
            }
            return $scenic_ids;
        }catch (Exception $e) {
            throw new Exception();
        }
    }

    public function deleteScenic($id) {
        try {
            $scenic_ids = $this->queryAllScenicIdFromDB();
            if (empty($scenic_ids)) {
                return array('error' => '目前没有scenic ID 可以供删除');
            }
            $id = intval($id, 10);
            if (in_array($id, $scenic_ids)) {
                sort($scenic_ids);
                $is_find_id = false;
                for ($i = 0; $i < sizeof($scenic_ids); $i++) {
                    if ($is_find_id){
                        $new_id = $scenic_ids[$i] - 1;
                        rename($this->getFileDBRootPath().$scenic_ids[$i], $this->getFileDBRootPath().$new_id);
                        $scenic_ids[$i] = $new_id;
                    } else {
                        if ($scenic_ids[$i] == $id) {
                            $this->delDir($this->getFileDBRootPath().'nextDelScenic');
                            DI()->logger->debug($this->_TAG, 'delete scenice dir ID:'.$scenic_ids[$i]);
                            rename($this->getFileDBRootPath().$scenic_ids[$i], $this->getFileDBRootPath().'nextDelScenic');
                            $is_find_id = true;
                            array_splice($scenic_ids, $i, 1);
                            $i--;
                        }
                    }

                }
                $is_find_id = false;
            } else {
                return array('error' => '未找到此文件ID：'.$id);
            }

            $res = array('deleted' => $id);
            return $res;
            //return array_merge($res, $scenic_ids);
        } catch (Exception $e) {
            return array('error' => '删除scenic ID失败');
        }
    }


    private function printDebugScenicID() {
        if(DI()->debug) {
            $ids = $this->queryAllScenicIdFromDB();
            DI()->logger->debug($this->_TAG, 'printDebugScenicID:------------------');
            foreach($ids as $id) {
                DI()->logger->debug($this->_TAG, 'printDebugScenicID:'.$id);
            }
        }
    }

    private function delDir($dir) {
        if (!is_dir($dir)) {
            return true;
        }

        //先删除目录下的文件：
        $dh=opendir($dir);
        while ($file=readdir($dh)) {
            if ($file!="." && $file!="..") {
            $fullpath=$dir."/".$file;
            if (!is_dir($fullpath)) {
                unlink($fullpath);
            } else {
                deldir($fullpath);
            }
            }
        }

        closedir($dh);
        //删除当前文件夹：
        if (rmdir($dir)) {
            return true;
        } else {
            return false;
        }
    }
}