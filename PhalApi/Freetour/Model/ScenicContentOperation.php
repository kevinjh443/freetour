<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/4/1 0002
 * Time: 22:55
 */

class Model_ScenicContentOperation extends FileDB {

    protected $_TAG = 'Model_ScenicContentOperation';

    function __construct() {
        if(DI()->debug) {
            DI()->logger->debug($this->_TAG, 'running in');
        }
    }

    public function addScenicId() {
        DI()->logger->debug($this->_TAG, 'addScenicId running in');
        return parent::addScenicId();
    }

    public function deleteScenic($id) {
        try {
            $scenic_ids = parent::queryScenicIds();
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
                        parent::renameScenicIds($scenic_ids[$i], $new_id);
                        $scenic_ids[$i] = $new_id;
                    } else {
                        if ($scenic_ids[$i] == $id) {
                            parent::delScenic("nextDelScenic");
                            DI()->logger->debug($this->_TAG, 'delete scenice dir ID:'.$scenic_ids[$i]);
                            parent::renameScenicIds($scenic_ids[$i], 'nextDelScenic');
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
            $ids = parent::queryScenicIds();
            DI()->logger->debug($this->_TAG, 'printDebugScenicID:------------------');
            foreach($ids as $id) {
                DI()->logger->debug($this->_TAG, 'printDebugScenicID:'.$id);
            }
        }
    }


    /**
     * @return array scenicTitle.png url
     */
    public function getBaseInfo() {
        $res = array();
        $scenicIds = parent::queryScenicIds();
        foreach($scenicIds as $id) {
            $urls = parent::queryScenicContentUrls($id);
            foreach ($urls as $url) {
                if(strstr($url, 'scenicTitle')) {
                    $res['id_'.$id] = $url;
                    break;
                }
            }
        }
        return $res;
    }

    public function imageUpload($file, $file_name, $scenic_id) {
        if ('systemIntroduce' == $file_name || 'impressionTopic' == $file_name) {
            return parent::addScenicFiles('TopTitle', $file_name, $file);
        } else {
            return parent::addScenicFiles($scenic_id, $file_name, $file);
        }
    }

    public function getTopTitleInfo() {
        $toptitle = parent::getFileDBRootPath().'TopTitle';

        if(!is_dir($toptitle)) {
            return array('error' => 'TopTitle is not exist.');
        }
        $res = array();
        $filenames = scandir($toptitle);
        foreach ($filenames as $filename) {
            if(strstr($filename, 'systemIntroduce')) {
                $res['systemIntroduce'] = parent::getHostFileDBRootPath().'TopTitle/'.$filename;
                if(DI()->debug) {
                    //DI()->logger->debug($this->_TAG, parent::getHostFileDBRootPath().'TopTitle/'.$filename);
                }
            } elseif (strstr($filename, 'impressionTopic')) {
                $res['impressionTopic'] = parent::getHostFileDBRootPath().'TopTitle/'.$filename;
            }
        }
        return $res;
    }

}