jQuery(document).ready(function(){
	var tmp_arr = new Array("opportunity_id", "opportunity_id_text", "contact_id", "contact_id_text", "quotation_id", "quotation_id_text");
	ClearField("account_id", "propertychange", tmp_arr);
	DependField("contact_id_text", "click", "account_id", "crm_account_contact.account_id","account_id");
	DependField("quotation_id_text", "click", "account_id", "crm_quotation.account_id","account_id");
	//DependField("opportunity_id_text", "click", "account_id", "crm_opportunity.account_id","account_id", true);
	ProductField("quotation_id", "propertychange", "pList", "crm_quotation");
	
	// �޸Ĳ�������
	jQuery("#prod_tb .TableHeader").text("������ϸ");
	jQuery("#prod_tb tr:nth-child(2) td:nth-child(2) .TableContent").text("�������");
	jQuery("#prod_tb tr:nth-child(2) td:nth-child(3) .TableContent").text("��������");
	jQuery("#prod_tb tr:nth-child(2) td:nth-child(4) .TableContent").text("�շѱ�׼");
	jQuery("#addProduct").val("��ӷ���");
});
