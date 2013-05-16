// 添加打印会员证
var cert_pos = window.location.href.indexOf("&id=");
var cert_id = window.location.href.substr(cert_pos + 4);
jQuery("#sider .acts").prepend("<li><a href='#' onclick=\"window.open('../../../../print_certificate.php?id=" + cert_id + "', '', '');\">打印会员证</a></li>");