<?php include '../../../manage/include/page/top.php';?>
<?php include dirname(__FILE__)."/../../../com/base/util/MysqlInfo.class.php";?>

只有连接数据库是mysql的 情况下才能生成；
<br/>
<?php
//select TABLE_SCHEMA,TABLE_NAME,TABLE_COMMENT from `TABLES` where TABLE_SCHEMA='hm_site';
//SELECT  data_type,count(*)  from COLUMNS where TABLE_SCHEMA='hm_site' group by data_type;
//SELECT table_name,column_name,data_type,CHARACTER_MAXIMUM_LENGTH,column_comment  from COLUMNS where TABLE_SCHEMA='hm_site';
/*
$tables=DB::getInstance()->getTableArray();
$content="";
foreach ($tables as $tablename){
	$content.="\nDROP TABLE ".$tablename.";";	
}

foreach ($tables as $tablename){
	$content.="\nCREATE TABLE ".$tablename."(";
	$cols=DB::getInstance()->getColArray($tablename);
	for ($i=0;$i<count($cols);$i++){
		$colObj=$cols[$i];
 		$primary_key=$colObj->primary_key;
 		$not_null=$colObj->not_null;
 		$max_length=$colObj->max_length;
		$colname=$colObj->name;
		$type=strtolower($colObj->type);
		if($colname=="POST"){
			var_dump($colObj);
		}
		
		
		
		$type_str="";
		if($type=="string")$type_str="VARCHAR(".$max_length.")";
		if($type=="int")$type_str="INTEGER";
		$content.="\n\t";
		if($i==0)$content.=" ";
		if($i!=0)$content.=",";
		$content.=$colname." ".$type_str;
	
		if($primary_key==1)$content.=" PRIMARY KEY NOT NULL";
 		//echo "$".$primary_key."|".$not_null."|".$max_length."|".$colname."|".$type;
 		//if($type=="string")continue;
 		//if($type=="int")continue;
 		//echo "$".$type;
		
	}
	$content.="\n);";
}
*/
$tables=MysqlInfo::getInstance()->getTableArray();
$content="";
foreach ($tables as $tableObj){
	$tablename=$tableObj["TABLE_NAME"];
	$comment["TABLE_COMMENT"];
	$content.="\nDROP TABLE ".$tablename.";";
}

foreach ($tables as $tableObj){
$tablename=$tableObj["TABLE_NAME"];
	$content.="\nCREATE TABLE ".$tablename."(";
	$cols=MysqlInfo::getInstance()->getColArray($tablename);
	for ($i=0;$i<count($cols);$i++){
		$colObj=$cols[$i];
		$primary_key=strtolower($colObj["COLUMN_KEY"]);
		$not_null=$colObj["IS_NULLABLE"];
		$max_length=$colObj["CHARACTER_MAXIMUM_LENGTH"];
		$colname=$colObj["COLUMN_NAME"];
		$type=strtolower($colObj["DATA_TYPE"]);
		
		$type_str="";
		if($type=="varchar")$type_str="VARCHAR(".$max_length.")";
		//if($type=="varchar")$type_str="CHAR(".$max_length.")";
		if($type=="int")$type_str="INTEGER";
		$content.="\n\t";
		if($i==0)$content.=" ";
		if($i!=0)$content.=",";
		$content.=$colname." ".$type_str;
		if($primary_key=="pri")$content.=" PRIMARY KEY NOT NULL";
		$content.="  --".$colObj["COLUMN_COMMENT"];
		
	}
	$content.="\n);";
}
?>

<textarea style="width: 800px;height:600px;"><?php echo $content;?></textarea>
<?php include '../../../manage/include/page/bottom.php';?>