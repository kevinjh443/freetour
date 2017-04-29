<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/4/29 0029
 * Time: 17:47
 */


class ImageManager {
    private $filename = '';
    private $width;
    private $height;

    function makeThumbnail($oriImage) {
        list($s_w, $s_h) = getimagesize($oriImage);//获取原图片高度、宽度
    }

}