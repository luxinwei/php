<?php include '../../../authen/include/page/top.php';?>



<div align="center" style="background-color:#FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
    <span  class="fr">
		<input type="button" value="保存" id="btn_save" class="hmui-btn ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn ml10"/>
		<input type="button" value="返回" id="btn_history" class="hmui-btn ml10"/>
	</span>
    <div class="cb"></div>
<style>  
#div1{width: 1200px;border: 1px solid #000}
#div2{width: 1200px;height:300px;border: 1px solid #000}
 .toolbar {
            border: 1px solid #ccc;
            width:100%;
            background-color:#fff;
        }
 .text {
            border: 1px solid #ccc;
            height:300px;
            background-color:#fff;
        }
</style>
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form">
 <tr>
    <th>公告范围</th>
    <td>
        	 <select class="hmui-select w"  id="bulletinAreaCode">
	    <option value="">请选择公告范围</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("bulletinAreaCode", "")?>
	    </select> 
     </td>
    <th>公告范围值</th>
    <td><input  class="hmui-input w" id="scopeValue"/></td>
  </tr>
  <tr>
  <th>公告状态</th>
    <td>
       <select class="hmui-select w"  id="dataStateCode">
	    <option value="">请选择公告状态</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("dataStateCode", "")?>
	    </select> 
    </td>
   <th>输入人姓名</th>
    <td><input class="hmui-input w" id="createUser"/></td>
  </tr>
    <tr>
   <th>输入日期</th>
    <td><input class="hmui-input w" id="createTime" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});"/></td>
  </tr>
  
  <tr>
   	<th><font class="cred">*</font>新闻内容</th>
    <td colspan="3">
     <div id="div1" class="toolbar"></div>
	 <div id="div2" class="text"> <!--可使用 min-height 实现编辑区域自动增加高度--> </div>
	<textarea id="content" name="content" style="width:100%; height:200px;display: none"></textarea>
    </td>
   </tr>
 
  </table>

</div>
<div id="tbody_content"></div>
<script type="text/javascript" src="../../../etc/js/wangEditor.min.js"></script>
<?php include '../../../authen/include/page/bottom.php';?>          
<script type="text/javascript" src="js/systembulletin_build.js"></script>