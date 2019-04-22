<?php
//error_reporting(0);
//header("Content-type: text/html; charset=utf-8");
include_once dirname(__FILE__).'/../../../config.php';
class MysqlInfo {
    private $conn; //数据库连接;
    private $dbname="information_schema";
    private $_instance=null;
    public static function getInstance(){
    	if(!$_instance instanceof self){
    		$_instance = new self;
    	}
    	return $_instance;
    }
    /*构造函数*/
    public function __construct() {
        $conntype = "pconn";//数据库连接标识;
        $coding   = "UTF8";//数据库编码，GBK,UTF8,gb2312
        if ($conntype== "pconn") {
        	$this->conn = mysql_pconnect(SysConfig::DBHOST, SysConfig::DBUSER, SysConfig::DBPWD);//永久链接
        } else {
        	$this->conn = mysql_connect(SysConfig::DBHOST, SysConfig::DBUSER, SysConfig::DBPWD);//即使链接
        }
        if (!mysql_select_db($this->dbname, $this->conn)) {
        	echo $this->dbname."数据库不可用";
        }
        mysql_query("SET NAMES $coding");  
    }
 
    
    public function __destruct() {//析构函数，自动关闭数据库,垃圾回收机制
    	mysql_close($this->conn);
    }
   
    function execQuery($sql_select){// 设置查询的SELECT语句
    	$data = array();
    	$rs = mysql_query($sql_select, $this->conn);
    	$total=mysql_num_rows($rs);
    	while($row = mysql_fetch_assoc($rs)){
    		$data[]=$row;
    	}
    	if (!empty ($rs))@ mysql_free_result($rs);//释放结果集
    	return  $data;
    }
    function getTableArray(){
    	$dbname=SysConfig::DBNAME;
    	$sql_select="select TABLE_SCHEMA,TABLE_NAME,TABLE_COMMENT from `TABLES` where TABLE_SCHEMA='".SysConfig::DBNAME."'";
    	$list=self::execQuery($sql_select);
    	return $list;
    }
    //查询字段数量
    public function getColArray($tablename) {
    	$sql_select="SELECT TABLE_NAME,COLUMN_NAME,DATA_TYPE,CHARACTER_MAXIMUM_LENGTH,IS_NULLABLE,COLUMN_KEY,COLUMN_COMMENT  from COLUMNS where TABLE_SCHEMA='".SysConfig::DBNAME."' and TABLE_NAME='".$tablename."'";
    	$list=self::execQuery($sql_select);
    	return $list;
    }
}