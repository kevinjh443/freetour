<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/4/1 0002
 * Time: 22:55
 */

class Domain_ScenicContentOperation {

    private $_TAG = 'Domain_ScenicContentOperation';

    function __construct() {
        if(DI()->debug) {
            DI()->logger->debug($this->_TAG, 'running in');
        }
    }

    public function addScenicId() {
        if(DI()->debug) {
            DI()->logger->debug($this->_TAG, 'addScenicId running in');
        }
        $model = new Model_ScenicContentOperation();
        return $model->addScenicId();
    }

    public function deleteScenic($id) {
        if (empty($id) || $id == '-1') {
            return array('error' => '未输入ID');
        }
        $model = new Model_ScenicContentOperation();
        return $model->deleteScenic($id);
    }

    public function getBaseInfo() {
        if(DI()->debug) {
            DI()->logger->debug($this->_TAG, 'getBaseInfo running in');
        }
        $model = new Model_ScenicContentOperation();
        return $model->getBaseInfo();
    }

    public function imageUpload($file, $file_name, $scenic_id) {
        $model = new Model_ScenicContentOperation();
        return $model->imageUpload($file, $file_name, $scenic_id);
    }
}