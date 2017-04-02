<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/4/2 0002
 * Time: 22:55
 */

class Api_ScenicContentOperation extends PhalApi_Api {

    public function getRules() {
        return array(
            'addScenicId' => array(),
        );
    }

    public function addScenicId() {

        $res = array('code' => 0, 'msg' => '', 'info' => '');
        $domain = new Domain_ScenicContentOperation();
        $res['info'] = $domain->addScenicId();
        return $res;
    }
}