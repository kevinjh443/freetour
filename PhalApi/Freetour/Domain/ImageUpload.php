<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/4/2 0002
 * Time: 19:37
 */

class Domain_ImageUpload {

    public function imageUpload($file, $file_name) {
        $model = new Model_ImageUpload();
        $res = $model->imageSave($file, $file_name);

        if (!$res) {
            $url = $res['url'];
            $file_info = $res['file'];

            $model = new Model_ImageUploadInfoSynvDB();
            $model->imageSaveSyncDB($file_name, $url, $file_info);
        }
    }
}