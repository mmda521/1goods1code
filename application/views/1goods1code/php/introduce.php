<?php $title="详情页简介"?>
<?php include("header.php"); ?>  
  <div class="container">
    <div class="row">
      <div class="span8">
        <h2>简介</h2>
        <p>详情页包含以下内容：</p>
        <ol>
          <li>详情区块，包含</li>
          <li>多个详情行</li>
          <li>显示数据的表格</li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="span8">
        <h2>详情区块</h2>
        <p>包含子标题和多个详情行</p>
      </div>
      <div class="span16">
        <h2>代码</h2>
        <pre class="prettyprint linenums">
&lt;div class="detail-section"&gt;  
  &lt;h3&gt;基本信息&lt;/h3&gt;
  &lt;div class="row detail-row"&gt;
    &lt;div class="span8"&gt;
      &lt;label&gt;姓名：&lt;/label&gt;&lt;span class="detail-text"&gt;张三&lt;/span&gt;
    &lt;/div&gt;
    &lt;div class="span8"&gt;
      &lt;label&gt;编号：&lt;/label&gt;&lt;span class="detail-text"&gt;1223&lt;/span&gt;
    &lt;/div&gt;
     &lt;div class="span8"&gt;
      &lt;label&gt;性别：&lt;/label&gt;&lt;span class="detail-text"&gt;男&lt;/span&gt;
    &lt;/div&gt;
  &lt;/div&gt;
  &lt;div class="row detail-row"&gt;
    &lt;div class="span8"&gt;
      &lt;label&gt;班级：&lt;/label&gt;&lt;span class="detail-text"&gt;一年级一班&lt;/span&gt;
    &lt;/div&gt;
    &lt;div class="span8"&gt;
      &lt;label&gt;年龄：&lt;/label&gt;&lt;span class="detail-text"&gt;21&lt;/span&gt;
    &lt;/div&gt;
     &lt;div class="span8"&gt;
      &lt;label&gt;家庭住址：&lt;/label&gt;&lt;span class="detail-text"&gt;速度发撒旦法师打法是否撒反对撒范德萨发撒旦法倒萨发生&lt;/span&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;
        </pre>
      </div>
    </div>
    <div class="row">
      <div class="span8">
        <h2>显示列表</h2>
        <p>详情页中的列表往往仅显示数据，所以使用简单列表</p>
      </div>
      <div class="span16">
        <h2>代码</h2>
        <pre class="prettyprint linenums">
BUI.use('bui/grid',function (Grid) {          
  var data = [
    {id:'1112',name:'李四',day:1349622209547,address:'上海市浦东新区杨高北路938号'},
    {id:'1112',name:'李四',day:1349622209547,address:'上海市浦东新区杨高北路938号'},
    {id:'1112',name:'李四',day:1349622209547,address:'上海市浦东新区杨高北路938号'},
    {id:'1112',name:'李四',day:1349622209547,address:'上海市浦东新区杨高北路938号'}],
   
  grid = new Grid.SimpleGrid({
    render : '#grid', //显示Grid到此处
    width : 950,      //设置宽度
    columns : [
      {title:'学生编号',dataIndex:'id',width:80},
      {title:'学生姓名',dataIndex:'name',width:100},
      {title:'入学时间',dataIndex:'day',width:100,renderer:Grid.Format.dateRenderer},
      {title:'学生家庭住址',dataIndex:'address',width:300}
    ]
  });
  grid.render();
  grid.showData(data);
});
        </pre>
      </div>
    </div>
  </div>
<?php include("script.php"); ?> 
<?php include("footer.php"); ?>  