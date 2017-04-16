<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/4/1 0002
 * Time: 19:37
 */

class Domain_ImageUpload {

    function __construct() {
        //require_once('../../Config/CommonVar.php');
    }


    public function imageUpload($file, $file_name, $scenic_id) {
        $model = new Model_ImageUpload();
        if ('systemIntroduce' == $file_name || 'impressionTopic' == $file_name) {
            return $model->imageSaveToTopTitle($file, $file_name);
        } else {
            return $model->imageSaveToScenic($file, $file_name, $scenic_id);
        }
    }
}