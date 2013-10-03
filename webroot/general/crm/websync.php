<?php
ini_set("max_execution_time", 3600);
set_time_limit(3600);

if ($_REQUEST["action"] == "websiteSync") {
	if ($_REQUEST["username"] == "" || $_REQUEST["password"] == "" ) {
?>
		<script>
			alert("请输入用户名密码");
			window.location.href="websync.php";
		</script>
<?php
	}
	$username = $_REQUEST["username"];
	$password = $_REQUEST["password"];
	
	$url = "http://www.zhaefi.org/2011/updata/export/export2oa.asp?u=" . $username . "&p=" . $password;
	//$url = "http://localhost:85/updata/export/export2oa.asp?u=" . $username . "&p=" . $password;
	$data = file_get_contents($url);
	eval($data);

	// 写入mysql
	require ("conn.php");
	// $connect = mysql_connect("127.0.0.1:3336", "root", "myoa888");
	// if (!$connect){
		// die(mysql_error());
	// }
	// mysql_select_db("TD_OA", $connect);
	// mysql_query("SET NAMES 'GBK'"); 

	// 更新会员表及学习卡表
	if (!empty($data['dataCard'])) {
		foreach ($data['dataCard'] as $name => $value) {
			if (!empty($value['Balance']) && $value['Balance'] != '' && !empty($value['CompanyName']) && $value['CompanyName'] != '') {
				// 更新会员表
				$sql = "update crm_account set account_parent=" . $value['Balance'] . ", account_field9='" . $value['CardNo'] . "' where account_name='" . $value['CompanyName'] . "'";
				$queryResult = mysql_query($sql, $connect) or die("Invalid query: " . mysql_error());
			}
			
			// 更新学习卡表
			if (!empty($value['CardNo']) && $value['CardNo'] != '' ) {
				$sql = "select * from CRM_MODULE_2 where field1 = '" . $value['CardNo'] . "'";
				$queryResult = mysql_query($sql, $connect) or die("Invalid query: " . $sql . "error:" . mysql_error());
				$row = mysql_fetch_array($queryResult);
				
				if (strlen($row['field1']) > 0) {
					// 如果已存在则更新，否则插入
					$sql = "update CRM_MODULE_2 set deleted=0, field1 = '" . $value['CardNo'] . "', field2=" . $value['MemberID'] . ", field2_text='" . $value['CompanyName'] . "', field3='" . $value['OwnerName'] . "', field4='" . $value['OwnerCellphone'] . "', field5='" . $value['OwnerEmail'] . "', field6=" . $value['Balance'] . ", field7=" . strtotime($value['CreateDate']) . ", field8='" . $value['CardType'] . "', field9='" . $value['CardStatus'] . "', field10='" . strtotime($value['CancelDate']) . "', field12='" . $value['Memo'] . "', update_man_text='" . $value['UpdateBy'] . "', update_time=" . strtotime($value['UpdateTime']) . " where  field1 = '" . $value['CardNo'] . "'";
				} else {
					$sql = "insert into CRM_MODULE_2(deleted, field1, field2, field2_text, field3, field4, field5, field6, field7, field8, field9, field10, field11, field12, create_man_text, create_time, update_man_text, update_time) values(0, '" . $value['CardNo'] . "', " . $value['MemberID'] . ", '" . $value['CompanyName'] . "', '" . $value['OwnerName'] . "', '" . $value['OwnerCellphone'] . "', '" . $value['OwnerEmail'] . "', " . $value['Balance'] . ", " . strtotime($value['CreateDate']) . ", '" . $value['CardType'] . "', '" . $value['CardStatus'] . "', '" . strtotime($value['CancelDate']) . "', '', '" . $value['Memo'] . "', '" . $value['CreateBy'] . "', " . strtotime($value['CreateTime']) . ", '" . $value['UpdateBy'] . "', " . strtotime($value['UpdateTime']) . ')';
				}
				//echo $sql;
				$queryResult = mysql_query($sql, $connect) or die("Invalid query: " . $sql . "error:" . mysql_error());
			}
		}
	}
	
	// 写入充值、支付记录
	if (!empty($data['dataRecord'])) {
		foreach ($data['dataRecord'] as $name => $value) {
			$record = "[" . $value['RecordTime'] . "]";
			$record .= " " . $value['RecordType'] . " ";
			$record .= "" . $value['Amount'] . "元";
			$record .= "(" . $value['Remark'] . ")\n";
			$sql = "update CRM_MODULE_2 set field11 = concat(field11, '" . $record . "') where field1 = '" . $value['CardNo'] . "'" ;
			$queryResult = mysql_query($sql, $connect) or die("Invalid query: " . $sql . "error:" . mysql_error());
			
			/*
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
			$sql = "insert into crm_order(create_time, update_time, create_man_text, update_man_text, deleted, order_name, order_status, order_amount, order_kind, order_sign_date, account_id, account_id_text, order_facilitate_man_text, opportunity_id, opportunity_id_text, order_code) values";
			$sql .= "(";
			$sql .= $recordTime . ", ";
			$sql .= $recordTime . ", ";
			$sql .= "'" . $value['CreateBy'] . "', ";
			$sql .= "'" . $value['CreateBy'] . "', ";
			$sql .= "0, '" . $order_name . "', '" . $order_status . "', ";
			$sql .= $amount . ", ";
			$sql .= "'" . $order_kind . "', ";
			$sql .= $recordTime . ", ";;
			$sql .= $value['MemberID'] . ", ";
			$sql .= "'" . $value['CompanyName'] . "', ";
			$sql .= "'" . $value['CreateBy'] . "', ";
			//$sql .= "'学习卡号" . $value['CardNo'] . "，\n" . $value['Remark'] . "' ";
			$sql .= "10, '学习卡', 'StudyCard'";
			$sql .= ")";
			mysql_query($sql);
			//echo $sql . '<br/>';
			
			// 获得自增ID
			//$sql = "select max(id) from crm_order";
			//$resultQuery = mysql_query($sql);
			//while ($row = mysql_fetch_row($resultQuery)) {
			//	$id = $row[0];
			//}
			
			// 插入订单详情表
			//$sql = "insert into crm_order_products_list(main_id, deleted, product_id, qty, number, price, total, create_time, update_time, create_man_text, update_man_text) values(";
			//$sql .= $id . ", ";
			//$sql .= '0, 10, 1, 1, ';
			//$sql .= $value['Amount'] . ", ";
			//$sql .= $value['Amount'] . ", ";
			//$sql .= $recordTime . ", ";
			//$sql .= $recordTime . ", ";
			//$sql .= "'" . $value['CreateBy'] . "', ";
			//$sql .= "'" . $value['CreateBy'] . "' ";
			//$sql .= ")";
			//mysql_query($sql);
			//echo $sql . '<br/>';
			*/
		}
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