<title>Leech User.apphd.vn</title>
<?php
session_start();
require 'head.php';
if (!isset($_SESSION["domain"]))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>Bạn chưa đăng nhập! <a href="index.php">Login</a>';
}
elseif (!isset($_GET['url']))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><form method="get">Url: <input name="url" type="text"><br /><input type="submit" value="Leech" ></form>';
}
elseif ($_POST['submit']){
$post = post_dl($_POST['title'],$_POST['url'],$_POST['content'], $_POST['tags'],$_POST['img_thumb'],$_POST['title_seo'],$_POST['link_down'],$_POST['desc'],$_POST['temp_index'],$_POST['box'],$_POST['phan_trang'],$_POST['submit']);
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
$ico = explode('<td width="52" style="padding:0">',$lay);
$ico = explode('</td>',$ico[1]);
$ico = preg_replace('#<img(.*?)src="(.*?)"(.*?)/>#is',"$2",$ico[0]);
$ico= trim($ico);
$lay = explode('<div class="app_intro" style="position:relative;max-height:150px;overflow:hidden;">',$lay);
$lay = explode('<div class="show-more-end">',$lay[1]);
$lay = trim($lay[0]);
$lay = strip_tags($lay,'<p>,<br>,<b>,<i>,<u>,<strong>');
curl_close($curl);
$down =  str_replace('/apps/','/download/',$url);
$down =  str_replace('.html','.apk',$down);
echo '<form method="post">
* Tiêu đề:<br/><input type="text" name="title" id="title" value="'.$title.'" required=""/><br/>
URL:<br/> <input type="text" name="url" id="url" value=""/><br />
* Nội dung:<br/><textarea name="content">'.$lay.'</textarea><br/>
Từ khóa:(Cách nhau dấu ",")<br/>
<input type="text" name="tags" value="'.$title.'"/><br/>
Ảnh đại diện: <br/><input type="text" name="img_thumb" value="'.$ico.'"/><br/>
Title trên google:<br/><input type="text" name="title_seo" value=""/><br/>
Link tải:(Dùng HTML)<br/>
<textarea name="link_down" id="editor">'.$down.'</textarea><br/>
Link tải Game: (Hiển thị ở trang chủ)<br/>
<input type="text" name="down_index" value="'.$down.'"/><br/>
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