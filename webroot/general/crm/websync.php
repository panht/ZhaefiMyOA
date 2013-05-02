<?php

if ($_REQUEST["action"] == "websiteSync") {
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];
	
	$url = "http://localhost:85/updata/export/export2oa.asp?u=" . $username . "&p=" . $password;
	$data = file_get_contents($url);
	eval($data);
	//echo '<pre>'; 	print_r($data);	exit();

	// 写入mysql
	mysql_connect("localhost:3336", "root", "myoa888");
	mysql_select_db("TD_OA");
	
	// 写入收费记录表
	if (!empty($data['dataRecord'])) {
		$sql = "insert into crm_salepay() values";
		foreach ($data['dataRecord'] as $name => $value) {
			$sql .= "(";
			$sql .= $value['TrainingCardID'] . ", ";
			$sql .= $value['RecordType'] . ", ";
			$sql .= "'" . $value['CardNo'] . "', ";
			$sql .= $value['Amount'] . ", ";;
			$sql .= $value['RecordTime'] . ", ";;
			$sql .= "'" . $value['Remark'] . "', ";;
			$sql .= "'" . $value['CreateBy'] . "', ";;
			$sql .= $value['CreateTime'];;
			$sql .= "),";
		}
		//mysql_query($sql);
		echo $sql;
	}
	
	echo "成功导入";
} else {
?>
	<!DOCTYPE html>
	<html>
	<head></head>
	<body>
	<form method="post" action="?action=websiteSync">
	<table cellspacing="0" border="0" width="100%">
		<tr><td colspan="2" align="center"><h1>导入学习卡数据</h2></td></tr>
		<tr><td align="right" width="50%">请输入网站后台用户名：</td><td><input type="input" name="username" size="15" /></td></tr>
		<tr><td align="right">请输入网站后台密码：</td><td><input type="password" name="password" size="15" /></td></tr>
		<tr><td colspan="2" align="center"><input type="submit" name="btnSubmit" value="导   入" size="15" style="margin:3px; width:150px; height:40px; font-size:25px; border:solid 1px #888;" /></td></tr>
	</table>
	</body>
	</html>
<?php
}
?>