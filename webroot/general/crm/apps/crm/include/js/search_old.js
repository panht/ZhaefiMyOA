
// 会费记录页面打开的产品选择页点击某行产品时返回产品名称及价格
function return_collection_amount(obj) {
	var parObj = window.opener;
	refValue0 = jQuery(obj).children().eq(0).children().eq(0).val();
	parObj.jQuery("#salepay_field2").val(refValue0);
	refValue1 = jQuery(obj).children().eq(1).text().trim();
	parObj.jQuery("#salepay_field2_text").val(refValue1);
	refValue2 = jQuery(obj).children().eq(2).text().trim();
	parObj.jQuery("#collection_amount").val(refValue2);
	window.close();
}
// 服务项目页面打开的产品选择页点击某行产品时返回项目名称及编号
function return_order_code(obj) {
	var parObj = window.opener;
	refValue0 = jQuery(obj).children().eq(0).children().eq(0).val();
	parObj.jQuery("#opportunity_id").val(refValue0);
	refValue1 = jQuery(obj).children().eq(1).text().trim();
	parObj.jQuery("#opportunity_id_text").val(refValue1);
	refValue4 = jQuery(obj).children().eq(4).text().trim();
	parObj.jQuery("#order_code").val(refValue4);
	window.close();
}
	
jQuery(document).ready(function(){
	// 如果是从会费记录页面打开，则重新绑定行点击方法
	//if (window.opener.jQuery("#collection_amount")[0] != undefined && window.opener.jQuery("#salepay_field2_text")[0] != undefined ) {
	if (window.location.href.indexOf("salepay_field2&") > 0) {
		var trObjs = jQuery("#datalist tr");
		trObjs.each(function(){
			jQuery(this).unbind("click");
			jQuery(this).bind("click", function() {
				return_collection_amount(this);
			});
		});
	}
	
	// 如果从服务项目页面打开，重新绑定行点击方法
	if (window.location.href.indexOf("to_id=opportunity_id&to_value=opportunity_id_text&view_id=10014&entity_name=crm_product") > 0){
		var trObjs = jQuery("#datalist tr");
		trObjs.each(function(){
			jQuery(this).unbind("click");
			jQuery(this).bind("click", function() {
				return_order_code(this);
			});
		});
	}
	
	
	
	
//	var SearchBoxMinusValue = ( jQuery("#SearchBoxMinusValue").length === 0 ) ? 239 : parseInt(eval("'" + jQuery("#SearchBoxMinusValue").val() + "'"));
//	jQuery("#search_box").css("width", jQuery(window).width()-20)
	jQuery("#search_nor").bind("click",function(){
		jQuery("#search_adv").removeClass("searchhover");
		jQuery("#search_nor").addClass("searchhover");
		jQuery("#con_search_nor").css("display", "block");
		jQuery("#con_search_adv").css("display", "none");
		jQuery("#searchType").val("1");
		changeSearchImg();
		
	});
	jQuery("#search_adv").bind("click", function(){
		jQuery("#search_nor").removeClass("searchhover");
		jQuery("#search_adv").addClass("searchhover");
		jQuery("#con_search_nor").css("display", "none");
		jQuery("#con_search_adv").css("display", "block");
		jQuery("#searchType").val("2");
		changeSearchImg();
	});
	jQuery("#norSearch").bind("click", function(){
		var cnt = 0;
		var temp_url = window.location.search;
		var url = window.location.pathname;
		var param = getUrlQueryString(window.location.search, "param");
		url += setQueryString("CUR_PAGE", "1", "?");
		url += keepQueryString("PAGE_SIZE", "&");
		url += keepQueryString("fieldname", "&");
		url += keepQueryString("fieldvalue", "&");
		url += keepQueryString("USER_VIEW", "&");
		url += keepQueryString("PROD_TYPE", "&");
		url += keepQueryString("entity_name", "&");
		url += keepQueryString("UV_ID", "&");
		jQuery("input[fType='norBtn'], select[fType='norBtn']").each(function(){
			if(jQuery(this).val() != ""){
				var tmp_arr = jQuery(this).attr("id").split(":");
				var tmp_type = tmp_arr[5];
				if(tmp_type == "bool"){
					if(jQuery(document.getElementById(jQuery(this).attr("id"))).attr("checked") == false){
						return true;
					}
				}
				url += "&field"+cnt+"=" + jQuery(this).attr("id");
				url += "&op"+cnt+"=" + getSearchType(tmp_type);
				url += "&value"+cnt+"=" + jQuery(this).val();
				cnt++;
			}
		});
		url += "&cnt=" + cnt;
		url += "&matchtype=all ";
		window.location.href = url;
	});
	
	jQuery("#norAll").bind("click", function(){
		var cnt = 0;
		var temp_url = window.location.search;
		var url = window.location.pathname;
		var param = getUrlQueryString(window.location.search, "param");
		url += setQueryString("CUR_PAGE", "1", "?");
		url += keepQueryString("PAGE_SIZE", "&");
		url += keepQueryString("fieldname", "&");
		url += keepQueryString("fieldvalue", "&");
		url += keepQueryString("USER_VIEW", "&");
		url += keepQueryString("PROD_TYPE", "&");
		url += keepQueryString("entity_name", "&");
		url += keepQueryString("UV_ID", "&");
		url += "&cnt=" + cnt;
		url += "&matchtype=all ";
		window.location.href = url;
	});

	jQuery("#advSearch").bind("click",function(){
		var cnt = 0;
		var temp_url = window.location.search;
		var url = window.location.pathname;
		var param = getUrlQueryString(window.location.search, "param");
		url += setQueryString("CUR_PAGE", "1", "?");
		url += keepQueryString("PAGE_SIZE", "&");
		url += keepQueryString("fieldname", "&");
		url += keepQueryString("fieldvalue", "&");
		url += keepQueryString("USER_VIEW", "&");
		url += keepQueryString("entity_name", "&");
		url += keepQueryString("op_id", "&");
		url += keepQueryString("id", "&");
		url += keepQueryString("to_id", "&");
		url += keepQueryString("to_value", "&");
		url += keepQueryString("view_id", "&");
		url += keepQueryString("PROD_TYPE", "&");
		url += keepQueryString("entity_name", "&");
		url += keepQueryString("UV_ID", "&");
		var count = "";
		jQuery("input[fType='advBtn'], select[fType='advBtn']").each(function(){
			if(jQuery(this).val() == ""){
				var tmp_count =(jQuery(this).parent().parent().attr("id").split("_"));
				var tmp_tr = tmp_count[tmp_count.length-1];
				var re_str = "_field_";
				var tmp_str = "_cond_";
				var val_str = "_value_";
				if(jQuery(this).attr("id").indexOf("_cond_") >= 0){
					re_str  = "_cond_";
					tmp_str = "_field_";
					val_str = "_value_";
				}
				if(jQuery(this).attr("id").indexOf("_value_") >= 0){
					re_str  = "_value_";
					tmp_str = "_field_";
					val_str = "_cond_";
				}
				var tmp_id = jQuery(this).attr("id").replace(re_str, tmp_str );
				var val_id = jQuery(this).attr("id").replace(re_str, val_str );
				if(jQuery("#"+tmp_id).val() == "" && jQuery("#"+val_id).val() == ""){
					return true;
				}
				if( jQuery(this).attr("id").indexOf("_value_") >0 && jQuery(this).attr("readonly")){
					return true;
				}
				var tmp_count =(jQuery(this).parent().parent().attr("id").split("_"));
				var tmp_tr = tmp_count[tmp_count.length-1];
				if(tmp_tr != 0){
					count = tmp_tr;
					return false;
				}
			}
		});
		if(count != ""){
			alert(sprintf(td_lang.crm.apps.msg_66, count));
			return false;
		}
		var total_count = jQuery("#advTable_advCountBtn").val();
		for(var i = 1; i <= total_count; i++ ){
			if(jQuery("#advTable_field_"+i).val() == "" || jQuery("#advTable_cond_"+i).val() == ""){
				continue;
			}
			url += "&field"+cnt+"=" + jQuery("#advTable_field_"+i).val();
			url += "&op"+cnt+"=" + jQuery("#advTable_cond_"+i).val();
			url += "&value"+cnt+"=" + jQuery("#advTable_value_"+i).val();
			cnt++;
		}
		url += "&cnt=" + cnt;
		url += "&searchType=2&matchtype=" + jQuery("input[type='radio'][name='matchtype']:checked").val();
		window.location.href = url;

	});
	
	jQuery("#advAll").bind("click",function(){
		var cnt = 0;
		var temp_url = window.location.search;
		var url = window.location.pathname;
		var param = getUrlQueryString(window.location.search, "param");
		url += setQueryString("CUR_PAGE", "1", "?");
		url += keepQueryString("PAGE_SIZE", "&");
		url += keepQueryString("fieldname", "&");
		url += keepQueryString("fieldvalue", "&");
		url += keepQueryString("USER_VIEW", "&");
		url += keepQueryString("entity_name", "&");
		url += keepQueryString("op_id", "&");
		url += keepQueryString("id", "&");
		url += keepQueryString("to_id", "&");
		url += keepQueryString("to_value", "&");
		url += keepQueryString("view_id", "&");
		url += keepQueryString("PROD_TYPE", "&");
		url += keepQueryString("entity_name", "&");
		url += keepQueryString("UV_ID", "&");
		url += "&cnt=" + cnt;
		url += "&searchType=2&matchtype=" + jQuery("input[type='radio'][name='matchtype']:checked").val();
		window.location.href = url;

	});
	
	var tmp_cnt = getQueryString("cnt");
	jQuery("input[name='matchtype'][value='"+getQueryString("matchtype")+"']").attr("checked", true);
	var tmp_searchType = getQueryString("searchType");
	if(tmp_searchType == null){
		jQuery("#search_nor").addClass("searchhover");
	}else{
		jQuery("#search_adv").addClass("searchhover");
	}
	var adv_count = 0;
	var adv_total_count = (jQuery("#searchNum").length === 0) ? 3 : jQuery("#searchNum").val();
	for(var k = 0; k < tmp_cnt; k++){
		var tmp_fld = getQueryString("field"+k);
		var tmp_fld_type = (tmp_fld.split(":"))[5];
		var tmp_val = getQueryString("value"+k);
		var tmp_op = getQueryString("op"+k);
		if(tmp_searchType == null){
			jQuery(document.getElementById(tmp_fld)).attr("checked", true);
			jQuery(document.getElementById(tmp_fld)).val(tmp_val);
		}else{
			jQuery("#advTable").addAdvSearch({
				advfield: tmp_fld,
				advtype: tmp_op,
				advvalue: tmp_val
			});
			adv_count++;
		}
	}
	for(adv_count; adv_count < adv_total_count; adv_count++){
		jQuery("#advTable").addAdvSearch({
				advfield: "",
				advtype: "",
				advvalue: ""
			});
	}
	jQuery("#hd_search_img").bind("click", function(){
		var org_src = jQuery(this).attr("src");
		var find_str = "_up.png";
		var reg_str = "_down.png";
		if(org_src.indexOf(find_str)>0){
			var new_src = org_src.replace(find_str, reg_str);
			jQuery("#con_search_nor").slideUp();
			jQuery("#con_search_adv").slideUp();
		}else{ //down.png
			var new_src = org_src.replace(reg_str, find_str);
			if(jQuery("#searchType").val() == undefined || jQuery("#searchType").val() == "1" || jQuery("#searchType").val()== "" ){
				jQuery("#con_search_nor").slideDown();
			}else{
				jQuery("#con_search_adv").slideDown();
			}
		}
		jQuery(this).attr("src", new_src);
	});

});

function getSearchType(type){
	var tmp_type = "";
	switch(type){
		case "status":
			tmp_type = "sc_cts";
			break;
		case "dept":
			tmp_type = "dept_cts";
			break;
		case "user":
			tmp_type = "user_cts";
			break;
		case "date":
		case "datetime":
		case "time":
			tmp_type = "is";
			break;	
		default :
			tmp_type = "cts";
			break;
	}
	return tmp_type;
}
function changeSearchImg(){
	var org_src = jQuery("#hd_search_img").attr("src");
	var find_str = "_up.png";
	var reg_str = "_down.png";
	if(org_src.indexOf(reg_str)>0){
		var new_src = org_src.replace(reg_str, find_str);
		jQuery("#hd_search_img").attr("src", new_src);
	}
}
function sizeFix(){
		var oList = [
		'#search_box',
		'#datalist_box',
		'#datalist_box .sData'		
		];	
		var newWidth =  jQuery(window).width()-20;

		jQuery.each(oList,function(i,n){
				jQuery(n).width(newWidth);
		});
		jQuery('table.CRM_Dialog').css({'left' : (newWidth/2 -300)});
}