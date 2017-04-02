<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/4/2 0002
 * Time: 22:55
 */

class Domain_ScenicContentOperation {

    public function addScenicId() {
        $model = new Model_ScenicContentOperation();
        return $model->addScenicId();
    }
}