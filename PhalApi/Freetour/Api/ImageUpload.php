<?php
/**
 * 文件上传接口
 * User: kevin
 * Date: 2017/4/2 0002
 * Time: 16:43
 */

class Api_ImageUpload extends PhalApi_Api {

    public function getRules() {
        return array(
            'upload' => array(
                'file' => array(
                    'name' => 'file',
                    'type' => 'file',
                    'min' => 0,
                    'max' => 1024 * 1024,
                    'range' => array('image/jpg', 'image/jpeg', 'image/png'),
                    'ext' => array('jpg', 'jpeg', 'png')
                ),
                'imageFunc' => array('name' => 'image_func'),
            ),
        );
    }

    public function upload() {
        $res = array('code' => 0, 'msg' => '', 'info' => '');
        $domain = new Domain_ImageUpload();
        $res['info'] = $domain->imageUpload($this->file,$this->imageFunc );
        return $res;
    }
}