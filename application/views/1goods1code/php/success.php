<!DOCTYPE HTML>
<html>
 <head>
  <title> 页面操作快捷方式</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
       <link href="<?php echo base_url();?>/webroot/CBS_Platform/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>/webroot/CBS_Platform/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>/webroot/CBS_Platform/assets/css/page-min.css" rel="stylesheet" type="text/css" />   <!-- 下面的样式，仅是为了显示代码，而不应该在项目中使用-->
   <link href="<?php echo base_url();?>/webroot/CBS_Platform/assets/css/prettify.css" rel="stylesheet" type="text/css" />
   <style type="text/css">
    code {
      padding: 0px 4px;
      color: #d14;
      background-color: #f7f7f9;
      border: 1px solid #e1e1e8;
    }
   </style>
 </head>
 <body>
  
  <div class="container">
    <div class="row">
      <div class="span10">
        <div class="tips tips-large tips-success">
          <span class="x-icon x-icon-success"><i class="icon icon-ok icon-white"></i></span>
          <div class="tips-content">
            <h2>成功信息</h2>
            <p class="auxiliary-text">
              你可以继续操作以下内容：
            </p>
            <p>
              <a class="page-action" data-type="setTitle" title="编辑用户个性化功能权限" href="userFunc.html">编辑用户个性化功能权限</a>
              <a class="page-action" data-type="setTitle" title="配置用户数据权限" href="userData.html">配置用户数据权限</a>
              <a class="page-action" data-type="setTitle" title="返回用户管理" href="userManage.html">返回用户管理</a>
            </p>
          </div>
        </div>
      </div> 
    </div>
  </div>
  <script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/bui-min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/config-min.js"></script>
  <script type="text/javascript">
    BUI.use('common/page');
  </script>
  <!-- 仅仅为了显示代码使用，不要在项目中引入使用-->
  <script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/prettify.js"></script>
  <script type="text/javascript">
    $(function () {
      prettyPrint();
    });
  </script> 

<body>
</html>  