<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/4/15 0015
 * Time: 1:04
 */

interface FileDB {
    public function createNewScenicId();
    public function addScenicImages($scenicId, $name, $file);
    public function addScenicVoice($scenicId, $name, $file);
    public function addScenicWords($scenicId, $name, $file);

    public function delScenic($scenicId);

    public function queryScenicIds();
    public function queryAllScenicBaseInfo();
    public function getScenicDetailInfo($scenicId);

    public function renameScenicIds($oriName, $newName);

}


class FileDBController implements FileDB {

}