<?php
$connect = mysql_connect("localhost:3336", "root", "myoa888");
if (!$connect){
	die(mysql_error());
}
mysql_select_db("TD_OA", $connect);
mysql_query("SET NAMES 'GBK'");