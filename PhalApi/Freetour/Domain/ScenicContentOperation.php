<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/4/1 0002
 * Time: 22:55
 */

class Domain_ScenicContentOperation {

    public function addScenicId() {
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
}