jQuery(document).ready(function(){
	var clickEvent = jQuery("#field1_text").attr("onclick");
	jQuery("#field1_text").attr("onclick","");
	clickEvent = clickEvent.replace("selRefSingle","selRefContact");
	jQuery("#field1_text").click(function(){	
		eval(clickEvent);
	});
	jQuery("#account_id").bind("propertychange",function(){
		jQuery("#field1").val("");
		jQuery("#field1_text").val("");
	});
});


function selRefContact(to_id,to_value,view_id,entity){
	var filter = "";
	if(document.getElementById("account_id")){
		var account_id = document.getElementById("account_id").value;
		if(account_id == ""){
			alert("请选择对应企业！");
			return false;
		}
		filter = entity+".account_id ="+account_id;
	}
	var url = g_CRM_PATH+"/include/reference.php?to_id="+to_id+"&to_value="+to_value+"&view_id="+view_id+"&entity_name="+entity+"&filter="+filter;
	openWindow(url,750,520,"","selRef");
}