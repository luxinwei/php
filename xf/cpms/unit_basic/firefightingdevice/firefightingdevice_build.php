
<?php include '../../../authen/include/page/top.php';?>
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
    <div class="fr">
        <input type="button" value="保存" id="btn_save" class="hmui-btn  ml10"/>
        <input type="button" value="重置" id="btn_reset" class="hmui-btn ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
    </div>
    <div class="cb"></div>
<div id="tbody_content"></div>
<table width="1200" class="hmui-form">
  <tr>
    <th width="18%"><font class="cred">*</font>设施名称</th>
    <td width="32%"><input class="hmui-input w" id="fightingname"/></td>
    
    <th  width="18%"><font class="cred">*</font>所属建筑物</th>
    <td  width="32%"><input class="hmui-input w" id="buildingId" buildIdValue=""  readonly="readonly"/></td>
      </tr>
    <tr>
    <th><font class="cred">*</font>所属重点部位</th>
    <td ><input class="hmui-input w" id="impPartId" impPartIdValue="" readonly="readonly"/></td>
    <th ><font class="cred">*</font>设置位置</th>
    <td><input  class="hmui-input w" id="position"/></td>
  </tr>
  <tr>
    <th><font class="cred">*</font>设施系统形式</th>
    <td>
    	<select class="hmui-select w"  id="systemForm" name="systemForm">
	    <option value="">请选择设施系统</option>
	    
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStrFiter("systemForm","", "1,2,3,4,5,6,7")?>
	    </select>
    </td>
    <th><font class="cred">*</font>设施型号</td>
    <td><input class="hmui-input w" id="model"/></td>
  </tr>
  <tr>
	    <th><font class="cred">*</font>区号</th>
	    <td><input class="hmui-input w" id="areaNum"/></td>
	    <th><font class="cred">*</font>位号</th>
	    <td><input class="hmui-input w" id="bitNum"/></td>
  </tr>
	    <tr id="zhuijia">
	    <th><font class="cred">*</font>楼层号</th>
	    <td ><input class="hmui-input w" id="floor"/></td>
	    <th><font class="cred">*</font>投入使用时间</th>
	    <td ><input class="hmui-input w" id="serviceTime"  /></td>
  </tr>

</table>

<!-- ============================================ -->
<table width="1200" class="hmui-form" id="systemForm_display">
 <tbody width="1200">
<tr id="systemForm_content">
	<th width="18%"><span id="imgName"></span><span>平面图</span></th>
    <td colspan="3" width="82%">
 	    <div style="width: 34%;height:150px;border: 1px solid #8a8e98;padding:20px ">
 	     	<img src="img/1b.jpg" id="btn_addImg" style="width: 100%;height: 100%;">
 	     	<input type="hidden" id="file">
 	     	<input type="hidden" id="filebase64">
 	     	<input type="hidden" id="iconPosition">
 	     	<input type="hidden" id="fileName">
 	    </div>
    </td>
</tr>	
</tbody>
	</table>
 
 <!-- ============================================ -->
<table width="1200" class="hmui-form">
<tr>
    <th width="18%"><font class="cred">*</font>设施服务状态</th>
    <td  width="32%">
       	<select class="hmui-select w""  id="serviceStateCode" name="serviceStateCode">
	    <option value="">请选择设施服务状态</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("serviceStateCode", "")?>
	    </select>
    </td>
    <th width="18%"><font class="cred">*</font>状态描述</th>
    <td width="32%"><input class="hmui-input w  "   id="stateDescription"  /></td>
</tr>
 <tr>
    <th><font class="cred">*</font>设施状态</th>
    <td>
    	<select class="hmui-select w""  id="runStateCode" name="runStateCode">
	    <option value="">请选择设施状态</option>
	    <?php echo DicationaryUtil::getInstance()->getSelectOptionCodeStr("runStateCode", "")?>
	    </select>
    </td>
    <th><font class="cred">*</font>状态变化时间</th>
    <td><input class="hmui-input w" id="stateChangeTime"  /></td>
 </tr>
<tr>
    <th><font class="cred">*</font>生产单位</th>
    <td><input class="hmui-input w" id="productName"/></td>
    <th><font class="cred">*</font>生产单位电话</th>
    <td><input class="hmui-input w" id="productTel"/></td>
 </tr>
 <tr>
    <th><font class="cred">*</font>维修保养单位</th>
    <td><input class="hmui-input w" id="maintenanceName"/></td>
    <th><font class="cred">*</font>维修保养电话</th>
    <td><input class="hmui-input w" id="maintenanceTel"/></td>
 </tr>

  <tr>
    <th><font class="cred">*</font>绑定摄像头编号</th>
    <td><input class="hmui-input w" id="cameraNum"/></td>
    <th><font class="cred">*</font>摄像头拍摄位</th>
    <td><input class="hmui-input w" id="shootingAngle"/></td>
 </tr>
	<input type="hidden" id="depId">
</table>

</div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
var deviceTypeCode_jsarray=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("deviceType")?>;

</script>           
<script type="text/javascript" src="js/firefightingdevice_build.js"></script>
<script type="text/javascript" src="js/build.js"></script>