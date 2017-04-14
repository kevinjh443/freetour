<?php

/**
 * scenic info
 */
class Api_ScenicContent extends PhalApi_Api {

    public function getRules() {
        return array(
            'getBaseInfo' => array(),
            'getMultiBaseInfo' => array(
                'userIds' => array('name' => 'user_ids', 'type' => 'array', 'format' => 'explode', 'require' => true, 'desc' => '用户ID，多个以逗号分割'),
            ),
        );
    }

    /**
     *
     */
    public function getBaseInfo() {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_ScenicContent();
        $info = $domain->getBaseInfo();

        if (empty($info)) {
            DI()->logger->debug('get scenic basic info error', $this->userId);

            $rs['code'] = 1;
            $rs['msg'] = T('not exists');
            return $rs;
        }

        $rs['info'] = $info;

        return $rs;
    }

    /**
     */
    public function getMultiBaseInfo() {
        $rs = array('code' => 0, 'msg' => '', 'list' => array());

//        $domain = new Domain_User();
//        foreach ($this->userIds as $userId) {
//            $rs['list'][] = $domain->getBaseInfo($userId);
//        }

        return $rs;
    }
}
