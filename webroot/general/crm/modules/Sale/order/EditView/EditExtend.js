jQuery(document).ready(function(){
	// account_id字段文本框值改变后，清空其它字段文本框数据
	var tmp_arr = new Array("contact_id", "contact_id_text", "quotation_id", "quotation_id_text");
	ClearField("account_id", "propertychange", tmp_arr);
	
	// 选择框依赖字段，选择企业联系人需先选择企业名称
	DependField("contact_id_text", "click", "account_id", "crm_account_contact.account_id","account_id");
	DependField("quotation_id_text", "click", "account_id", "crm_quotation.account_id","account_id");
	//DependField("opportunity_id_text", "click", "account_id", "crm_opportunity.account_id","account_id", true);
	ProductField("quotation_id", "propertychange", "pList", "crm_quotation");
	// 项目编号输入框只读
	jQuery("#order_code").attr("readonly", "true");
	// 屏蔽服务明细部分
	jQuery("#productContainer").remove();

	// 修改部分文字
	// jQuery("#prod_tb .TableHeader").text("服务明细");
	// jQuery("#prod_tb tr:nth-child(2) td:nth-child(2) .TableContent").text("服务编码");
	// jQuery("#prod_tb tr:nth-child(2) td:nth-child(3) .TableContent").text("服务名称");
	// jQuery("#prod_tb tr:nth-child(2) td:nth-child(4) .TableContent").text("收费标准");
	// jQuery("#addProduct").val("添加服务");
});
