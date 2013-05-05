<?php
header("content-type:application/javascript");

if ($_GET['action']="companyName") {
	$connect = mysql_connect("localhost:3336", "root", "myoa888");
	mysql_select_db("TD_OA", $connect);
	mysql_query("SET NAMES 'GBK'"); 
	
	//$name = iconv('latin1_swedish_ci', 'GBK', $_GET["name"]);
	$name = $_GET["name"];
	$query = "select id, account_name from crm_account where account_name like '%" . $name . "%' limit 10";
	$resultQuery = mysql_query($query, $connect);
	
	$result = "[";
	while ($row = mysql_fetch_array($resultQuery)) {
		$id = $row["id"];
		$account_name = $row["account_name"];
		$result .= '{"id":' . $id . ', "name":"' . $account_name . '"}, ';
	}
	$result .= "]";
	
	mysql_free_result($resultQuery); 
	mysql_close($connect);
} 

//动态执行回调函数  
$callback = $_GET['callback'];  
echo $callback."($result)";