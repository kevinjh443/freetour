<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/4/9 0009
 * Time: 23:22
 */

$fileName = $_FILES['file']['name'];
$type = $_FILES['file']['type'];
$size = $_FILES['file']['size'];
$fileAlias = $_FILES["file"]["tmp_name"];

if($fileAlias){
move_uploaded_file($fileAlias, "uploadfile/" . $fileName);
}
echo 'fileName: ' . $fileName . ', fileType: ' . $type . ', fileSize: ' . ($size / 1024) . 'KB';