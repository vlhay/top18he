<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<big><center>LEECH.TK</center></big><hr />
<?php
if (isset($_COOKIE["domain"]))
{
	$_SESSION["domain"] = $_COOKIE["domain"];
	$_SESSION["cm"] = $_COOKIE["cm"];
}
if ($_SESSION["domain"])
{
echo '<table width="100%" border="0">
<tr>
<td width="50%" align="center"><a href="index.php"><b>Menu Tool</b></a></td>
<td width="50%" align="center"><b style="text-transform: uppercase;"><a href="/index.php?xoa">Thoát</a></b></td>
</tr>
</table>
<hr />';
}
function post_dl($_title,$_url,$_nd,$_tags,$_img,$_seo,$_down,$_des,$_index,$_cm,$_pt,$_su,$_downindex)
{
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://wapseo.mobi/panel/index.php?mod=new_topic');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'hehe/'.$_SESSION["domain"].'.txt');
curl_setopt ($ch, CURLOPT_POSTFIELDS,
               array('title'=> $_title,
                     'url'=> $_url,
                     'content'=> $_nd,
                     'tags' => $_tags,
                     'img_thumb' => $_img,
                     'title_seo' => $_seo,
                     'link_down' => $_down,
					 'down_index' => $_downindex,
                     'desc' => $_des,
                     'temp_index' => $_index,
                     'box' => $_cm,
                     'phan_trang' => $_pt,
                      'submit' => $_su                  
                        ));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$tb = curl_exec($ch);
$tb = explode('<div class="phdr border_blue">',$tb);
$tb = explode('<div class="phdr border_red">',$tb[1]);
$tb = trim($tb[0]);
curl_close($ch);
echo '<b><div>'.$tb.'</b><br />';
}
?>