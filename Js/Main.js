/**
 * Created by kevin on 2017/4/16 0016.
 */

var debug = true;
var url_path = './PhalApi/Public/';
var api_name = '';

$(function() {//加载时执行
    main();
});

function main() {
    api_name = 'Main.Main';
    query_post(url_path, api_name, {}, callback_main);
}

var callback_main = function(rs) {
    if(rs.ret != 200){
        //如果失败打印失败信息并且做出相应的处理
        alert(rs.msg);
        return;
    }

    if(rs.data.info != null) {
        var content_html = '';
        for(var x in rs.data.info) {
            if (x == 'systemIntroduce') {
                $("#system_introduce").html("<img src="+rs.data.info[x]+" />");
            } else if (x == 'impressionTopic') {
                $("#impression_topic").html("<img src="+rs.data.info[x]+" />");
            } else {
                content_html += "<img src="+rs.data.info[x]+" width=200 height=200 />";
            }
        }
        $("#scenic_content").html(content_html);
    } else {
        $("#main").html("访问失败！");
    }
};