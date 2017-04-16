<?php
/**
 * scenic内容操作接口
 * User: kevin
 * Date: 2017/4/1 0002
 * Time: 22:55
 */

class Api_ScenicContentOperation extends PhalApi_Api {

    public function getRules() {
        return array(
            'addScenicId' => array(),
            'deleteScenic' => array(
                'id' => array('name' => 'id', 'default' => '-1', 'desc' => '删除的ID'),
            ),
            'getBaseInfo' => array(),

            'imageUpload' => array(
                'file' => array(
                    'name' => 'file',
                    'type' => 'file',
                    'min' => 0,
                    'max' => 1024 * 1024,
                    'range' => array('image/jpg', 'image/jpeg', 'image/png'),
                    'ext' => array('jpg', 'jpeg', 'png')
                ),
                'imageFunc' => array('name' => 'image_func'),
                'scenicId' => array('name' => 'scenic_id'),
            ),
        );
    }

    public function addScenicId() {
        $res = array('code' => 0, 'msg' => '', 'info' => '');
        if(DI()->debug) {
            DI()->logger->debug('addScenicId', 'running in');
        }
        $domain = new Domain_ScenicContentOperation();
        $res['info'] = $domain->addScenicId();
        return $res;
    }

    public function deleteScenic() {
        $res = array('code' => 0, 'msg' => '', 'info' => '');
        $domain = new Domain_ScenicContentOperation();
        $res['info'] = $domain->deleteScenic($this->id);
        return $res;
    }

    /**
     * @return array
     */
    public function getBaseInfo() {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        $domain = new Domain_ScenicContentOperation();
        $info = $domain->getBaseInfo();

        if (empty($info)) {
            DI()->logger->debug('getBaseInfo', 'get scenic basic info error');

            $rs['code'] = -1;
            $rs['msg'] = T('not exists');
            return $rs;
        }
        $rs['info'] = $info;
        return $rs;
    }

    public function imageUpload() {
        $res = array('code' => 0, 'msg' => '', 'info' => '');
        $domain = new Domain_ScenicContentOperation();
        $res['info'] = $domain->imageUpload($this->file, $this->imageFunc, $this->scenicId);
        return $res;
    }
}