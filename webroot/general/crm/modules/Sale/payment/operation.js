// ��ʾ�տ���С��
// \webroot\general\crm\apps\crm\include\js\search.js 114��getListInfo��������ajax�ɹ��ص�������ҲҪ�����������
function displayPaymentAmout(offset) {
	// ����տ������������
	var i = 0, j;
	jQuery("#datalist tr:nth-child(1) td").each(function() {
		i++;
		if (jQuery(this).text().trim() == "��ѽ��") {
			j = i;
		}
	});
	
	if (j > 0) {
		var amount = 0;
		// ��ͬ��ͼ�����տ��������в�һ����ȫ����ͼҪ+1��������ͼ����+1
		if (offset == null) {
			offset = 0;
		}
		j = j + offset;
		
		// ������ĺ�
		jQuery("#datalist tr:not(#tableTr) td:nth-child(" + j + ")").each(function(){
			value = parseInt(jQuery(this).text().replace(",", ""));
			if (!isNaN(value)) {
				amount += value;
			}
		});
		
		// ��ʾ�ڷ�ҳ��
		jQuery(".page_bar_bg").last().prepend("<span style='color:red'>С�ƣ�" + amount + "</span>&nbsp;&nbsp;&nbsp;&nbsp;");
	}
}

// ҳ������ʱ����һ��
displayPaymentAmout(1);