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
        $res_one = array();
        $scenicIds = parent::queryScenicIds();
        foreach($scenicIds as $id) {
            $filesInfo = parent::queryScenicContentFilesInfo($id);
            $strTitleWords = '';
            foreach ($filesInfo as $info) {
                if(DI()->debug) {
                    DI()->logger->debug($this->_TAG, $info['file_name']);
                }
                if(strstr($info['file_name'], 'scenicTitle')) {
                    $res_one['title_image_url'] = $info['host_path'];
                } elseif(strstr($info['file_name'], 'titleWords.txt')) {
                    $fp = fopen($info['local_path'], "r");
                    $strTitleWords = fread($fp, filesize($info['local_path']));
                    if(DI()->debug) {
                        DI()->logger->debug($this->_TAG, $strTitleWords);
                    }
                    if(!empty($strTitleWords)) {
                        $res_one['title_words'] = $strTitleWords;
                    }
                }
            }

            if (!empty($res_one['title_image_url'])) {
                if (empty($strTitleWords)) {
                    $res_one['title_words'] = 'NULL';
                }
                $res['id_'.$id] = $res_one;
            }

            unset($res_one);
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


    /**
     * @param $scenicId
     * imgs , mp3, words
     */
    public function getScenic($scenicId) {
        $res = array();
        $filesInfo = parent::queryScenicContentFilesInfo($scenicId);
        $imgId = 0;
        foreach ($filesInfo as $info) {
            if(strstr($info['file_name'], '.png') || strstr($info['file_name'], '.jpg')){
                $res['img_'.$imgId] = $info['host_path'];
                $imgId++;
            } elseif(strstr($info['file_name'], '.mp3')) {
                $res['voice_'] = $info['host_path'];
            } elseif(strstr($info['file_name'], 'introduce_words_chinese.txt')) {
                $intrWords = file_get_contents($info['local_path'], "r");
                if(DI()->debug) {
                    DI()->logger->debug($this->_TAG, $intrWords);
                }
                if(empty($intrWords)) {
                    $res_one['introduce_words'] = "introduce words is NULL";
                }
                $res['introduce_words'] = $intrWords;
            }
        }
        return $res;
    }

}