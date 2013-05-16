<?php
$connect = mysql_connect("127.0.0.1:3336", "root", "myoa888");
if (!$connect){
	die(mysql_error());
}
mysql_select_db("TD_OA", $connect);
mysql_query("SET NAMES 'GBK'"); 

$sql = "select account_name, field3, account_field8, account_birthday from crm_account where id = " . $_GET['id'] . " limit 1";
$sqlResult = mysql_query($sql);
while ($row = mysql_fetch_row($sqlResult)) {
	$account_name = $row[0];
	$leal_person = $row[1];
	$certificate_no = $row[2];
	$account_birthday = $row[3];
}
mysql_free_result($sqlResult);
mysql_close($connect);
?>
<html>
<head>
<title>会员证>>打印预览</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<style>
.print09 {
    font-family: "黑体";
    font-size: 20pt;
    font-weight: bold;
}
.print11 {
    font-family: "黑体";
    font-size: 16px;
    font-weight: bold;
}
</style>
</head>

<body>
<div style="position:absolute;left:-10;top:-10">
<table border="0" width="100%" cellspacing="0" cellpadding="10"><tr><td>
<img src='account_certificate.jpg' style='display:none'>
<div style='position:absolute;left:10;top:710;width:760'>
<table border="0" width="100%" cellspacing="0">
	<tr><td align=center class=print09><?php echo $account_name?></td></tr>
	<tr><td class=print10 align=center>法定代表人：<?php echo $leal_person?></td></tr>
</table>
</div>
<div style='position:absolute;left:50;top:960' class=print11>证号：<?php echo $certificate_no?></div>
<div style='position:absolute;left:220;top:960' class=print11>入会日期：<?php echo date("Y年n月j日", $account_birthday)?></div>
<div style='position:absolute;left:445;top:960' class=print11>发证日期：<?php echo date("Y年n月j日")?></div>
</td></tr></table>
</div>
</body>
</html>
