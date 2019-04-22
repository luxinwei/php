<?php include '../../../authen/include/page/top.php';?>
<div class="mt10"></div>
<div class="hmui-shadow">
    <form name="myform" class="alert_info" id="myform">
 		<select name="appCode" id="appCode" class="hmui-input3 w200">
       <option value="0" selected="selected">请选择应用</option>
       </select>
        <input  placeholder="请输入关键字" class="hmui-input3 w300" id="name" name="name"/><input type="button" value="搜索" class="hmui-btn ml5" id="btn_search"/>
        <span class="fr">
              <input type="button" value="新建" class="hmui-btn" id="btn_add" />
            <input type="button" value="编辑" class="hmui-btn ml10" id="btn_edit"/>
            <input type="button" value="删除" class="hmui-btn ml10" id="btn_del" />
        </span>

    </form>
    <table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
        <tr>
            <th class="tc" width="30"><input type="checkbox" class="hmui-checkbox" name="checkbox"></th>
            <th width="40">ID</th>
            <th>角色名称</th>
            <th>描述</th>
             <th width="150">appCode</th>
            <th class="tc" width="100">操作</th>
        </tr>
        <tbody id="tbody_content"></tbody>
    </table>
    <div id="pageNav" class="mt10"></div>
    <div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>
<script type="text/javascript" src="js/rolemanagement_list.js"></script>