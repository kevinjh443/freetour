<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/4/1 0002
 * Time: 19:37
 */

class Domain_VoiceUpload {

    function __construct() {
        //require_once('../../Config/CommonVar.php');
    }


    public function voiceUpload($file, $file_name, $scenic_id) {
        $model = new Model_VoiceUpload();
        return $model->voiceSaveToScenic($file, $file_name, $scenic_id);
    }
}