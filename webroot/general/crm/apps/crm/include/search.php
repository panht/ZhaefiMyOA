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
include_once( $g_STUDIO_PATH."/include/utility.ui.php" );
include_once( $g_PLATFORM_PATH."/base/auth.func.php" );
include_once( $g_STUDIO_PATH."/include/entity.class.php" );
include_once( $g_STUDIO_PATH."/include/entityAction.php" );
include_once( "inc/utility_org.php" );
include_once( "inc/utility_file.php" );
include_once( $g_CRM_PATH."/include/general.func.php" );
include_once( $g_STUDIO_PATH."/include/classes/filter/filter_inter.php" );
ob_end_clean( );
$ENTITY = $_GET['ENTITY'];
$USER_VIEW = $_GET['USER_VIEW'];
$PAGE_SIZE = $_GET['PAGE_SIZE'];
$CUR_PAGE = $_GET['CUR_PAGE'];
$PROD_TYPE = $_GET['PROD_TYPE'];

if ( $USER_VIEW == "" )
{
				$USER_VIEW = getdefaultuview( $ENTITY, $LOGIN_USER_ID );
}
$FieldDetialInfoARR = fielddetialinfo( $USER_VIEW );
$ResultFilter = str_replace( "\\", "", $_GET['filter'] );
$ResultFilter = json_decode( $ResultFilter );
if ( !empty( $ResultFilter ) )
{
				$WHERE_CLAUSE = getwheresqlfilter( $ResultFilter );
}
if ( $ENTITY == "crm_product" && $PROD_TYPE )
{
				$WHERE_CLAUSE .= " and product_type_id = '".$PROD_TYPE."'";
}
$MODULE_ACTION_SINGLE = getmoduleactionsigle( $ENTITY, $USER_VIEW );
$MODULE_ACTION = getmoduleactionstr( $ENTITY, $USER_VIEW );
$PAGE_SIZE = $_GET['PAGE_SIZE'] == "" ? 10 : $_GET['PAGE_SIZE'];
$query = getviewquerycountsql( $USER_VIEW, $ENTITY, $WHERE_CLAUSE, $EXTENSION_AUTHORITY_CLAUSE );

// 是否未交今年会费
$memeberFeeThisYear = $_GET['memeberFeeThisYear'];
if ( $ENTITY == "crm_account" && $memeberFeeThisYear == 'true') {
	//$WHERE_CLAUSE .= " and crm_account.account_id not in(select account_id from crm_salepay where date('Y')=floor(salepay_title))";
	//$query = "SELECT count(*) FROM crm_account a inner join (SELECT account_id FROM crm_salepay WHERE year(now())=floor(salepay_title)) b on  a.id = b.account_id  WHERE a.deleted =0 ";
	$joinClause = " left join (SELECT account_id FROM crm_salepay WHERE year(now())=floor(salepay_title)) b on  crm_account.id = b.account_id ";
	$whereClause = " and b.account_id is null";
	$query = str_replace(' LEFT OUTER JOIN crm_account AS crm_account__account_parent ON crm_account__account_parent.id = crm_account.account_parent', $joinClause, $query);
	$query .= $whereClause;
}
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
$views = getuserviewlist( $ENTITY, $LOGIN_USER_ID, $LOGIN_DEPT_ID, $LOGIN_USER_PRIV );
$VIEW_OPTION_TMPL = getviewseloptiontmpl( $views, $USER_VIEW );
$query = getviewquerysql( $USER_VIEW, $ENTITY, $PAGE_SIZE, $CUR_PAGE, $ORDERFIELD, $ORDERTYPE, $WHERE_CLAUSE, $CONFIGARR, $EXTENSION_AUTHORITY_CLAUSE );
// 是否未交今年会费
if ( $ENTITY == "crm_account" && $memeberFeeThisYear == 'true') {
	$query = str_replace(' LEFT OUTER JOIN crm_account AS crm_account__account_parent ON crm_account__account_parent.id = crm_account.account_parent', $joinClause, $query);
	$query = str_replace(' order by', $whereClause . ' order by', $query);
}
$cursor = exequery( $connection, $query );
$LIST_VIEW_DATA_HEAD_TMPL = getlistviewheadertmpl( $FieldDetialInfoARR, $ORDERFIELD, $ORDERTYPE, $CONFIGARR, $MODULE_ACTION_SINGLE );
$colorSchema = getcolorschema( $USER_VIEW );
$LIST_VIEW_DATA_BODY_TMPL = getlistviewdatabodytmpl( $cursor, $FieldDetialInfoARR, $colorSchema, $PAGE_SIZE, $MODULE_ACTION_SINGLE, ture, "2000", $USER_VIEW );
include( $g_STUDIO_PATH."/include/pagebar_tmpl.php" );
echo getdataloding( );
echo "\t";
echo $MODULE_ACTION;
echo "<table class=\"CRM_TableList\" width=\"100%\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" id=\"datalist\">\r\n\t";
echo $LIST_VIEW_DATA_HEAD_TMPL;
echo "\t";
echo $LIST_VIEW_DATA_BODY_TMPL;
echo "</table>\r\n";
include( $g_STUDIO_PATH."/include/pagebar_tmpl.php" );
?>
