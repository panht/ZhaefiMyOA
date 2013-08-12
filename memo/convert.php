<?php
// 会员编号转换
ini_set("max_execution_time", 3600);
set_time_limit(3600);
//ini_set("mssql.textsize",200000);
//ini_set("mssql.textlimit",200000);
//ini_set('pcre.backtrack_limit', 999999999);
$connect = mysql_connect("127.0.0.1:3336", "root", "myoa888");
if (!$connect){
        die(mysql_error());
}
mysql_select_db("TD_OA", $connect);
mysql_query("SET NAMES 'UTF8'");

$count = 0;
$sql = "select account_code, id from crm_account where account_code is null order by id";
$sqlResult = mysql_query($sql, $connect);
while ($row = mysql_fetch_array($sqlResult)) {
	$id = $row['id'];
	$account_code = 'ZHAEFI-' . str_pad($id, 4, "0", STR_PAD_LEFT);

	$sql = "update crm_account set account_code = '" . $account_code . "' where ID = " . $id;
	mysql_query($sql) or die( $sql . "<br/><br/>");
	$count++;
}
echo '成功转换条数：' . $count;