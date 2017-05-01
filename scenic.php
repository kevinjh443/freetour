<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/5/1 0001
 * Time: 14:59
 */

$scenic_id = $_GET['scenic_id']?$_GET['scenic_id']:'id_0';
$title_words = $_GET['title_words']?$_GET['title_words']:'id_0';
?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>巫山·<? echo $title_words?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- for adapt phone device screen -->
    <!-- 引入 Bootstrap -->
    <link href="Bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="Css/Scenic.css" rel="stylesheet">

    <!-- HTML5 Shim 和 Respond.js 用于让 IE8 支持 HTML5元素和媒体查询 -->
    <!-- 注意： 如果通过 file://  引入 Respond.js 文件，则该文件无法起效果 -->
    <!--[if lt IE 9]>
    <![endif]-->
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="Libs/jquery/jquery-3.2.0.min.js"></script>
    <script src="Bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="./PhalApi/SDK/JS/js/SDK/PhalApi.js"></script>
    <script src="./Js/Scenic.js"></script>
</head>
<body>
<div class="scenic_pictures">
    <div class="inner clearfix">
    </div>
    <div class="scenicpic_pagination">
    </div>
    <a href="javascript:void(0)" class="left-arrow">&lt;</a>
    <a href="javascript:void(0)" class="right-arrow">&gt;</a>
</div>
<div class="scenic_controller"></div>
<div class="scenic_words"></div>
</body>
</html>

<script>

    $(function() {//加载时执行
        scenic("<? echo $scenic_id?>");
    });

</script>