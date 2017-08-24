/**
 * Created by �˿��� on 2016/10/14.
 */
$(".index_Bg").css("height",document.documentElement.clientHeight+"px");
setTimeout(function(){$(".index_gift").removeClass("None")},100);
$(".index_bag_close").addClass("Ani_Close");
$(".index_bag_Open").addClass("Ani_Open").removeClass("None");
setTimeout(function(){$(".index_bag_close").addClass("None");},800);
$(".details_one").eq(0).css("marginTop",0);
$(".Details").css({"height":$(".detalis_con").css("height")})
/*首页弹出活动细则*/
$(".left_index").on("click",function () {
          if($(this).find("img").attr("src")=="http://bn15897782.imwork.net/1goods1code/webroot/OGOC/images/aside.png") {
              $(this).find("img").attr("src", "http://bn15897782.imwork.net/1goods1code/webroot/OGOC/images/Pack_up_rules.png");
          }else{
              $(this).find("img").attr("src","http://bn15897782.imwork.net/1goods1code/webroot/OGOC/images/aside.png");
          }
          $(".Alert_details").toggleClass("None");
          $(".Zhezhao").toggleClass("None");
          $(".Opacity_Bg").toggleClass("None");
})
$(".top-myprize").css({"left":($(window).width()-$(".top-myprize").width())/2+"px"});
$(".Left").css('height',$(window).height()+"px")