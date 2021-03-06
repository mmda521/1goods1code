<!DOCTYPE HTML>
<html>
 <head>
  <title>单品批次管理系统</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="<?php echo base_url();?>/webroot/CBS_Platform/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url();?>/webroot/CBS_Platform/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url();?>/webroot/CBS_Platform/assets/css/main-min.css" rel="stylesheet" type="text/css" />
 </head>
 <body>
  <div class="header">
    <!--
      <div class="dl-title">
        <a href="http://sc.chinaz.com" title="文档库地址" target="_blank"><!-- 仅仅为了提供文档的快速入口，项目中请删除链接 
          <span class="lp-title-port">陆港</span><span class="dl-title-text">跨境场站系统（出口）</span>
        </a>
      </div>
-->
    <div class="dl-log">欢迎您，<span class="dl-log-user"><?php echo $_SESSION['LOGIN_NO']; ?></span><a href="<?php echo site_url("login/login_out");?>" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
  </div>
   <div class="content">
    <div class="dl-main-nav">
      <div class="dl-inform"><div class="dl-inform-title">贴心小秘书<s class="dl-inform-icon dl-up"></s></div></div>
      <ul id="J_Nav"  class="nav-list ks-clear">
        <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">首页</div></li>
       <!-- <li class="nav-item"><div class="nav-item-inner nav-order">表单页</div></li>
        <li class="nav-item"><div class="nav-item-inner nav-inventory">搜索页</div></li>
        <li class="nav-item"><div class="nav-item-inner nav-supplier">详情页</div></li> -->
      </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
   </div>
  <script type="text/javascript" src="<?php echo base_url();?>webroot/CBS_Platform/assets/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>webroot/CBS_Platform/assets/js/bui.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>webroot/CBS_Platform/assets/js/config.js"></script>

  <script>
    BUI.use('common/main',function(){
      var config = [{
          id:'menu', 
          homePage : 'welcome',		  
          menu:[{
              text:'基础资料模块',
			  collapsed:true,
              items:[
			  {id:'welcome',text:'欢迎页面',href:<?php echo "'".site_url()."/location/welcome'";?>},
              {id:'location',text:'库位信息',href:<?php echo "'".site_url()."/location/index'";?>},
			  {id:'qr_add',text:'二维码生成',href:<?php echo "'".site_url()."/qr_add/index'";?>},
			  {id:'export',text:'二维码导出',href:<?php echo "'".site_url()."/qr_add/export'";?>},
			 // {id:'search',text:'查询',href:<?php echo "'".site_url()."/search/search'";?>}
              ]
            }, {
              text:'样例展示',
			  collapsed:true,
              items:[
                {id:'user_manage',text:'sample2',href:<?php echo "'".site_url()."/sample2/index'";?>},
                 
              ]
            }
			]
          },
		  ];
      new PageUtil.MainPage({
        modulesConfig : config
      });
    });
  </script>
</body>
</html>