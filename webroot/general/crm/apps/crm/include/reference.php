<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

include_once( "general/crm/apps/crm/header.php" );
include_once( $g_CRM_PATH."/include/interface/list.interface.php" );
include_once( $g_CRM_PATH."/include/general.func.php" );
include_once( $g_PLATFORM_PATH."/base/auth.func.php" );
include_once( $g_STUDIO_PATH."/include/entity.class.php" );
include_once( $g_STUDIO_PATH."/include/entityAction.php" );
include_once( $g_STUDIO_PATH."/include/conditional.php" );
include_once( $g_STUDIO_PATH."/modules/ViewDefine/view.func.php" );
include_once( $g_STUDIO_PATH."/include/classes/filter/filter_inter.php" );
include_once( "inc/utility_org.php" );
include_once( "inc/utility_file.php" );
$to_id = $_GET['to_id'];
$to_value = $_GET['to_value'];
$ENTITY = $_GET['entity_name'];
$USER_VIEW = $_GET['view_id'];
$FieldDetialInfoARR = fielddetialinfo( $USER_VIEW );
$fieldIndexArr = array( );
$WHERE_CLAUSE = getwheresql( $_SERVER['QUERY_STRING'] );
$fieldname = $_GET['fieldname'];
$fieldvalue = $_GET['fieldvalue'];
if ( $fieldname != "" )
{
				$fieldnameArr = explode( ",", $fieldname );
				$fieldvalueArr = explode( ",", $fieldvalue );
				$i = 0;
				for ( ;	$i < count( $fieldnameArr );	++$i	)
				{
								if ( !( $fieldnameArr[$i] == "" ) )
								{
												$WHERE_CLAUSE .= " AND ".$fieldnameArr[$i]." = '".$fieldvalueArr[$i]."' ";
								}
				}
}
$FILTER = $_GET['filter'];
if ( $FILTER != "" )
{
				$WHERE_CLAUSE .= " AND ".$FILTER;
}
$PAGE_SIZE = $_GET['PAGE_SIZE'] == "" ? 10 : $_GET['PAGE_SIZE'];
$query = getviewquerycountsql( $USER_VIEW, $ENTITY, $WHERE_CLAUSE, $EXTENSION_AUTHORITY_CLAUSE );
$cursor = exequery( $connection, $query );
if ( $result = mysql_fetch_array( $cursor ) )
{
				$TOTAL_SIZE = $result[0];
}
$TOTAL_PAGE = ceil( $TOTAL_SIZE / $PAGE_SIZE );
if ( $CUR_PAGE < 1 )
{
				$CUR_PAGE = 1;
}
if ( $TOTAL_PAGE < $CUR_PAGE )
{
				$CUR_PAGE = $TOTAL_PAGE;
}
$query = getviewquerysql( $USER_VIEW, $ENTITY, $PAGE_SIZE, $CUR_PAGE, $ORDERFIELD, $ORDERTYPE, $WHERE_CLAUSE, $CONFIGARR, $EXTENSION_AUTHORITY_CLAUSE );
$cursor = exequery( $connection, $query );
$LIST_VIEW_DATA_HEAD_TMPL = getlistviewheadertmpl( $FieldDetialInfoARR, $ORDERFIELD, $ORDERTYPE, $CONFIGARR, FALSE );
$LIST_VIEW_DATA_BODY_TMPL = getlistviewdatabodytmpl( $cursor, $FieldDetialInfoARR, $colorSchema, $PAGE_SIZE, "", ture, "2000", $USER_VIEW );
( $connection, $ENTITY );
$objEntity = new entity( );
$MAIN_FIELD_ARR = $objEntity->getEntityMainField( );
$PATH = "/general/".$objEntity->getAppPath( $connection );
$MAIN_FIELD = $MAIN_FIELD_ARR['field_full_name'];
$index = 0;
foreach ( $FieldDetialInfoARR as $field => $fieldAttr )
{
				$fieldIndexArr[$index] = $fieldAttr['ENTITY_FIELD'];
				$fieldTypeArr[$fieldAttr['ENTITY_FIELD']] = $fieldAttr['FIELD_TYPE'];
				++$index;
}
$relationMap['reference_field'] = $MAIN_FIELD;
$relationMap['fill_field'] = $to_value;
$relationMap['index'] = array_search( $MAIN_FIELD, $fieldIndexArr ) + 1;
$relationMap['field_type'] = $fieldTypeArr[$MAIN_FIELD];
$relationMapArr[] = $relationMap;
$query = "select reference_field,fill_field from crm_sys_list_view_map where main_id = '".$USER_VIEW."'";
$cursor = exequery( $connection, $query );
while ( $row = mysql_fetch_array( $cursor ) )
{
				$relationMap['reference_field'] = $row['reference_field'];
				$fill_field_arr = explode( ".", $row['fill_field'] );
				$relationMap['fill_field'] = $fill_field_arr[1];
				$relationMap['index'] = array_search( $row['reference_field'], $fieldIndexArr ) + 1;
				$relationMap['field_type'] = $fieldTypeArr[$row['reference_field']];
				$relationMapArr[] = $relationMap;
}
if ( $LOGIN_USER_PRIV_OTHER == $LOGIN_USER_PRIV )
{
				$PRIV = $LOGIN_USER_PRIV;
}
else
{
				$PRIV = explode( ",", $LOGIN_USER_PRIV_OTHER );
}
$actionsPrivArr = getactionsprivbyentityandprivids( $ENTITY, $PRIV );
echo "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\r\n<html>\r\n<link href=\"/";
echo $g_CRM_PATH;
echo "/include/js/ScrollTable/superTables.css\" rel=\"stylesheet\" type=\"text/css\" />\r\n<script type=\"text/javascript\" src=\"/inc/js_lang.php\"></script>\r\n<script type=\"text/javascript\" src=\"/";
echo $g_CRM_PATH;
echo "/include/js/ScrollTable/superTables.js\"></script>\r\n<script type=\"text/javascript\" src=\"/";
echo $g_CRM_PATH;
echo "/include/js/ScrollTable/jquery.superTable.js\"></script>\r\n<script type=\"text/javascript\" src=\"/";
echo $g_CRM_PATH;
echo "/include/js/index.js\"></script>\r\n<script type=\"text/javascript\" src=\"/";
echo $g_CRM_PATH;
echo "/include/js/operation.js\"></script>\r\n<script type=\"text/javascript\" src=\"/";
echo $g_CRM_PATH;
echo "/include/js/general.js\"></script>\r\n<script src=\"/inc/js/module.js\"></script>\r\n<script src=\"/";
echo $g_PLATFORM_PATH;
echo "/js/general/view.js\"></script>\r\n<script src=\"/";
echo $g_CRM_PATH;
echo "/include/js/map.js\"></script>\r\n<!-- START OF BaiDu地图引用的JS文件及jQuery UI和样式 -->\r\n<link type=\"text/css\" href=\"/";
echo $g_PLATFORM_PATH;
echo "/js/extend/baidu/bmap.css\" rel=\"stylesheet\"/>\r\n<link type=\"text/css\" href=\"/";
echo $g_PLATFORM_PATH;
echo "/js/extend/jquery/css/smoothness/jquery.ui.custom.css\" rel=\"stylesheet\"/>\r\n<script src=\"/";
echo $g_PLATFORM_PATH;
echo "/js/extend/jquery/jquery-ui-1.8.13.custom.min.js\"></script>\r\n<!-- END OF BaiDu地图引用的JS文件及jQuery UI和样式 -->\r\n<script type=\"text/javascript\" src=\"/";
echo $g_STUDIO_PATH;
echo "/config/config.field.js\"></script>\r\n<script type='text/javascript' src=\"/";
echo $g_CRM_PATH;
echo "/include/js/jquery.advSearch.js\"></script>\r\n<body>\r\n<input type=\"hidden\" name=\"entity\" id=\"entity\" value=\"";
echo $ENTITY;
echo "\"/>\r\n<div style='margin:10px;'>\r\n<div id=\"search_box\">\r\n\t<div class=\"search_context_div\" style='padding-top:20px;'>\r\n\t\t<div id=\"con_search_adv\">\r\n\t\t<table class=\"CRM_TableList\" width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n\t\t\t\t<tr class=\"TableData\">\r\n\t\t\t\t\t<td align=\"center\" width=\"100%\" style='margin-top:10px;'>\r\n\t\t\t\t\t\t<table  style=\"border:none;\" class=\"CRM_TableList\" id='advTable' width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n\t\t\t\t\t\t</table>\r\n\t\t\t\t\t</td>\r\n\t\t\t\t</tr>\r\n\t\t</table>\r\n\t\t\t<table class=\"CRM_TableList\" style=\"border:none;\" width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n\t\t\t\t<tr>\r\n\t\t\t\t\t<td align=\"left\" class='hidden'>\r\n\t\t\t\t\t\t<input type=\"hidden\" class=\"toolBtnB\" id=\"advAddBtn\" type=\"button\" value=\" ";
echo _( "添加条件" );
echo " \" name=\"advAddBtn\"> \r\n\t\t\t\t\t\t<input type=\"hidden\" class=\"toolBtnB\" id=\"advMinusBtn\" type=\"button\" value=\" ";
echo _( "减少条件" );
echo " \" name=\"advMinusBtn\">\r\n\t\t\t\t\t</td>\r\n\t\t\t\t\t<td class=\"small\" align=\"center\">\r\n\t\t\t\t\t\t<input class=\"btn-blue\" id=\"advSearch\" type=\"button\" value=\" ";
echo _( "查询" );
echo " \">\t\r\n\t\t\t\t\t\t";
if ( ( $actionsPrivArr['001'] == "4" || $actionsPrivArr['001'] == "4!" ) && $entity_name != "crm_product_type" )
{
				echo "\t\t\t\t\t\t\t<input class=\"btn-red\" type=\"button\" onclick=\"openWindow('";
				echo $PATH;
				echo "/EditView/EditView.php?op_id=001',750,520)\" value=\" ";
				echo _( "新建" );
				echo " \" >\r\n\t\t\t\t\t\t";
}
echo "\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\r\n\t\t\t\t\t</td>\r\n\t\t\t\t</tr>\r\n\t\t\t</table>\r\n\t\t</div>\r\n\t</div>\r\n</div>\r\n<div>\r\n";
include_once( $g_STUDIO_PATH."/include/pagebar_tmpl.php" );
echo "</div>\r\n<table class=\"CRM_TableList\" width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" id=\"datalist\">\r\n\t";
echo $LIST_VIEW_DATA_HEAD_TMPL;
echo "\t";
echo $LIST_VIEW_DATA_BODY_TMPL;
echo "</table>\r\n<input type=\"hidden\" name=\"searchNum\" id=\"searchNum\" value=\"1\">\r\n<input type=\"hidden\" name=\"SuperTableMinusValue\" id=\"SuperTableMinusValue\" value=\"40\">\r\n<input type=\"hidden\" name=\"SearchBoxMinusValue\" id=\"SearchBoxMinusValue\" value=\"40\">\r\n";
foreach ( $FieldDetialInfoARR as $field => $fieldAttr )
{
				$fieldAttr = array_change_key_case( $fieldAttr );
				$fieldType = $fieldAttr['field_type'];
				$fieldAttr['field_full_name'] = $fieldAttr['entity_field'];
				$op_value = getoptionvalstr( $fieldType, $fieldAttr );
				$ADVS_SEARCH_TMPL .= "<option value='".$op_value."'>".$fieldAttr['field_label']."</option>";
}
echo "<select id=\"order_temp\" style=\"display:none;\">\r\n\t<option value=\"\">--";
echo _( "请选择" );
echo "--</option>\r\n</select>\r\n<select class=\"SmallInput efCtrlWidth90\" name=\"Fields_tmpl\" id=\"Fields_tmpl\" style=\"display:none;\">\r\n";
echo $ADVS_SEARCH_TMPL;
echo "\t\r\n</select>\r\n</div>\r\n</body>\r\n</html>\r\n<script>\r\njQuery(document).ready(function(){\r\n\tvar trObjs = jQuery(\"#datalist tr\");\r\n\ttrObjs.each(function(){\r\n\t\tif(jQuery(this).attr(\"id\") == \"tableTr\"){\r\n\t\t\treturn true;\r\n\t\t}else {\r\n\t\t\tjQuery(this).unbind(\"dbclick\");\r\n\t\t\tvar dataId = jQuery(this).attr(\"id\");\r\n\t\t\tdataId && jQuery(this).bind(\"click\",function(){\r\n\t\t\t\tchooseData(dataId);\r\n\t\t\t});\r\n\t\t}\r\n\t});\r\n\tjQuery(\"#advTable\").toAdvSearch({ \r\n\t\taddBtn: \"advAddBtn\",\r\n\t\tminusBtn: \"advMinusBtn\",\r\n\t\tdata: \"";
echo $ENTITY;
echo "\",\r\n\t\ttmpl: \"Fields_tmpl\"\r\n\t});\r\n\tvar parObj = window.opener;\r\n\tvar keyId = parObj.jQuery(\"#";
echo $to_id;
echo "\").val();\r\n\tvar trObj = jQuery(\"#tr_\"+keyId);\r\n\ttrObj.removeClass();\r\n\ttrObj.addClass(\"TableSelect\");\r\n});\r\n\r\nfunction chooseData(dataId){\r\n\tvar trObj = jQuery(\"#\"+dataId);\r\n\tvar chkObj = trObj.find(\"input[type='checkbox']\");\r\n\tvar keyId = chkObj.val();\r\n\tvar parObj = window.opener;\r\n\t\r\n";
echo "\tvar refValue = trObj.find(\"td:eq(".$relationMapArr[0]['index'].")\").text();\r\n";
echo "\tparObj.jQuery(\"#".$relationMapArr[0]['fill_field']."\").val(refValue);\r\n";
foreach ( $relationMapArr as $key => $relationMap )
{
				echo "\tvar refValue = trObj.find(\"td:eq(".$relationMap['index'].")\").text();\r\n";
				switch ( $relationMap['field_type'] )
				{
				case "reference" :
				case "user" :
				case "dept" :
								echo "\tvar refId = trObj.find(\"td:eq(".$relationMap['index'].")\").find(\"input[type='hidden']\").val();\r\n";
								echo "\tparObj.jQuery(\"#".$relationMap['fill_field']."\").val(refId);\r\n";
								echo "\tparObj.jQuery(\"#".$relationMap['fill_field']."_text\").val(refValue);\r\n\n";
								break;
				default :
								echo "\r\n\t\t\t\t\tif(parObj.jQuery(\"#".$relationMap['fill_field']."\").size() > 0)\r\n\t\t\t\t\t{\r\n\t\t\t\t\t\tparObj.jQuery(\"#".$relationMap['fill_field']."\").val(refValue);\r\n\t\t\t\t\t}\r\n\t\t\t\t\telse\r\n\t\t\t\t\t{\r\n\t\t\t\t\t\tif(parObj.document.getElementById(\"FAST|entity\") != null){\r\n\t\t\t\t\t\t\tvar fast_entity = parObj.document.getElementById(\"FAST|entity\").value;\r\n\t\t\t\t\t\t \tparObj.jQuery(\"#FAST_\"+fast_entity+\"_".$relationMap['fill_field']."\").val(refValue);\r\n\t\t\t\t\t \t}\r\n\r\n\t\t\t\t\t} \r\n\t\t\t\t\t\r\n\n";
				}
				if ( $ENTITY == "crm_purchase_order" )
				{
								echo "\tif(parObj.document.getElementById(\"entity_name\").value == \"crm_procurement_payment\"){\r\n\t\t\t\t\tvar re_paid,paid;\r\n\t\t\t\t\tjQuery(\"#clone_tr a\").each(function(i){\r\n\t\t\t\t\t\tif(jQuery(this).attr(\"href\").indexOf(\"crm_purchase_order.pay_amount\") != \"-1\") \r\n\t\t\t\t\t\t\tre_paid = i + 1;\r\n\t\t\t\t\t\tif(jQuery(this).attr(\"href\").indexOf(\"crm_purchase_order.purchase_amount\") != \"-1\")\r\n\t\t\t\t\t\t\tpaid = i + 1;\r\n\t\t\t\t\t});\r\n\t\t\t\t\tif(typeof re_paid == \"number\" && typeof paid == \"number\" && parObj.jQuery(\"#payment_amount\").val() != undefined){\r\n\t\t\t\t\t\tvar re_paid_num = parseFloat(trObj.find(\"td:eq(\"+re_paid+\")\").text().split(\",\").join(\"\"));\r\n\t\t\t\t\t\tvar paid_num = parseFloat(trObj.find(\"td:eq(\"+paid+\")\").text().split(\",\").join(\"\"));\r\n\t\t\t\t\t\tre_paid_num = isNaN(re_paid_num) ? 0 : re_paid_num;\r\n\t\t\t\t\t\tpaid_num = isNaN(paid_num) ? 0 : paid_num;\r\n\t\t\t\t\t\tparObj.jQuery(\"#payment_amount\").val(paid_num - re_paid_num);\r\n\t\t\t\t\t}\r\n\t\t\t\t}\r\n\t\t\t";
				}
}
echo "\tvar refValue = trObj.find(\"td:eq(".$relationMapArr[0]['index'].")\").text();\r\n";
echo "\tparObj.jQuery(\"#".$relationMapArr[0]['fill_field']."\").val(refValue);\r\n";
echo "\t\r\n\tparObj.jQuery(\"#";
echo $to_id;
echo "\").val(keyId).triggerHandler('propertychange');\r\n\r\n\twindow.close();\t\r\n}\t\r\n</script>\t\r\n\r\n<script type='text/javascript' src=\"/";
echo $g_CRM_PATH;
echo "/include/js/search_old.js\"></script>\r\n";
?>
