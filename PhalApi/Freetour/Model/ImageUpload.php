<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/4/2 0002
 * Time: 19:44
 */

class Model_ImageUpload {

    public function imageSave($file, $file_name) {
        DI()->ucloud->set('save_path', 'Images/'.date('Y/m/d'));
        DI()->ucloud->set('file_name', $file_name);
        return DI()->ucloud->upfile($file);
    }

}