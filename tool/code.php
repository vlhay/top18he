<title>Xem mã nguồn</title>
<?php
session_start();
require 'head.php';
if (!isset($_GET['url']))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<form method="get">Url: <input name="url" type="text"><br />
<input type="radio" name="td" value="web" checked="checked"/>Xem mã nguồn ở chế độ Web<br />
<input type="radio" name="td" value="android" />Xem mã nguồn bằng Smartphone Android<br />
<input type="radio" name="td" value="java" />Xem mã nguồn bằng điện thoại Java<br />
<input type="submit" value="Leech" ></form>';
}
else
{
	if($_GET[td] == 'android')
	{
	$td = 'Mozilla/5.0 (Linux; Android 4.2.1; en-us; Nexus 4 Build/JOP40D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19';
	}
	elseif($_GET[td] == 'java')
	{
	$td = 'NokiaN97/21.1.107 (SymbianOS/9.4; Series60/5.0 Mozilla/5.0; Profile/MIDP-2.1 Configuration/CLDC-1.1) AppleWebkit/525 (KHTML, like Gecko) BrowserNG/7.1.4';
	}
	else
	{
	$td = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/45.0 Chrome/39.0.2171.95 Safari/537.36';
	}
$url = $_GET['url'];
$url = preg_replace('#(https://|http://)(.*)#i', '$1$2', $url);
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_USERAGENT, $td);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$lay = curl_exec($curl);
curl_close($curl);
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><code>'.htmlentities($lay);
}
?>


