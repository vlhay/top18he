<title>Leech phuthobay.pro</title>
<?php
session_start();
require 'head.php';
if (!isset($_SESSION['domain']))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>Bạn chưa đăng nhập! <a href="/">Đăng nhập</a>';
}
elseif (!isset($_GET['url']))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><form method="get">Url: <input name="url" type="text"><br /><input type="checkbox" name="down" value="1"/>Hiện link download<br /><input type="submit" value="Leech" ></form>';
}
elseif ($_POST['submit']){
$post = post_dl($_POST['title'],$_POST['url'],$_POST['content'], $_POST['tags'],$_POST['img_thumb'],$_POST['title_seo'],$_POST['link_down'],$_POST['desc'],$_POST['temp_index'],$_POST['box'],$_POST['phan_trang'],$_POST['submit']);
echo $post;
echo '<u>Tiếp tục</u>:<br /><form method="get">Url: <input name="url" type="text"><br /><input type="checkbox" name="down" value="1"/>Hiện link download<br /><input type="submit" value="Leech" ></form>';
}
else
{
$cm = $_SESSION['cm'];
$url = $_GET['url'];
$url =  str_replace('http://','',$url);
$url =  str_replace($url,'http://'.$url ,$url);
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$title = curl_exec($curl);
$lay = explode('<a name="up" id="up"></a>',$title);
$lay = explode('Like Fb----------- -->',$lay[1]);
$lay = trim($lay[0]);
$downa = strstr($lay,'<div class="menu"><img src="/icon/down.png"');
$downb = strstr($down,'<!-- ---------');
$down = str_replace($downb,'',$downa); 
$lay =  str_replace($down,'',$lay);
$lay = strip_tags($lay,'<p>,<br>,<b>,<i>,<u>,<strong>,<img>,<a>');
$lay= preg_replace('#<img(.*?)src="(.*?)"(.*?)/>#is',"[img]http://phuthobay.pro$2[/img]",$lay);
$lay =  str_replace('[img]http://phuthobay.pro/icon/up.jpg[/img]','',$lay);
$lay =  str_replace('[img]http://phuthobay.pro/icon/down.jpg[/img]','',$lay);
$lay= preg_replace('#<a href="(.*?)(.jpg|.gif|.png)"(.*?)>(.*?)</a>#i',"[url=http://phuthobay.pro$1$2]$4[/url]",$lay);
$lay = strip_tags($lay,'<p>,<br>,<b>,<i>,<u>,<strong>,<img>');
$lay = trim($lay);
$tag = explode('<font color="red">• Xem Thêm:</font>',$title);
$tag = explode('</div>',$tag[1]);
$tag = strip_tags($tag[0]);
$title = explode('<title>',$title);
$title = explode('</title>',$title[1]);
$title = trim($title[0]);
$title = strip_tags($title);
curl_close($curl);
echo '<form method="post">
* Tiêu đề:<br/><input type="text" name="title" id="title" value="'.$title.'" required=""/><br/>
URL:<br/> <input type="text" name="url" id="url" value=""/><br />
* Nội dung:<br/><textarea name="content">'.$lay.'</textarea><br/>
Từ khóa:(Cách nhau dấu ",")<br/>
<input type="text" name="tags" value="'.$tag.'"/><br/>
Ảnh đại diện: <br/><input type="text" name="img_thumb" value=""/><br/>
Title trên google:<br/><input type="text" name="title_seo" value=""/><br/>
Link tải:(Dùng HTML)<br/>
<textarea name="link_down" id="editor">';
$down = strip_tags($down,'<a>');
$down = preg_replace('#(.*?)<a(.*?)href="(.*?)"(.*?)>(.*?)</a>(.*?)#is','<a href="$3" title="$5">$5</a><br /><br>',$down);
$down =  str_replace('<a href="#up" title=""></a><br /><br>','',$down);
$down = trim($down);
if ($_GET['down']){echo preg_replace('#<br>#i', "\n",$down);}
echo '</textarea><br/>
Mô tả:<br/><input type="text" name="desc" value=""/><br/>
Mục hiển thị:<br />
'.$_SESSION['cm'].'
<label for="phan_trang">
<input type="checkbox" name="phan_trang" value="1"/> Phân trang
</label><br/>
<input type="submit" name="submit" value="Đăng bài"/>
</form>';
}
?>