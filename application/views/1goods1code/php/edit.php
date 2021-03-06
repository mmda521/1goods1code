<!DOCTYPE HTML>
<html>
 <head>
  <title> 编辑学生信息</title>
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
    <form id ="J_Form" class="form-horizontal" action="success.php">
      <h3>基本信息</h3>
      <div class="row">
        <div class="control-group span12">
          <label class="control-label"><s>*</s>学生姓名：</label>
          <div class="controls">
            <input name="sname" type="text" class="control-text" data-rules="{required:true}">
          </div>
        </div>
        <div class="control-group span12">
          <label class="control-label"><s>*</s>学生编号：</label>
          <div class="controls">
            <input name="sid" type="text" class="control-text" data-rules="{required:true}">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="control-group span12">
          <label class="control-label">性别：</label>
          <div class="controls">
            <select name="sex">
              <option value="0">男</option>
              <option value="1">女</option>
            </select>
          </div>
        </div>
        <div class="control-group12 span12">
          <label class="control-label"><s>*</s>出生日期：</label>
          <div class="controls">
            <input name="birthday" type="text" class="calendar" data-rules="{required:true}">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="control-group span12">
          <label class="control-label"><s>*</s>家庭住址：</label>
          <div class="controls">
            <input name="address" type="text" class="span8 span-width control-text"  data-rules="{required:true}">
          </div>
        </div>
      </div>
      <hr/>
      <h3>学校信息</h3>
      <div class="row">
        <div class="control-group span12">
          <label class="control-label"><s>*</s>学校名称：</label>
          <div class="controls">
            <input name="" type="text" class=" control-text" data-rules="{required:true}">
          </div>
        </div>
        <div class="control-group span12">
          <label class="control-label"><s>*</s>入学日期：</label>
          <div class="controls bui-form-group" data-rules="{dateRange:true}" >
            <input name="start" type="text" class="calendar" data-rules="{required:true}"><span> - </span><input name="end" type="text" class="calendar" data-rules="{required:true}">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="control-group span24">
          <label class="control-label"><s>*</s>学校地址：</label>
          <div class="controls">
            <input type="text" class="control-text span8 span-width"  data-rules="{required:true}">
          </div>
        </div>
        
      </div>
      <div class="row">
        <div class="control-group span24">
          <label class="control-label">备注：</label>
          <div class="controls control-row4">
            <textarea name="" id="" class="span8 span-width"></textarea>
          </div>
        </div>
      </div>
      <hr/>
      <h3>教育经历</h3>
      <div class="row">
        <div class="span21 offset3 control-row-auto">
          <div id="grid"></div>
        </div>
      </div>
      
      <div class="row">
        <div class="form-actions offset3">
          <button type="submit" class="button button-primary">保存</button>
          <button type="reset" class="button">重置</button>
        </div>
      </div>
    </form>

    <div id="J_Temp" class="hide">
       <form class="form-horizontal" id="J_Education">
        <div class="row">
          <div class="control-group span6">
            <label class="control-label control-label-small"><s>*</s>学校名称</label>
            <div class="controls">
               <input type="text" class="control-text" name="school"/>
               <input type="hidden" name="id" />
            </div>
          </div>
          <div class="control-group span6">
            <label class="control-label control-label-small"><s>*</s>学校网址</label>
            <div class="controls">
               <input type="text" class="control-text" name="url"/>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="control-group span6">
            <label class="control-label control-label-small"><s>*</s>入学日期</label>
            <div class="controls">
               <input type="text" class="calendar" name="enter"/>
            </div>
          </div>
          <div class="control-group span6">
            <label class="control-label control-label-small"><s>*</s>毕业日期</label>
            <div class="controls">
               <input type="text" class="calendar" name="outter"/>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="control-group span12">
            <label class="control-label control-label-small"><s>*</s>备注：</label>
            <div class="controls control-row4">
              <textarea name="memo" class="span9 span-width"></textarea>
            </div>
          </div>
        </div>
        <input type="hidden"  id="J_Records"/>
       </form>
  </div>
  <script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/bui-min.js"></script>

  <script type="text/javascript" src="<?php echo base_url();?>/webroot/CBS_Platform/assets/js/config-min.js"></script>
  <script type="text/javascript">
    BUI.use('common/page');
  </script>
  <script type="text/javascript">
    BUI.use('bui/form',function (Form) {
      var form = new Form.HForm({
        srcNode : '#J_Form'
      }).render();
    });
  </script>

<body>
</html>  