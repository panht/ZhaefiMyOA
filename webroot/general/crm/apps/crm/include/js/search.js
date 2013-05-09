jQuery(document).ready(function(){
	jQuery("#search_nor").live("click",function(){
	
		jQuery("#con_search_nor").css("display", "");
		jQuery("#con_search_adv").css("display", "none");
		jQuery("#searchType").val("1");
		this.id = 'search_adv';
		this.innerHTML = '高级';	
		
		jQuery('.search_buttons>button').each(function(){
				this.id = this.id.toString().replace('adv', 'nor');
		});
	});
	jQuery("#search_adv").live("click", function(){
	
		jQuery("#con_search_nor").css("display", "none");
		jQuery("#con_search_adv").css("display", "");
		jQuery("#searchType").val("2");
		this.id = 'search_nor';
		this.innerHTML = '普通';
		
		jQuery('.search_buttons>button').each(function(){
				this.id = this.id.toString().replace('nor', 'adv');
		});
	
	});
	jQuery("#norSearch").live("click", function(){

	 	var norSearchInfo = jQuery('#con_search_nor').getSearchInfo();
	 	
	 	indexInfo.filter = JSON.stringify(norSearchInfo);
	 	
	 	indexInfo.CUR_PAGE = '';
				
		getListInfo(indexInfo);
	});
	
	jQuery("#norAll").live("click", function(){
		
		indexInfo.filter = '';
		
		indexInfo.CUR_PAGE = '';
		
		getListInfo(indexInfo);
	});

	jQuery("#advSearch").live("click",function(){
		
		filterClass.getFilterGroupInfo();
		
		indexInfo.filter =  JSON.stringify(filterClass.FilterInfo);
		
		indexInfo.CUR_PAGE = '';
		
		getListInfo(indexInfo);
	});
	
	jQuery("#advAll").live("click",function(){
		
		indexInfo.filter = '';
		
		indexInfo.CUR_PAGE = '';
		
		getListInfo(indexInfo);
	});
	
	jQuery("select.searchCondition").change();
});

filterClass.noRuntime = true;

jQuery.fn.searchConditionChange = function() {

			var _this = this;
			var this_value =_this.val();
			var this_search_panel = _this.parents('table.search_base_panel');
			var next_value = this_search_panel.find('td.search_value input:first').val() || "";
			var this_type = _this.find('option:selected').attr('subtype');
			var ref_entity_view = _this.find('option:selected').attr('ref_entity_view');
			var ref_entity = _this.find('option:selected').attr('ref_entity');
			var picklist_name = _this.find('option:selected').attr('picklist_name');
			var full_field_name = _this.parents('table.search_base_panel').find('td.search_label input.searchField').val();
			var filterBoxContainer = _this.parent().siblings('td.search_value');
			var filterBoxType = getFilterBoxType(this_type,this_value);
			var filterBox = filterBoxContainer.find('div.filterBox[fType='+filterBoxType+']');
			if(filterBox.length) {
				filterBox.siblings('div.filterBox').hide();
				filterBox.show();
			} else {
				var thisPanel = _this.parents('table.search_base_panel').get(0);
				var _index = (jQuery(thisPanel).index('table.search_base_panel')) + 1;
				var html = condition_type(this_type,this_value,_index,ref_entity_view,ref_entity,picklist_name,'','norSearchForm');
				filterBoxContainer.find('div.filterBox').hide();
				filterBoxContainer.append(html);
			}
};
jQuery.fn.getSearchInfo = function () {
			var searchInfo = [];
			var count = 0;
			searchInfo.push({"group_no":"0","parent_no":"0","relation":"and","group_relation":"1"});	
			this.find('table.search_base_panel').each(function(i,n){
					var Info = new Object;
					var valueArray=[];
					var datatype = null;
					var skip = true;
					var oCondition = jQuery('select.searchCondition',n).find('option:selected');
					var filterBoxType = getFilterBoxType(oCondition.attr('subtype'),oCondition.val());
					var oFilterBox = jQuery(n).find('div.filterBox[fType='+filterBoxType+']');

					Info.field_name = jQuery('input.searchField',n).val();
					Info.filter_condition = oCondition.val();

					oFilterBox.find('select,input').each(function(m,ovalue){
						valueArray.push(jQuery(ovalue).val());
						datatype ?  null : datatype = jQuery(ovalue).attr('datatype');
						if(ovalue.type == 'hidden')  return false;
					});
					Info.filter_value = valueArray.join(',');
					skip =! (( oFilterBox.find('select,input').length > 0 && Info.filter_value != "") || (oFilterBox.find('select,input').length == 0));
					skip ? null : count++;
					datatype ? Info.filter_datatype = datatype : null;
					Info.parent_no = 0;
					Info.group_ralation = 0;
					Info.order_no = count;
					skip ? null : searchInfo.push(Info);
			});
			return searchInfo;
};

function getListInfo( _datas){
		var loading = jQuery('#data_loading');
		loading.show();
		var url = window.g_ModuleListUrl ||  g_CRM_PATH + '/include/search.php';
		var _datas = _datas || {};
	 	jQuery.ajax({
			type	: "GET",
			async : true,
			data : _datas,
			url	: url,
			timeout: 10000,
			success: function(msg){
				jQuery('#data_block').html(msg);
				initIndex() || initListData();
				displayPaymentAmout(0);
		   },
			error: function(msg){
				loading.hide();
				var message = msg.responseText || 'Timeout!';
				alert(message);
				return false;
			}
		});
}


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

function getRencents( _datas){
		var url = '/general/crm/apps/crm/include/data_rencents.php';
		var _datas = _datas || {};
	 	jQuery.ajax({
			type	: "GET",
			async : true,
			data : _datas,
			url	: url,
			timeout: 10000,
			success: function(msg){
				jQuery('#data_recents').html(msg);
		   },
			error: function(msg){
				var message = msg.responseText || 'Timeout!';
				alert(message);
				return false;
			}
		});
}

function getRencent_views( _datas){
		var url = '/general/crm/apps/crm/include/view_rencents.php';
		var _datas = _datas || {};
	 	jQuery.ajax({
			type	: "GET",
			async : true,
			data : _datas,
			url	: url,
			timeout: 10000,
			success: function(msg){
				jQuery('#view_recents').html(msg);
				jQuery('#view_recents').find('[v_id='+_datas.USER_VIEW+']').click();
		   },
			error: function(msg){
				var message = msg.responseText || 'Timeout!';
				alert(message);
				return false;
			}
		});
}

// 显示收款金额小结
// \webroot\general\crm\apps\crm\include\js\search.js getListInfo方法的ajax成功回调方法要调用这个方法
function displayPaymentAmout(offset) {
	// 获得收款金额所在列序号
	var i = 0, j;
	jQuery("#datalist tr:nth-child(1) td").each(function() {
		i++;
		if (jQuery(this).text().trim() == "会费金额" || jQuery(this).text().trim() == "收费金额") {
			j = i;
		}
	});
	
	if (j > 0) {
		var amount = 0;
		// 不同视图导致收款金额所在列不一样，全部视图要+1，其它视图不用+1
		if (offset == null) {
			offset = 0;
		}
		j = j + offset;
		
		// 计算金额的和
		jQuery("#datalist tr:not(#tableTr) td:nth-child(" + j + ")").each(function(){
			value = parseInt(jQuery(this).text().replace(",", ""));
			if (!isNaN(value)) {
				amount += value;
			}
		});
		
		// 显示在分页处
		jQuery(".page_bar_bg").last().prepend("<span style='color:red'>小计：" + amount + "</span>&nbsp;&nbsp;&nbsp;&nbsp;");
	}
}