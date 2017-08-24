
function executeScript(html) {
    var reg = /<script[^>]*>([^\x00]+)$/i;
    //对整段HTML片段按<\/script>拆分
    var htmlBlock = html.split("<\/script>");
    for (var i in htmlBlock) {
        var blocks;//匹配正则表达式的内容数组，blocks[1]就是真正的一段脚本内容，因为前面reg定义我们用了括号进行了捕获分组
        if (blocks = htmlBlock[i].match(reg)) {
            //清除可能存在的注释标记，对于注释结尾-->可以忽略处理，eval一样能正常工作
            var code = blocks[1].replace(/<!--/, '');
            try {
                var result =eval("("+code+")");
                return result; //执行脚本
            }catch (e) {
                return null;
            }
        }
    }
}

function postJSON(url,param,callback) {
    $.ajax({
        url: url+"?token="+$("#tk").val(),
        type: "post",
        data: param,
        dataType: "json",
        success: callback,
        beforeSend:function (XMLHttpRequest) {
            console.log(param);
        },
        complete:function (ret) {
            var jsn =eval('('+ret.responseText+')');
            $("#tk").val(jsn.data.token);
        },
        error:function (XMLHttpRequest, textStatus, errorThrown) {
            executeScript(XMLHttpRequest.responseText);
        }
    });
}


function showAlert(msg,callback) {
    $(".weui_dialog_bd").html(msg);
    $("#dialog2").css("display","block");
    $(".weui_btn_dialog").on("click",callback);
}

/**
 分界线=============================分界线=============================分界线=============================分界线=============================
 **/
