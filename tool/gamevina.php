<title>Leech gamevina.us</title>
<?php
session_start();
require 'head.php';
if (!isset($_SESSION['domain']))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>Bạn chưa đăng nhập! <a href="/">Đăng nhập</a>';
}
elseif (!isset($_GET['url']))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><form method="get">Url: <input name="url" type="text"><br /><input type="checkbox" name="down" value="1"/>Hiện link download (do có rất nhiều chuyên mục và kiểu link khác nhau nên không thể nào chính xác 100% được mọi người thông cảm)<br /><input type="submit" value="Leech" ></form>';
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
curl_setopt ($curl, CURLOPT_URL, 'http://h.leech.tk/curl.php?url='.$url);
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.1.2; vi; SAMSUNG Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 UCBrowser/9.7.5.418 U3/0.8.0 Mobile Safari/533.1');
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$title = curl_exec($curl);
$lay = explode('</article>',$title);
$lay = explode('<div class=menu><center>',$lay[1]);
$lay = preg_replace('#<style>(.*?)</style>(.*?)<style>(.*?)</style>#is',"",$lay[0]);
$downa = strstr($lay,'<div class=menu><img');
if (!$downa){
$downa = strstr($lay,'<center><img');
}
$downb = strstr($downa,'<div class=menu><center>');
$down = str_replace($downb,'',$downa); 
$lay =  str_replace($down,'',$lay);
$lay = strip_tags($lay,'<p>,<br>,<b>,<i>,<u>,<strong>,<img>');
$lay = trim($lay);
$tag = explode('<div class=list1>Tags :',$title);
$tag = explode('</a></div>',$tag[1]);
$tag = strip_tags($tag[0]);
$title = explode('<title>',$title);
$title = explode('</title>',$title[1]);
$title = trim($title[0]);
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
$down =  str_replace('[<a href="o','[<a href="http://gamevina.us/o',$down);
$down = trim($down);
$down = preg_replace('#\r\n#is','',$down);
if ($_GET['down']){echo preg_replace('/\)/s', ")\n",$down);}
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