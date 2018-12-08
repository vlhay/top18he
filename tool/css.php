<?php
session_start();
require 'head.php';
if (!isset($_SESSION['domain']))
{
echo 'Bạn chưa đăng nhập! <a href="/">Đăng nhập</a>';
}
else {
if (!isset($_POST['submit']) && !isset($_POST['s']))
{
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL,'http://wapseo.mobi/panel/index.php?mod=style&act=edit');
curl_setopt($curl, CURLOPT_COOKIEFILE, 'hehe/'.$_SESSION['domain'].'.txt');
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$lay = curl_exec($curl);
$lay = explode('<textarea name="style" id="edited_css" rows="10">',$lay);
$lay = explode('</textarea>',$lay[1]);
$lay = trim($lay[0]);
$lay =  str_replace('<br />','',$lay);
$lay = explode('}',$lay);
$dem = count($lay);
echo '<form action="/css.php" method="post"><input type="hidden" name="dem" value="'.($dem-1).'">';
for ($i=0; $i < ($dem-1) ; $i++) { 
echo '<textarea name="style'.$i.'">'.trim($lay[$i]).'}</textarea><br />';
}
echo '<input type="submit" name="s" value="OK"/></form>';
curl_close($curl);
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
}
elseif (isset($_POST['s']))
{
echo '<form action="/css.php" method="post"><textarea name="sty">';
for ($i=0; $i <= $_POST['dem']; $i++) { 
$_POST['style'.$i] =  str_replace('}','}<br />',$_POST['style'.$i]);
echo preg_replace('#<br\s*/?>#i', "\n",$_POST['style'.$i]);
}
echo '</textarea><br /><input type="submit" name="submit" value="OK"/></form>';
}
elseif (isset($_POST['submit']))
{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://wapseo.mobi/panel/index.php?mod=style&act=edit');
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'hehe/'.$_SESSION['domain'].'.txt');
curl_setopt ($ch, CURLOPT_POSTFIELDS,'style='.$_POST['sty'].'&submit=OK');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$tb = curl_exec($ch);
$tb = explode('<div class="phdr border_blue">',$tb);
$tb = explode('<div class="phdr border_red">',$tb[1]);
$tb = trim($tb[0]);
curl_close($ch);
echo $tb;
}
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>