<?php include '../../../authen/include/page/top.php';?>
<?php 
$id=Fun::request("id");   
?>




<div align="center" style="background-color: #FFFFFF;min-height:750px" class="mt10 p20 hmui-shadow">
  <span  class="fr">
		<input type="button" value="返回" id="btn_history" class="hmui-btn"/>
	</span>
	<div id="detail"></div>
  <div class="cb"></div>
  <h3 class="l30 p10 f20" id="codename"> </h3>
  <p class="pl10 f14" style="color:#ff7676">输入人：<span id="createUser"></span>&nbsp;&nbsp;&nbsp;颁发日期：<span  id="createTime"></span>&nbsp;执行日期:<span id="implementDate"></span></p>
  <h4 class="p10 tc" style="color:#ff7676">文件：<span id="fireLawCode"></span> &nbsp;颁布机关:<span id="promulgateOffice"></span> &nbsp;批准机关：<span id="approveOffice"></span></h4>
  <h4 class="p10 tc" style="color:#ff7676">颁布文号:<span id="promulgateNo"></span> </h4>
  <div class="p10 l30 f18 tj" id="content" style="width:1200px;line-height:32px;color:#626c81">
  <span id="content"></span>
  <!-- 
    1月20日，省十二届人大常委会第三十三次会议在郑州召开，会议表决通过了关于召开省十三届人大一次会议的有关议案。省委书记、省人大常委会主任谢伏瞻主持闭幕会并讲话，副主任刘春良、刘满仓、蒋笃运、储亚平、李文慧、赵建才、王保存、段喜中和秘书长丁巍出席会议。
    会议传达学习了省委十届五次全会和省委经济工作会议精神。听取和审议各项议案后，会议表决通过了河南省第十三届人民代表大会第一次会议主席团和秘书长建议名单草案，河南省第十三届人民代表大会第一次会议议案审查委员会建议名单草案，河南省第十三届人民代表大会第一次会议计划、财政预算审查委员会建议名单草案，河南省第十三届人民代表大会第一次会议建议议程草案，并决定将以上草案提请河南省第十三届人民代表大会第一次会议预备会议进行表决；表决通过了河南省第十三届人民代表大会第一次会议列席人员、邀请人员名单，关于省十三届人大代表的代表资格审查报告，河南省人民代表大会常务委员会工作报告稿，河南省人民代表大会常务委员会关于省监察委员会副主任、委员任免办法的决定，关于接受孟伟辞去第十二届全国人民代表大会代表职务的议案。会议表决通过了人事任免事项，任命何金平为省人民政府副省长。有关被任命人员作了任职前发言，进行了宪法宣誓。
    完成各项议程后，谢伏瞻作了讲话。他说，省十三届人大一次会议即将召开，要把坚持党的领导贯穿于大会的全过程和各方面，把严肃大会纪律摆在更加突出的位置，把保持良好会风作为重要保障，严格贯彻执行中央八项规定和实施细则精神，高质量做好各项工作，确保大会顺利进行、圆满成功。
    谢伏瞻说，过去五年，省十二届人大常委会认真贯彻落实党的十八大和十九大精神，深入学习贯彻习近平新时代中国特色社会主义思想，坚持党的领导、人民当家作主、依法治国有机统一，坚决维护习近平总书记党的领袖和核心地位，坚决维护以习近平同志为核心的党中央权威和集中统一领导，紧紧围绕全省大局履职尽责，有效发挥立法引领和推动作用，监督和支持“一府两院”依法行政、公正司法，切实加强和改进重大事项决定工作，依法做好换届选举、人事任免和代表工作，圆满完成了各项工作任务。省委对省十二届人大常委会的工作是充分肯定的。
    谢伏瞻说，本届省人大常委会任期即将届满，一部分同志因为年龄原因，将在换届后离开人大工作岗位，一部分同志将不再担任省人大常委会委员。我代表省委、省人大常委会，向大家付出的辛勤劳动表示衷心的感谢。希望同志们一如既往关注、服务和推动全省发展大局，继续为河南经济社会发展贡献力量。
    副省长徐济超、戴柏华，省高级人民法院院长张立勇和省人民检察院检察长蔡宁列席会议。 -->
  </div>
  <!--
<table border="0" cellpadding="0" cellspacing="0" class="hmui-form" width="1200">
  <tr>



  </tr>
  <tr>
    <th width="160px;"><font class="cred"></font>法规名称</th>
    <td><span id="codename"></span></td>
    <th  width="150px;"><font class="cred"></font>法规类别</th>
    <td><span id="fireLawCode"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>颁布机关</th>
    <td><span id="promulgateOffice"></span></td>
    <th><font class="cred"></font>批准机关</th>
    <td><span id="approveOffice"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>颁布文号</th>
    <td><span id="promulgateNo"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>颁布日期</th>
    <td><span id="promulgateDate"></span></td>
    <th><font class="cred"></font>实施日期</th>
    <td><span id="implementDate"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>输入人姓名</th>
    <td><span id="createUser"></span></td>
  </tr>
  <tr>
    <th><font class="cred"></font>文章内容</th>
    <td colspan="3"><span id="content"></span></td>
  </tr>
</table>
</div>
-->
<?php include '../../../authen/include/page/bottom.php';?>   
<script type="text/javascript">
 
var fireLawCode_jsarry=<?php echo DicationaryUtil::getInstance()->getCodeJsArray("fireLawCode")?>; 
var id="<?php echo $id?>";
</script>
        
<script type="text/javascript" src="js/firekonwledge_detail.js"></script>