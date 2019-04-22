<?php include '../../../authen/include/page/top.php';?>
<?php
// 获取id
$id=Fun::request("id");//获取id 根据此id进行修改:必须要有的
?>
<div align="center" style="background:#FFFFFF;min-height:750px"  class="p20 mt10 hmui-shadow">
    <div class="fr">
        <input type="button" value="编辑" id="btn_edit" class="hmui-btn  ml10"/>
        <input type="button" value="返回" id="btn_history" class="hmui-btn  ml10"/>
    </div>
    <div class="cb"></div>
<table width="1200" class="hmui-table2">
    <tr>
      <th width="15%">名称</th>
      <td width="35%"><span id="buildname"></span></td>
      <th width="15%">类别</th>
      <td width="35%"><span id="buildingTypeCode"></span></td>
    </tr>
    <tr>
      <th>建造日期</th>
      <td><span id="buildTime"></span></td>
      <th>使用性质</th>
      <td><span id="buildingUseKindCode"></span></td>
    </tr>
    <tr>
      <th>火灾危险性</th>
      <td><span id="buildingFireDangerCode"></span></td>
      <th>耐火等级</th>
      <td><span id="buildingResistFireCode"></span></td>
    </tr>
      <tr>
      <th>结构类型</th>
      <td><span id="buildingStructureCode"></span></td>
      <th>建筑高度</th>
      <td><span id="buildHeight"></span><span>（m）</span></td>
    </tr>
      <tr>
      <th>建筑面积</th>
      <td><span id="overallFloorage"></span><span>（㎡）</span></td>
      <th>占地面积</th>
      <td><span id="floorSpace"></span><span>（㎡）</span></td>
    </tr>
     <tr>
      <th>标准层面积</th>
      <td><span id="standardFloorage"></span><span>（㎡）</span></td>
      <th>日常工作时间人数</th>
      <td><span id="workerNum"></span><span>（个）</span></td>
    </tr>
      <tr>
      <th>地上层数</th>
      <td><span id="aboveGroundFloors"></span><span>（层）</span></td>
      <th>地上层面积</th>
      <td><span id="aboveGroundArea"></span><span>（㎡）</span></td>
    </tr>
      <tr>
      <th>地下层数</th>
      <td><span id="underGroundFloors"></span><span>（层）</span></td>
      <th>地下层面积</th>
      <td><span id="underGroundArea"></span><span>（㎡）</span></td>
    </tr>
    <tr>
      <th>最大容纳人数</th>
      <td><span id="maxnumCapacity"></span><span>（个）</span></td>
      <th>消防控制室长度</th>
      <td><span id="controlRoomPosition"></span><span>（m）</span></td>
    </tr>
    <tr>
      <th>消防控制室联系人</th> 
      <td><span id="controlRoomPerson"></span></td> 
      <th>消防控制室电话</th>
      <td><span id="controlRoomPhone"></span></td>
    </tr>

  </table>

</div>
<div id="tbody_content"></div>
<?php include '../../../authen/include/page/bottom.php';?>
<script type="text/javascript">
  var id="<?php echo $id?>";  //将传递到js文件 :必须写的
  var buildingTypeCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingTypeCode")?>;
  var buildingUseKindCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingUseKindCode")?>;
  var buildingFireDangerCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingFireDangerCode")?>;
  var buildingResistFireCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingResistFireCode")?>;
  var monitorCenterRankCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("monitorCenterRankCode")?>;
  var buildingStructureCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("buildingStructureCode")?>;
  
</script>
<script type="text/javascript" src="js/management_detail.js"></script>