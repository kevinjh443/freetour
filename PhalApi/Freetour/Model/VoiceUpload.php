<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/4/1 0002
 * Time: 19:44
 */

class Model_VoiceUpload {

    private $_TAG = 'Model_VoiceUpload';

    public function voiceSaveToScenic($file, $file_name, $scenic_id) {
        DI()->logger->debug($this->_TAG, 'voiceSaveToScenic');
        DI()->ucloud->set('save_path', '');
        DI()->ucloud->set('default_path', $scenic_id);
        DI()->ucloud->set('file_name', $file_name);
        return  DI()->ucloud->upfile($file);
    }

}