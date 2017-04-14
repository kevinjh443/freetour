<?php
/**
 * 文件上传接口
 * User: kevin
 * Date: 2017/4/1 0002
 * Time: 16:43
 */

class Api_VoiceUpload extends PhalApi_Api {

    public function getRules() {
        return array(
            'upload' => array(
                'file' => array(
                    'name' => 'file',
                    'type' => 'file',
                    'min' => 0,
                    'max' => 1024 * 1024,
                    //'range' => array('image/jpg', 'image/jpeg', 'image/png'),
                    'ext' => array('mp3',)
                ),
                'voiceFunc' => array('name' => 'voice_func'),
                'scenicId' => array('name' => 'scenic_id'),
            ),
        );
    }

    public function upload() {
        $res = array('code' => 0, 'msg' => '', 'info' => '');
        $domain = new Domain_VoiceUpload();
        $res['info'] = $domain->voiceUpload($this->file, $this->voiceFunc, $this->scenicId);
        return $res;
    }
}