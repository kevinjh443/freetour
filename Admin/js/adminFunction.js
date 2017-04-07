/**
 * Created by kevin on 2017/4/3 0003.
 */


var debug = true;
var url_path = '../PhalApi/Public/';
var api_name = '';


function test() {
    alert('test');
}


function scenicTitleImageUpload() {
    api_name = 'ImageUpload.upload';
    var scenic_id = $("#scenic_id").html();
    if (debug) {
        alert('url:'+url_path+' api:'+api_name+' id:'+scenic_id);
    }
    var data = {};
    data['scenic_id'] = scenic_id;
    query_post(url_path, api_name, data, callback_scenicTitleImageUpload);
}

function doScenicItemOption() {
    var options = $("#scenic_item_option option:selected");  //获取选中的项
    //alert(options.val());
    if (debug) {
        console.log('you choice:'+options.val());
    }
    switch (Number(options.val())) {
        case 0:// 新增
            api_name = 'ScenicContentOperation.addScenicId';
            if (debug) {
                console.log('url:'+url_path+' api:'+api_name);
            }
            query_post(url_path, api_name, {}, callback_doScenicItemOption);
            break;
        case 1:// 删除
            api_name = 'ScenicContentOperation.deleteScenic';
            if (debug) {
                console.log('api:'+api_name);
            }
            query_post(url_path, api_name, {}, callback_doScenicItemOption);
            break;
    }
}



var callback_scenicTitleImageUpload = function(rs) {
    alert('callback_scenicTitleImageUpload');
};

/**
 *
 */
var callback_doScenicItemOption = function(rs) {
    if(rs.ret != 200){
        //如果失败打印失败信息并且做出相应的处理
        alert(rs.msg);
        return;
    }
    //alert(rs.data.info.path);
    if(rs.data.info.path > 0) {
        $("#result_scenic_item_option").html("新创建序号为：");
        $("#scenic_id").html(rs.data.info.path);
    } else {
        $("#result_scenic_item_option").html("创建失败！");
    }
};