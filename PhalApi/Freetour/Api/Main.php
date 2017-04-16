<?php
/**
 * 主界面获取
 * User: kevin
 * Date: 2017/4/16 0016
 * Time: 21:22
 */

class Api_Main extends PhalApi_Api {

    public function getRules() {
        return array(
            'main' => array(),
        );
    }

    public function main() {
        $res = array('code' => 0, 'msg' => '', 'info' => array());
        $domain = new Domain_Main();
        $res['info'] = $domain->main();
        return $res;
    }
}