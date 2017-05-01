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
                $("#system_introduce_img").attr('src', rs.data.info[x]);
            } else if (x == 'impressionTopic') {
                $("#impression_topic_img").attr('src', rs.data.info[x]);
            } else {
                content_html += "<div id=\"scenic_img\">";
                content_html += "<img src="+rs.data.info[x].title_image_url+" class=\"img-rounded\" alt="+x+" " +
                "onclick=\"choicedScenic('"+x+"', '"+rs.data.info[x].title_words+"')\"/>";
                content_html += "<span id='scenic_title_words'>"+rs.data.info[x].title_words+"</span>";
                //content_html += "<input id='scenic_id_"+x+"' value="+x+" type=hidden>";
                content_html += "</div>";
            }
        }
        $("#scenic_content").html(content_html);
    } else {
        $("#main").html("访问失败！");
    }
};


function choicedScenic(scenic_id, title_words) {
    window.location.href="scenic.php?scenic_id="+scenic_id+"&title_words="+title_words;

}