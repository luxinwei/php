<?php include '../../../authen/include/page/top.php';?>
<div class="mt10 hmui-shadow">
    <form  id="myform" class="alert_info">
        <input name="name"  placeholder="请输入关键字" class="hmui-input w300"/>
        <span>设施类型</span>
        <select class="hmui-input w200"  id="systemForm" name="systemForm">
            <option value="">周报</option>
            <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("systemForm", "")?>
        </select>
        <input type="button" value="搜索" class="hmui-btn" id="btn_search"/>
    </form>
    <table border="0" cellpadding="0" cellspacing="0" class="hmui-grid" width="100%">
        <tr>
            <th><input type="checkbox" name="selectall" class="hmui-checkbox" onclick="checkBoxAll('key','selectall');" /></th>
            <th>报告名称</th>
            <th>报告类型</th>
            <th>内容时间</th>
            <th class="tc" width="100">操作</th>
        </tr>

        <tbody id="tbody_content"></tbody>
    </table>
    <div id="pageNav" class="mt20"></div>
    <div class="h50"></div>
</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
</script>
<script type="text/javascript" src="js/generalreport_detail.js"></script>