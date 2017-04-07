<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/4/1 0002
 * Time: 19:44
 */

class Model_ImageUpload {

    public function imageSaveToTopTitle($file, $file_name) {
        DI()->ucloud->set('save_path', '');
        DI()->ucloud->set('default_path', 'TopTitle');
        DI()->ucloud->set('file_name', $file_name);
        return DI()->ucloud->upfile($file);
    }

    public function imageSaveToScenic($file, $file_name, $scenic_id) {
        DI()->ucloud->set('save_path', '');
        DI()->ucloud->set('default_path', $scenic_id);
        DI()->ucloud->set('file_name', $file_name);
        return DI()->ucloud->upfile($file);
    }

}