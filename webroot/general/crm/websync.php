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

	// д��mysql
	$connect = mysql_connect("127.0.0.1:3336", "root", "myoa888");
	if (!$connect){
		die(mysql_error());
	}
	mysql_select_db("TD_OA", $connect);
	mysql_query("SET NAMES 'GBK'"); 
	
	// ���»�Ա��
	if (!empty($data['dataCard'])) {
		foreach ($data['dataCard'] as $name => $value) {
			if (!empty($value['Balance']) && $value['Balance'] != '' && !empty($value['CompanyName']) && $value['CompanyName'] != '') {
				$sql = "update crm_account set account_parent=" . $value['Balance'] . " where account_name='" . $value['CompanyName'] . "'";
				//echo $sql . "<br/>";
				$queryResult = mysql_query($sql, $connect) or die("Invalid query: " . mysql_error());
			}
		}
	}
	
	// д���շѼ�¼��
	if (!empty($data['dataRecord'])) {
		foreach ($data['dataRecord'] as $name => $value) {
			$recordTime = strtotime($value['RecordTime']);
			if ($recordTime == null || $recordTime == '') {
				$recordTime = 0;
			}
			
			$order_name = 'ѧϰ������';
			if ($value['CardType'] == 1) {
				$order_kind = '��Ա';
			} else {
				$order_kind = '�ǻ�Ա';
			}
			if ($value['RecordType'] == 1) {
				$order_status = 'ѧϰ����ֵ';
				$amount = $value['Amount'];
			} else {
				$order_status = 'ѧϰ���ۿ�';
				$amount = -$value['Amount'];
			}
			
			// ���붩����
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
			$sql .= "'ѧϰ����" . $value['CardNo'] . "\n" . $value['Remark'] . "' ";
			$sql .= ")";
			mysql_query($sql);
			echo $sql . '<br/>';
			
			// �������ID
			$sql = "select max(id) from crm_order";
			$resultQuery = mysql_query($sql);
			while ($row = mysql_fetch_row($resultQuery)) {
				$id = $row[0];
			}
			
			// ���붩�������
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
	
	echo "�ɹ�����";
} else {
?>
	<!DOCTYPE html>
	<html>
	<head></head>
	<body>
	<form method="post" action="?action=websiteSync">
	<table cellspacing="0" border="0" width="100%">
		<tr><td colspan="2" align="center"><h1>����ѧϰ������</h2></td></tr>
		<tr><td align="right" width="50%">��������վ��̨�û�����</td><td><input type="input" name="username" size="15" /></td></tr>
		<tr><td align="right">��������վ��̨���룺</td><td><input type="password" name="password" size="15" /></td></tr>
		<tr><td colspan="2" align="center"><input type="submit" name="btnSubmit" value="��   ��" size="15" style="margin:3px; width:150px; height:40px; font-size:25px; border:solid 1px #888;" /></td></tr>
	</table>
	</body>
	</html>
<?php
}
?>