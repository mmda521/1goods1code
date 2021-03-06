<!DOCTYPE HTML>
<html>
 <head>
  <title> 搜索表单配置项</title>
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
      <div class="span8">
        <h2>简介</h2>
        <p>框架给搜索表单提供了封装好的业务组件，文件是：assets/js/common/search.js</p>
        <p>search.js中定义了 <code>Seach</code>类，其接口右边说明。</p>
      </div>
      <div class="span16">
        <h2>Search类</h2>
        <p>此类的配置项在类初始化后，会转变成属性值，配置项：</p>
        <ol>
          <li><code>formId</code>：表单的id,默认为：searchForm</li>
          <li><code>btnId</code>：提交按钮的id,默认为：btnSearch</li>
          <li><code>gridId</code>：表格容器的id,默认为：grid</li>
          <li><code>autoSearch</code>：页面显示后，是否自动进行查询，默认为：true</li>
          <li><code>formCfg</code>：<a href="http://http://www.builive.com//docs/index.html#!/api/BUI.Form.Form" target="_blank">表单的配置项</a></li>
          <li><code>gridCfg</code>：<a href="http://http://www.builive.com//docs/index.html#!/api/BUI.Grid.Grid" target="_blank">表格的配置项</a></li>
          <li><code>store</code>：数据缓冲类</li>
        </ol>
        <p>还有几个属性：</p>
        <ol>
          <li><code>form</code>：表单控件，可以添加事件处理函数</li>
          <li><code>grid</code>：表格控件，可以添加事件处理函数</li>
        </ol>
        <pre class="prettyprint linenums">
//一般场景下，只需要配置store和gridCfg即可，其他都是用默认值
var  search = new Search({
  store : store,
  gridCfg : gridCfg
});          

//获取grid,form控件
var grid = search.get('grid'),
  from = search.get('form');

grid.on('cellclick',function(ev){
  //TODO
});
        </pre>
        <p>search提供的接口只有一个：</p>
        <ol>
          <li><code>load </code>: function(reset){} 重新发送请求，reset 参数是指是否将页码回复到第一页。</li>

        </ol>
      </div>
    </div>
    <div class="row">
      <div class="span8">
        <h2>帮助方法</h2>
        <p>Search类提供几个帮助方法：</p>
        <ol>
          <li><code>createStore</code>: 创建<a href="http://http://www.builive.com//docs/index.html#!/api/BUI.Data.Store" target="_blank">数据缓冲类对象</a></li>
          <li><code>createGridCfg</code>: 创建<a href="http://http://www.builive.com//docs/index.html#!/api/BUI.Grid.Grid" target="_blank">Grid的配置项</a></li>
          <li><code>createLink</code>: 创建<a class="page-action" data-id="quick" data-mid="menu" href="#">页面操作</a>的的链接</li>
        </ol>
      </div>
      <div class="span16">
        <h3>createStore</h3>
        <p>创建数据缓冲类的接口有2个参数：</p>
        <ol>
          <li><code>url</code>：加载数据的路径</li>
          <li><code>cfg</code>: 数据缓冲类的<a href="http://http://www.builive.com//docs/index.html#!/api/BUI.Data.Store" target="_blank">配置项</a></li>
        </ol>
        <pre class="prettyprint linenums">
//一般场景下只需指定url
store = Search.createStore('<?php echo base_url();?>/webroot/CBS_Platform/data/student.json');

//可以指定其他配置信息，例如排序信息
store = Search.createStore('<?php echo base_url();?>/webroot/CBS_Platform/data/student.json',{
  sortInfo : {
    field : 'id',
    direction : 'ASC'
  }
});
        </pre>
        <h3>createGridCfg</h3>
        <p>创建表格配置项有2个参数：</p>
        <ol>
          <li><code>columns</code>: 列配置，参看<a href="http://http://www.builive.com//docs/index.html#!/api/BUI.Grid.Column" target="_blank">详细信息</a></li>
          <li><code>cfg</code>：Grid的配置信息，可以定义Grid的其他属性。</li>
        </ol>
        <pre class="prettyprint linenums">
var columns = [
    {title:'学生编号',dataIndex:'id',width:80,renderer:function(v){
      return Search.createLink({
        id : 'detail' + v,
        title : '学生信息',
        text : v,
        href : 'detail/example.php'
      });
    }},
    {title:'学生姓名',dataIndex:'name',width:100},
    {title:'生日',dataIndex:'birthday',width:100,renderer:BUI.Grid.Format.dateRenderer},
    {title:'学生性别',dataIndex:'sex',width:60,renderer:BUI.Grid.Format.enumRenderer(enumObj)},
    {title:'学生班级',dataIndex:'grade',width:100},
    {title:'学生家庭住址',dataIndex:'address',width:300}
  ],
//一般情形下，只需要配置列信息即可
gridCfg = Search.createGridCfg(columns);


//配置工具栏
gridCfg = Search.createGridCfg(columns,{
  tbar : {
    // items:工具栏的项， 可以是按钮(bar-item-button)、 文本(bar-item-text)、 默认(bar-item)、 
    // 分隔符(bar-item-separator)以及自定义项 
    items:[{
        xclass:'bar-item-button',
        btnCls : 'button button-small',
        text:'命令一'
    }, {
        //xclass:'bar-item-text',
        content:'<a href="#">链接</a>'
    }]
  }
});
        </pre>
        <h3>createLink</h3>
        <p>为了在表格内部打开页面，例如查看详情、编辑记录等可以通过这个方法来生成页面链接。</p>
        <p>这个方法只有一个参数：<code>cfg</code>，cfg支持下面几个字段：</p>
        <ol>
          <li><code>id</code>: 页面id,唯一标示页面的id,用于反复打开同一个页面时，始终在一个tab上打开</li>
          <li><code>href</code>:</li>
          <li><code>title</code>: 页面标题</li>
          <li><code>text</code>: 链接显示的文本</li>
        </ol>
        <pre class="prettyprint linenums">
//在列配置中使用此方法生成链接
{title:'学生编号',dataIndex:'id',width:80,renderer:function(v){
  return Search.createLink({
    id : 'detail' + v,
    title : '学生信息',
    text : v,
    href : 'detail/example.php'
  });
}}          
        </pre>
      </div>
    </div>
    <div class="row">
      <div class="span8">
        <h2>数据格式</h2>
        <p>搜索页使用JSON跟后台进行通信包括2类数据约定</p>
        <ol>
          <li>向后台传递的参数</li>
          <li>后台传回的数据集合</li>
        </ol>
      </div>
      <div class="span16">
        <h3>请求参数</h3>
        <p>除了提供表单的字段值外，还提供以下参数：</p>
        <ol>
          <li><code>start</code>: 开始记录的起始数，如第 20 条,从0开始</li>
          <li><code>limit</code> : 单页多少条记录</li>
          <li><code>pageIndex</code> : 第几页，同start参数重复，可以选择其中一个使用</li>
        </ol>
        <h3>传回的数据集合</h3>
        <p>常见形式：</p>
        <pre class="prettyprint linenums">
{
  "rows" : [{},{}], //数据集合
  "results" : 100, //记录总数
  "hasError" : false, //是否存在错误
  "error" : "" // 仅在 hasError : true 时使用
}
        </pre>
        <ol>
          <li><code>rows</code>: 传回的数据集合</li>
          <li><code>results</code> : 记录总数</li>
          <li><code>hasError</code> : 只有出错的时候提供此字段</li>
          <li><code>error</code>:出错信息，仅在 hasError : true 时使用</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="span8">
        <h2>限制输出列</h2>
        <p>有时候根据不同的角色来输出不同的列，可以通过以下方式：</p>
        <ol>
          <li>后台控制列：使用后台脚本控制列的输出</li>
          <li>前台控制列：前台JS控制列的显示隐藏</li>
        </ol>
      </div>
      <div class="span16">
        <h3>后台限制输出</h3>
        <p>以php作为示例：</p>
        <pre class="prettyprint linenums">
var columns = [
  {dataIndex : 'a',title : 'a'},
  &lt;?php if($user){?&gt;
  {dataIndex : 'b',title : 'b'},
  &lt;?php } else{ ?&gt;
  {dataIndex : 'c',title : 'c'},
  &lt;?php }?&gt;
  {dataIndex : 'd',title : 'd'}
];
        </pre>
        <h3>前台控制显示</h3>
        <p>可以设置列的显示隐藏，使用<code>visible</code>属性</p>
        <pre class="prettyprint linenums">
var columns = [
  {dataIndex : 'a',title : 'a'},
  {dataIndex : 'b',title : 'b', visible: false},
  {dataIndex : 'c',title : 'c'},
  {dataIndex : 'd',title : 'd',visible : false}
];
        </pre>
        <p>你也可用用Js控制</p>
        <pre class="prettyprint linenums">
var user = <?php echo $user ?>,
  columns = [
  {dataIndex : 'a',title : 'a'},
  {dataIndex : 'b',title : 'b'},
  {dataIndex : 'c',title : 'c'},
  {dataIndex : 'd',title : 'd'}
];

BUI.each(columns,function(col){
  if(col.dataIndex == 'b' && user == '1'){
    col.hide == true;
  }
  //else ....
});

var grid = new Grid({
  columns : columns
});
        </pre>
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