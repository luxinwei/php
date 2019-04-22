<?php
class DB{
	var $conn=null;
    private $_instance=null;
	public static function getInstance(){
		if(!$_instance instanceof self){
			$_instance = new self;
		}
		return $_instance;
	}
	function __construct() {
		try {
			$this->conn = new PDO("sqlite:".dirname(__FILE__)."/#sqlite.db")or die("Connect Error");
			$this->conn->setAttribute ( PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true );
			$this->conn->setAttribute ( PDO::ATTR_EMULATE_PREPARES, true );
			//execute("SET NAMES utf8");
		} catch (Exception $e) {
			die("数据库连接失败".$e->getMessage());
		}
	}
	function __destruct() {
		$conn=null;
	}
	//-----------------------------------------------------------
	function getInsertSql($tablename, $colArr){
		$key_arr = array();
		$value_arr = array();
		foreach ($colArr as $key => $value) {
			$key_arr[] = $key;
			$value_arr[] = $value;
		}
		$sql="insert into ".$tablename." (".implode(',', $key_arr).") values('".implode('\',\'', $value_arr) ."')";
		return $sql;
	}
	function getUpdateSql($tablename, $colArr,$where){
		$sql_mid="";
		foreach ($colArr as $key => $value) {
			if($sql_mid!="")$sql_mid.=",";
			$sql_mid.=$key."='".$value."'";
		}
		$sql="update " . $tablename . " set " . $sql_mid. " where  1=1 " .$where;
		return $sql;
	}
	/*通过数组添加数据  */
	function saveByArray($tablename, $colArr) {
		$key_arr = array();
		$value_arr = array();
		foreach ($colArr as $key => $value) {
			$key_arr[] = $key;
			$value_arr[] = $value;
		}
		$sql="insert into ".$tablename." (".implode(',', $key_arr).") values('".implode('\',\'', $value_arr) ."')";
		$isok=false;
		$rs=$this->conn->exec($sql);
		if($rs)$isok=true;
		return $isok;
	}
	/* 通过数组编辑数据 */
	function updateByArray($tablename, $colArr,$where) {
		$sql_mid="";
		foreach ($colArr as $key => $value) {
			if($sql_mid!="")$sql_mid.=",";
			$sql_mid.=$key."='".$value."'";
		}
		$sql="update " . $tablename . " set " . $sql_mid. " where  1=1 " .$where;
		$isok=false;
		$rs=$this->conn->exec($sql);
		if($rs)$isok=true;
		return $isok;
	}
	function saveOrUpdateByArray($tablename,$keycol, $colArr){
		$sql="";
		$where="";
		foreach ($colArr as $key => $value) {
			if($key==$keycol){
				$where=$keycol."='".$value."'";
				break;
			}
		}
		if($where=="")return false;
		$sql_select="select * from ".$tablename." where ".$where;
		$rs=$this->conn->query($sql_select);
		if ($row = mysqli_fetch_assoc($rs)){
			$sql_mid="";
			foreach ($colArr as $key => $value) {
				if($key==$keycol)continue;
				if($sql_mid!="")$sql_mid.=",";
				$sql_mid.=$key."='".$value."'";
			}
			$sql="update " . $tablename . " set " . $sql_mid. " where  " .$where;
		}else{
			$key_arr = array();
			$value_arr = array();
			foreach ($colArr as $key => $value) {
				$key_arr[] = $key;
				$value_arr[] = $value;
			}
			$sql="insert into ".$tablename." (".implode(',', $key_arr).") values('".implode('\',\'', $value_arr) ."')";
		}
		if($sql=="")return false;
		$isok=false;
		$rs=$this->conn->exec($sql);
		if($rs)$isok=true;
		return $isok;
	}
	//-----------------------------------------------------------

	//sql语句实现事务控制update ,del,insert语句
	function execUpdate($sql_update){
		$isok=false;
		$rs=$this->conn->exec($sql_update);
		if($rs)$isok=true;
		return $isok;
	}
	function deleteBykey($tablename,$keycol,$keyvalueArray){
		$flag = true;
		$sql_array=array();
		foreach ($keyvalueArray as $keyvalue){
			$sql_array[]="delete from ".$tablename." where ".$keycol."='".$keyvalue."'";
		}
		$flag=self::InsertOrUpdateArray($sql_array);//类内部调用
		return $flag;
	}
	//多个sql语句实现事务控制update ,del,insert语句
	//MYSQL中只有INNODB和BDB类型的数据表才能支持事务处理！其他的类型是不支持的！
	
	function InsertOrUpdateArray($sql_array){
		$flag = true; //事务是否成功执行的标志
		try {
			$this->conn->beginTransaction();
			foreach ($sql_array as $sql){
				if(trim($sql)=="")continue;
				$rs=$this->conn->exec($sql);
			}
			$this->conn->commit();
		} catch (Exception $e) {
			$flag=false;
			$this->conn->rollBack();
		}
		return $flag;
	}
	/*
	 * 批量更新
	 *
	 */
	function executeBatchUpdate($BatchSqlDTOArray){
		$isOk = false;
		$sqlArray=array();
		foreach ($BatchSqlDTOArray as $BatchSqlDTO){
			$sql_select = $BatchSqlDTO["sql_select"];
			$sql_insert = $BatchSqlDTO["sql_insert"];
			$sql_update = $BatchSqlDTO["sql_update"];
			$isFugai    = $BatchSqlDTO["isFugai"];
			$rs=$this->conn->query($sql_select);
			if ($row = mysqli_fetch_assoc($rs)){
				if ($isFugai == 1)$sqlArray[]=$sql_update;
			}else{
				$sqlArray[]=$sql_insert;
			}
		}
		if(count($sqlArray)>0){
			$isOk=self::InsertOrUpdateArray($sqlArray);
		}
		return $isOk;
	}
	//-----------------------------------------------------------
	function isExt($sql_select) {
		$isOk = false;
		$stmt=$this->conn->query($sql_select);
		$list=$stmt->fetchAll(PDO::FETCH_ASSOC);
		if(count($list)>0)$isOk = true;
		$stmt=null;
		return $isOk;
	}
	function execQuery($sql_select){// 设置查询的SELECT语句
		$stmt=$this->conn->query($sql_select);
		$list=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt=null;
		return $list;
	}
	function getOneObjByKey($tablename,$keycol, $keyvalue){
		$row = array();
		$sql_select="select * from ".$tablename." where ".$keycol."='".$keyvalue."'";
		$stmt=$this->conn->query($sql_select);
		$list=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt=null;
		$row=array();
		if(count($list)>0)$row=$list[0];
		return $row;
	}
	function getOneObjByWhere($tablename, $where){
		$row = array();
		$sql_select="select * from ".$tablename;
		$sql_select.=" where 1=1 ".$where;
		$stmt=$this->conn->query($sql_select);
		$list=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt=null;
		$row=array();
		if(count($list)>0)$row=$list[0];
		return $row;
	}
	function getOneObjBySql($sql_select){
		    $row=array();
			$stmt=$this->conn->query($sql_select);
			$list=$stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt=null;
			if(count($list)>0)$row=$list[0];
		    return $row;
	}
	//-----------------------------------------------------------
	function getOneJsonByKey($tablename,$keycol, $keyvalue){
		$json = "";
		$row = array();
		$sql_select="select * from ".$tablename." where  ".$keycol."='".$keyvalue."'";
		$stmt=$this->conn->query($sql_select);
		$list=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt=null;
		$row=array();
		if(count($list)>0)$row=$list[0];
		$json_mid="";
	    $key_array=array_keys($row);
		foreach ($key_array as $mapkey){
			if($json_mid!="")$json_mid.=",";
			$json_mid.="\"".$mapkey."\":\"".$row[$mapkey]."\"";
		}
		$json="{".$json_mid."}";
		return $json;
	}
	function getOneJsonByWhere($tablename, $where){
		$json = "";
		$sql_select="select * from ".$tablename;
		$sql_select.=" where 1=1 ".$where;
		$stmt=$this->conn->query($sql_select);
		$list=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt=null;
		$row=array();
		if(count($list)>0)$row=$list[0];
		$json_mid="";
	    $key_array=array_keys($row);
		foreach ($key_array as $mapkey){
			if($json_mid!="")$json_mid.=",";
			$json_mid.="\"".$mapkey."\":\"".$row[$mapkey]."\"";
		}
		$json="{".$json_mid."}";
		return $json;
	}
	function getOneJsonBySql($sql_select){
		$json = "";
		$stmt=$this->conn->query($sql_select);
		$list=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt=null;
		$row=array();
		if(count($list)>0)$row=$list[0];
		$json_mid="";
	    $key_array=array_keys($row);
		foreach ($key_array as $mapkey){
			if($json_mid!="")$json_mid.=",";
			$json_mid.="\"".$mapkey."\":\"".$row[$mapkey]."\"";
		}
		$json="{".$json_mid."}";
		return $json;
	}
	//-----------------------------------------------------------
	function findJsonBySql($sql_select){
		$totalCount=0;
		$data_array=array();
		$stmt=$this->conn->query($sql_select);
		$data_array=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt=null;
		$totalCount=count($data_array);
		$json_mid="";
		foreach ($data_array as $m_array){
			$mjson_mid="";
			$key_array=array_keys($m_array);
			foreach ($key_array as $mapkey){
				if($mjson_mid!="")$mjson_mid.=",";
				$mjson_mid.="\"".$mapkey."\":\"".$m_array[$mapkey]."\"";
			}
			if($json_mid!="")$json_mid.=",";
			$json_mid.="{".$mjson_mid."}";
		}
		$content="[".$json_mid."]";
		$json = "";
		$json.="{\"totalProperty\":";
		$json.="\"". $totalCount."\"";
		$json.=",\"root\":";
		$json.=$content;
		$json.="}";
		return $json;
	}
	function findJson($tablename,$where,$orderStr){
		$totalCount=0;
		$sql_select="select count(*) as NUM from ".$tablename;
		$sql_select.=" where 1=1 ".$where;
		$stmt=$this->conn->query($sql_select);
		$list=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt=null;
		$row=array();
		if(count($list)>0)$row=$list[0];
        $totalCount=$row["NUM"];

		$sql_select="select * from ".$tablename;
		$sql_select.=" where 1=1 ".$where;
		$sql_select.=" ".$orderStr;
		$stmtx=$this->conn->query($sql_select);
		$data_array=$stmtx->fetchAll(PDO::FETCH_ASSOC);
		$stmtx=null;
		$json_mid="";
		foreach ($data_array as $m_array){
			$mjson_mid="";
			$key_array=array_keys($m_array);
			foreach ($key_array as $mapkey){
				if($mjson_mid!="")$mjson_mid.=",";
				$mjson_mid.="\"".$mapkey."\":\"".$m_array[$mapkey]."\"";
			}
			if($json_mid!="")$json_mid.=",";
			$json_mid.="{".$mjson_mid."}";
		}
		$content="[".$json_mid."]";
		$json = "";
		$json.="{\"totalProperty\":";
		$json.="\"". $totalCount."\"";
		$json.=",\"root\":";
		$json.=$content;
		$json.="}";
		return $json;
	}
	
	function findPageJson($tablename,$where,$orderStr,$start,$length){
		$totalCount=0;
		$sql_select="select count(*) as NUM from ".$tablename;
		$sql_select.=" where 1=1 ".$where;
		$stmt=$this->conn->query($sql_select);
		$list=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt=null;
		$row=array();
		if(count($list)>0)$row=$list[0];
		$totalCount=$row["NUM"];

		$sql_select="select * from ".$tablename;
		$sql_select.=" where 1=1 ".$where;
		$sql_select.=" ".$orderStr;
		$sql_select.=" limit ".$start.",".$length;
		$stmtx=$this->conn->query($sql_select);
		$data_array=$stmtx->fetchAll(PDO::FETCH_ASSOC);
		$stmtx=null;
		$json_mid="";
		foreach ($data_array as $m_array){
			$mjson_mid="";
			$key_array=array_keys($m_array);
			foreach ($key_array as $mapkey){
				if($mjson_mid!="")$mjson_mid.=",";
				$mjson_mid.="\"".$mapkey."\":\"".$m_array[$mapkey]."\"";
			}
			if($json_mid!="")$json_mid.=",";
			$json_mid.="{".$mjson_mid."}";
		}
		$content="[".$json_mid."]";
		$json = "";
		$json.="{\"totalProperty\":";
		$json.="\"". $totalCount."\"";
		$json.=",\"root\":";
		$json.=$content;
		$json.="}";
		return $json;
	}
//======================================================================================================================================================================
	function getTableArray(){
		$tables=array();
		$sql="select name From sqlite_master where type='table'";
		$stmt=$this->conn->query($sql);
		$list=$stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt=null;
		foreach ($list as $table){
			$tablename=$table["name"];
			$tables[]=$tablename;
		}
		return $tables;
	}
	
	/*
	 * s是指一个字符串,
	 * i指的是int。
	 * d代表双精度以及浮点类型，
	 * b代表blob类型
	 * 使用方法
	 $sql="select * from fim_upload_col where uploadcolkey=?";
	 $sql="update fim_upload_col set readme=?,description=? where filenum=?";
	 $cols=array(
	 array("s","aaaaaaaaaaa")
	 ,array("s","bbbbbbbbbbb")
	 ,array("i","1")
	 );
	 DB::getInstance()->excutePrepare($sql, $cols)
	 返回结果-1为失败0未处理〉>=1处理成功
	 */
	function excutePrepare($sql,$cols){
		$isok=false;
		try{
			$stmt=$this->conn->prepare($sql);
			for($i=0;$i<count($cols);$i++){
				$col=$cols[$i];
				$index=$i+1;
				$stmt->bindParam($index,$col[1]);
			}
			$stmt->execute();
			$isok=true;
		}catch(Exception $exception){
			$isok=false;
			echo $exception->getMessage();
		}
		return $isok;
	}
	
}
header("Content-type: text/html; charset=utf-8");

//findJsonBySql("select FIRST_NAME from EMPLOYEE");
//var_dump($list);

?>
