<title>Leech PinYeu.com</title>
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
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.1.2; vi; SAMSUNG Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 UCBrowser/9.7.5.418 U3/0.8.0 Mobile Safari/533.1');
$lay = curl_exec($curl);
$title = explode('<title>',$lay);
$title = explode('</title>',$title[1]);
$title = trim($title[0]);
$ico = explode('<article class="hreview-aggregate">',$lay);
$ico = explode('" class="photobv wp-post-image"',$ico[1]);
$ico = preg_replace('#(.*?)<img(.*?)src="(.*?)#is',"$3",$ico);
$ico = trim($ico[0]);
$key = explode('<div class="bottom-content">',$lay);
$key = explode('</div>',$key[1]);
$key =  str_replace('Từ khóa: ','',$key[0]);
$key =  str_replace('</a>',',',$key);
$key = strip_tags($key);
$key= trim($key);
$lay = explode('<div id="content" class="pad">',$lay);
$lay = explode('<div id="wp_page" class="center-title">',$lay[1]);
$lay = trim($lay[0]);
$lay = strip_tags($lay,'<p>,<br>,<b>,<i>,<u>,<strong>,<img>');
$lay = trim($lay);
curl_close($curl);
echo '<form method="post">
* Tiêu đề:<br/><input type="text" name="title" id="title" value="'.$title.'" required=""/><br/>
URL:<br/> <input type="text" name="url" id="url" value=""/><br />
* Nội dung:<br/><textarea name="content">'.$lay.'</textarea><br/>
Từ khóa:(Cách nhau dấu ",")<br/>
<input type="text" name="tags" value="'.$key.'"/><br/>
Ảnh đại diện: <br/><input type="text" name="img_thumb" value="'.$ico.'"/><br/>
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