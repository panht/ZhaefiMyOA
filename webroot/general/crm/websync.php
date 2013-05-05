<?php
ini_set("max_execution_time", 1800);
set_time_limit(1800);

if ($_REQUEST["action"] == "websiteSync") {
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];
	
	$url = "http://localhost:85/updata/export/export2oa.asp?u=" . $username . "&p=" . $password;
	$data = file_get_contents($url);
	eval($data);
	//echo '<pre>'; 	print_r($data);	exit();

	// 写入mysql
	$connect = mysql_connect("127.0.0.1:3336", "root", "myoa888");
	if (!$connect){
		die(mysql_error());
	}
	mysql_select_db("TD_OA", $connect);
	mysql_query("SET NAMES 'GBK'"); 
	
	// 更新会员表
	if (!empty($data['dataCard'])) {
		foreach ($data['dataCard'] as $name => $value) {
			if (!empty($value['Balance']) && $value['Balance'] != '' && !empty($value['CompanyName']) && $value['CompanyName'] != '') {
				$sql = "update crm_account set account_parent=" . $value['Balance'] . " where account_name='" . $value['CompanyName'] . "'";
				//echo $sql . "<br/>";
				$queryResult = mysql_query($sql, $connect) or die("Invalid query: " . mysql_error());
			}
		}
	}
	
	// 写入收费记录表
	if (!empty($data['dataRecord'])) {
		foreach ($data['dataRecord'] as $name => $value) {
			$recordTime = strtotime($value['RecordTime']);
			if ($recordTime == null || $recordTime == '') {
				$recordTime = 0;
			}
			
			$order_name = '学习卡导入';
			if ($value['CardType'] == 1) {
				$order_kind = '会员';
			} else {
				$order_kind = '非会员';
			}
			if ($value['RecordType'] == 1) {
				$order_status = '学习卡充值';
				$amount = $value['Amount'];
			} else {
				$order_status = '学习卡扣款';
				$amount = -$value['Amount'];
			}
			
			// 插入订单表
			$sql = "insert into crm_order(create_time, update_time, create_man_text, update_man_text, deleted, order_name, order_status, order_amount, order_kind, order_sign_date, account_id, account_id_text, opportunity_id) values";
			$sql .= "(";
			$sql .= $recordTime . ", ";
			$sql .= $recordTime . ", ";
			$sql .= "'" . $value['CreateBy'] . "', ";
			$sql .= "'" . $value['CreateBy'] . "', ";
			$sql .= "0, '" . $order_name . "', '" . $order_status . "', ";
			$sql .= $amount . ", ";
			$sql .= "'" . $$order_kind . "', ";
			$sql .= $recordTime . ", ";;
			$sql .= $value['MemberID'] . ", ";
			$sql .= "'" . $value['CompanyName'] . "', ";
			$sql .= "'学习卡号" . $value['CardNo'] . "\n" . $value['Remark'] . "' ";
			$sql .= ")";
			mysql_query($sql);
			echo $sql . '<br/>';
			
			// 获得自增ID
			$sql = "select max(id) from crm_order";
			$resultQuery = mysql_query($sql);
			while ($row = mysql_fetch_row($resultQuery)) {
				$id = $row[0];
			}
			
			// 插入订单详情表
			$sql = "insert into crm_order_products_list(main_id, deleted, product_id, qty, price, total, create_time, update_time, create_man_text, update_man_text) values(";
			$sql .= $id . ", ";
			$sql .= '0, 10, 1, ';
			$sql .= $value['Amount'] . ", ";
			$sql .= $value['Amount'] . ", ";
			$sql .= $recordTime . ", ";
			$sql .= $recordTime . ", ";
			$sql .= "'" . $value['CreateBy'] . "', ";
			$sql .= "'" . $value['CreateBy'] . "' ";
			$sql .= ")";
			mysql_query($sql);
			echo $sql . '<br/>';
		}
		//mysql_query($sql);
		//echo $sql;
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