<?php
/**
 * 主界面获取
 * User: kevin
 * Date: 2017/4/16 0016
 * Time: 21:22
 */

class Domain_Main {

    public function main() {
        //get top title
        $model = new Model_ScenicContentOperation();
        $toptitle = $model->getTopTitleInfo();
        $baseinfo = $model->getBaseInfo();
        $baseinfo = array_merge($baseinfo, $toptitle);
        return $baseinfo;
    }
}