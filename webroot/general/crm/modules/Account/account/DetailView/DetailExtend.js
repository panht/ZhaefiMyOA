// ��Ӵ�ӡ��Ա֤
var cert_pos = window.location.href.indexOf("&id=");
var cert_id = window.location.href.substr(cert_pos + 4);
jQuery("#sider .acts").prepend("<li><a href='#' onclick=\"window.open('../../../../print_certificate.php?id=" + cert_id + "', '', '');\">��ӡ��Ա֤</a></li>");