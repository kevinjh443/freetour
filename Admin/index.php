<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 2017/4/1 0002
 * Time: 16:35
 */
require_once('CommonApiPath.php');
require_once('../PhalApi/Config/CommonVar.php');
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>后台管理系统</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- for adapt phone device screen -->
    <!-- 引入 Bootstrap -->
    <link href="../Bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim 和 Respond.js 用于让 IE8 支持 HTML5元素和媒体查询 -->
    <!-- 注意： 如果通过 file://  引入 Respond.js 文件，则该文件无法起效果 -->
    <!--[if lt IE 9]>
    <![endif]-->
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="../Libs/jquery/jquery-3.2.0.min.js"></script>
    <script src="../Bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="../PhalApi/SDK/JS/js/SDK/PhalApi.js"></script>
    <script src="./js/AdminFunction.js"></script>
</head>
<body>
<h3>一、上传封面图片</h3>
<h4>1， 顶端系统说明图</h4>（若存在会自动覆盖）
<form method="POST" action="<? echo $imageUploadInterface?>" enctype="multipart/form-data">
    <input type="file" name="file">
    <input name="image_func" type="hidden" value="<? echo $TopTitle_systemIntroduce?>">
    <input type="submit">
</form>
<br/>
<h4>2， 印象宣传主题图</h4>（若存在会自动覆盖）
<form method="POST" action="<? echo $imageUploadInterface?>" enctype="multipart/form-data">
    <input type="file" name="file">
    <input name="image_func" type="hidden" value="<? echo $TopTitle_impressionTopic?>">
    <input type="submit">
</form>
<hr/>
<br/><br/>
<h3>二、内容上传</h3>
<table class="gridtable">
    <tr>
        <th>项</th><th>描述</th><th>操作</th><th>结果</th><th>预览</th>
    </tr>

    <tr>
        <td>序号</td>
        <td>xxxx</td>
        <td>
            <select id="scenic_item_option">
                <option selected="" value="0">新增</option>
                <option value="1">删除</option>
                <option value="2">修改</option>
                <option value="3">排序</option>
            </select>
            <input type="button" id="do_scenic_item_option" value="确认操作" onclick = "doScenicItemOption()"/>
        </td>
        <td>
            <div id="result_scenic_item_option">---</div>
            <div id="scenic_id">2</div>
        </td>
        <td><a href="">--</a></td>
    </tr>

    <tr>
        <td>景点封面图</td>
        <td>xxxx</td>
        <td>
            <form method="POST" enctype="multipart/form-data">
                <input name="file" type="file" id="scenic_title_image_file" accept="image/*" >
                <input name="image_func" type="hidden" value="scenicTitle">
                <input type="button" id="scenic_title_image_upload" value="确认提交" onclick = "scenicTitleImageUpload()">
            </form>
        </td>
        <td><div id="scenic_title_image_view">--</div></td>
        <td><a href="">--</a></td>
    </tr>


    <tr>
        <td>语音介绍</td>
        <td>xxxx</td>
        <td>
            <form method="POST" action="<? echo $imageUploadInterface?>" enctype="multipart/form-data">
                <input type="file" name="file">
                <input name="image_func" type="hidden" value="scenicTitle">
                <input type="submit">
            </form>
        </td>
        <td>---</td>
        <td><a href="">--</a></td>
    </tr>

    <tr>
        <td>文字介绍</td>
        <td>xxxx</td>
        <td>
            <form method="POST" action="<? echo $imageUploadInterface?>" enctype="multipart/form-data">
                <input type="file" name="file">
                <input name="image_func" type="hidden" value="scenicTitle">
                <input type="button" value="提交" onclick="test()">
            </form>
        </td>
        <td>---</td>
        <td><a href="">--</a></td>
    </tr>

    <tr>
        <td>其他图片</td>
        <td>xxxx</td>
        <td>
            <form method="POST" action="<? echo $imageUploadInterface?>" enctype="multipart/form-data">
                <input type="file" name="file">
                <input name="image_func" type="hidden" value="scenicTitle">
                <input type="submit">
            </form>
        </td>
        <td>---</td>
        <td><a href="">--</a></td>
    </tr>
</table>


<br/><br/><br/><br/><br/><br/>
</body>
</html>


<!-- do script -->
<script>

</script>



<!-- CSS goes in the document HEAD or added to your external stylesheet -->
<style type="text/css">
    table.gridtable {
        font-family: verdana,arial,sans-serif;
        font-size:11px;
        color:#333333;
        border-width: 1px;
        border-color: #666666;
        border-collapse: collapse;
    }
    table.gridtable th {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #666666;
        background-color: #dedede;
    }
    table.gridtable td {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #666666;
        background-color: #ffffff;
    }
</style>