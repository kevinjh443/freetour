/**
 * Created by kevin on 2017/5/1 0001.
 */


var debug = true;
var url_path = './PhalApi/Public/';
var api_name = '';

function scenic(scenic_id) {
    api_name = 'ScenicContentOperation.GetScenic';
    var data = {};
    data['scenic_id'] = scenic_id;
    query_post(url_path, api_name, data, callback_scenic);
}

var callback_scenic = function(rs) {
    if(rs.ret != 200){
        //如果失败打印失败信息并且做出相应的处理
        alert(rs.msg);
        return;
    }

    if(rs.data.info != null) {
        var content_html = '';
        var content_item_html = '';
        var img_count = 1;
        for(var x in rs.data.info) {
            if(-1 != x.indexOf('img_')){
                content_html += "<div class=\"scenicpic_innerwraper\"><img src=\""+rs.data.info[x]+"\" /></div>";
                if(img_count == 1) {
                    content_item_html += "<span class=\"scenicpic_active\">"+img_count+"</span>";
                } else {
                    content_item_html += "<span>"+img_count+"</span>";
                }
                img_count++;
            }

            ///2 words
            if(-1 != x.indexOf('introduce_words')) {
                $(".scenic_words").html(rs.data.info[x]);
            }


            ///3 voice
            if(-1 != x.indexOf('voice_')) {
                content_voice = "<audio controls=\"controls\">" +
                "<source src=\""+rs.data.info[x]+"\" type=\"audio/mpeg\">" +
                "Your browser does not support the audio element." +
                "</audio>";
                $(".scenic_controller").html(content_voice);
            }

        }
        $(".inner").html(content_html);
        $(".scenicpic_pagination").html(content_item_html);
        loadImages();

    }


};

var loadImages = function() {
    var innerGroup = $(".scenicpic_innerwraper");
    var leftArrow = $(".left-arrow");
    var rightArrow = $(".right-arrow");
    var spanGroup = $(".scenicpic_pagination span");
    var imgWidth = $(".scenicpic_innerwraper img:first-child").eq(0).width();
    var _index = 0;
    var timer = null;
    var flag = true;
    rightArrow.on("click", function() {
        //右箭头
        flag = false;
        clearInterval(timer);
        _index++;
        selectPic(_index);
    });
    leftArrow.on("click", function() {
        //左箭头
        flag = false;
        clearInterval(timer);
        if (_index == 0) {
            _index = innerGroup.length - 1;
            $(".inner").css("left", -(innerGroup.length - 1) * imgWidth);
        }
        _index--;
        selectPic(_index);
    });
    spanGroup.on("click", function() {
        //导航切换
        _index = spanGroup.index($(this));
        selectPic(_index);
    });

    $(".scenic_pictures").hover(function() {
        //鼠标移入
        clearInterval(timer);
        flag = false;
    }, function() {
        flag = true;
        timer = setInterval(go, 3000);
    });

    function autoGo(bol) {
        //自动行走
        if (bol) {
            timer = setInterval(go, 3000);
        }
    }
    autoGo(flag);

    function go() {
        //计时器的函数
        _index++;
        selectPic(_index);
    }
    function selectPic(num) {
        $(".scenicpic_pagination span").eq(num).addClass("scenicpic_active").siblings().removeClass("scenicpic_active");
        $(".inner").animate({
            left: -num * imgWidth
        }, 1000, function() {
            //检查是否到最后一张
            if (_index == innerGroup.length - 1) {
                _index = 0;
                $(".inner").css("left", "0px");
                $(".scenicpic_pagination span").eq(0).addClass("scenicpic_active").siblings().removeClass("scenicpic_active");
            }
        })
    }
};

