<title>Leech doctruyen360.com</title>
<?php
session_start();
require 'head.php';
if (!isset($_SESSION["domain"]))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>Bạn chưa đăng nhập! <a href="index.php">Login</a>';
}
elseif (!isset($_GET['url']))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>Không đảm bảo khi leech truyện quá dài.<br /><form method="get">Url: <input name="url" type="text"><br /><input type="submit" value="Leech" ></form>';
}
elseif ($_POST['submit']){
$post = post_dl($_POST['title'],$_POST['url'],$_POST['content'], $_POST['tags'],$_POST['img_thumb'],$_POST['title_seo'],$_POST['link_down'],$_POST['desc'],$_POST['temp_index'],$_POST['box'],$_POST['phan_trang'],$_POST['submit'],$_POST['down_index']);
echo $post;
echo '<u>Tiếp tục</u>:<br /><form method="get">Url: <input name="url" type="text"><br /><input type="submit" value="Leech" ></form>';
}
else
{
$url = $_GET['url'];
$url =  str_replace('http://','',$url);
$url =  str_replace($url,'http://'.$url ,$url);
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$lay = curl_exec($curl);
$title = explode('<title>',$lay);
$title = explode('</title>',$title[1]);
$title = explode('|',$title[0]);
$title = trim($title[0]);
$loc = explode('<div class="entry">',$lay);
$lay = explode('<ul>',$loc[1]);
$loc = explode('</ul>',$lay[1]);
$loc = trim($loc[0]);
$loc = strip_tags($loc,'<li>,<a>');
$loc = preg_replace('/<li><a(.*?)href="(.*?)"(.*?)<\/a><\/li>(\n|)/i','$2|', $loc);
$loc = explode('|',$loc);
$lay = strip_tags($lay[0],'<p>,<br>,<b>,<i>,<u>,<strong>');
$lay = preg_replace('/(doctruyen360.com|doctruyen360)/i','', $lay);
curl_close($curl);
$kt = count($loc);

echo '<br /><form method="post">
* Tiêu đề:<br/><input type="text" name="title" id="title" value="'.$title.'" required=""/><br/>
URL:<br/> <input type="text" name="url" id="url" value=""/><br />
* Nội dung:<br/><textarea name="content">';
if($url != $loc[$i]) echo $lay;
$curl = curl_init();
for($i=$kt;$i>=0;$i--)
{
curl_setopt ($curl, CURLOPT_URL, $loc[$i]);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$lay = curl_exec($curl);
$lay = explode('<div class="dtct1072">',$lay);
$lay = explode('<div class="fb-like"',$lay[1]);
$lay = trim($lay[0]);
$lay = preg_replace('/Đọc tiếp <a(.*)<\/a>/i','', $lay);
$lay = strip_tags($lay,'<p>,<br>,<b>,<i>,<u>,<strong>');
$lay = preg_replace('/(doctruyen360.com|doctruyen360)/i','', $lay);
echo $lay;
}
curl_close($curl);
echo '</textarea><br />
Từ khóa:(Cách nhau dấu ",")<br/>
<input type="text" name="tags" value="'.$title.'"/><br/>
Ảnh đại diện: <br/><input type="text" name="img_thumb" value=""/><br/>
Title trên google:<br/><input type="text" name="title_seo" value=""/><br/>
Link tải:(Dùng HTML)<br/>
<textarea name="link_down" id="editor"></textarea><br/>
Link tải Game: (Hiển thị ở trang chủ)<br/>
<input type="text" name="down_index" value=""/><br/>
Mô tả:<br/><input type="text" name="desc" value=""/><br/>
Mục hiển thị:<br />
'.$_SESSION["cm"].'
<label for="phan_trang">
<input type="checkbox" name="phan_trang" value="1"/> Phân trang
</label><br/>
<input type="submit" name="submit" value="Đăng bài"/>
</form>';
}
?>