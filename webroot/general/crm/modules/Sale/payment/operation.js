// 显示收款金额小结
// \webroot\general\crm\apps\crm\include\js\search.js 114行getListInfo方法，在ajax成功回调方法中也要调用这个方法
function displayPaymentAmout(offset) {
	// 获得收款金额所在列序号
	var i = 0, j;
	jQuery("#datalist tr:nth-child(1) td").each(function() {
		i++;
		if (jQuery(this).text().trim() == "会费金额") {
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

// 页面载入时调用一次
displayPaymentAmout(1);