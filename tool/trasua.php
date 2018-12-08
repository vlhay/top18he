<title>Leech trasua.mobi</title>
<?php
session_start();
require 'head.php';
if (!isset($_SESSION['domain']))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>Bạn chưa đăng nhập! <a href="/">Đăng nhập</a>';
}
elseif (!isset($_GET['url']))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<form method="get">Url: <input name="url" type="text"><br />
 Phân trang (bỏ trống để leech hết truyện) cách nhau dấu . VD: "1.2"
 <br /> <input name="trang" type="text"><br />
<input type="submit" value="Leech" ></form>';
}
elseif ($_POST['submit']){
$post = post_dl($_POST['title'],$_POST['url'],$_POST['content'], $_POST['tags'],$_POST['img_thumb'],$_POST['title_seo'],$_POST['link_down'],$_POST['desc'],$_POST['temp_index'],$_POST['box'],$_POST['phan_trang'],$_POST['submit']);
echo $post;
echo '<u>Tiếp tục</u>:<br /><form method="get">Url: <input name="url" type="text"><br />
 Phân trang (bỏ trống để leech hết truyện) cách nhau dấu . VD: "1.2"
 <br /> <input name="trang" type="text"><br />
<input type="submit" value="Leech" ></form>';
}
else
{
$url = $_GET['url'];
$url =  str_replace('http://','',$url);
$url =  str_replace($url, 'http://'.$url ,$url);
$curl = curl_init();
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.1.2; vi; SAMSUNG Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 UCBrowser/9.7.5.418 U3/0.8.0 Mobile Safari/533.1');
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$title = curl_exec($curl);
$pt = explode('[<b class="page">1</b>]',$title);
$pt = explode('</a></div></div><div class="menu">',$pt[1]);
$pt = trim($pt[0]);
$pt = strip_tags($pt);
$pt =  str_replace('&raquo;', '' ,$pt);
$pt =  str_replace('&nbsp;', ' ' ,$pt);
$pt = trim($pt);
$pt = explode(' ',$pt);
$pt = array_pop($pt);
$title = explode('<h3>',$title);
$title = explode('</h3>',$title[1]);
$title = trim($title[0]);
curl_close($curl);
$trang = $_GET['trang'];
$trang = explode('.',$trang);
$bd = $trang['0'];
$kt = $trang['1'];
if (!$pt && $kt)
{
$pt = $kt;
}
elseif (!$pt && !$kt){
$pt = 1;
}
if ($bd > $pt || $kt > $pt || $bd > $kt )  {
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>Truyện '.$title.' có '.$pt.' thôi mà !!';
}
else {
if (($kt && !$bd) || ($bd <= 1 && $kt > 0 )) {
$bd = 1;
$thong = 'Leech từ đầu đến trang '.$kt;
}
elseif (!$bd && !$kt ) {
$kt = $pt;
$bd = 1;
$thong = 'Đã leech tất cả '.$pt.' trang' ;
}
elseif (!$kt && $bd) {
$kt = $pt;
$thong = "Đã leech từ trang " .$bd." đến hết";
}
else {
$thong = 'Đã leech từ trang '.$bd.' đến trang '.$kt; 
}
if ($kt == 1){$cuoi = '<div class="menu">';}
else {$cuoi = '<div class="top">';}
}
echo '<b><u>'.$thong.'</u></b>
<form method="post">
* Tiêu đề:<br/><input type="text" name="title" id="title" value="'.$title.'" required=""/><br/>
URL:<br/> <input type="text" name="url" id="url" value=""/><br />
* Nội dung:<br/><textarea name="content">';
$bv = curl_init();
curl_setopt($bv, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.1.2; vi; SAMSUNG Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 UCBrowser/9.7.5.418 U3/0.8.0 Mobile Safari/533.1');
for ($i= $bd; $i <= $kt ; $i++) { 
curl_setopt ($bv, CURLOPT_URL, $url.'?page='.$i);
curl_setopt ($bv, CURLOPT_RETURNTRANSFER, 1);
$bai = curl_exec($bv);
$bai = explode('</font></div><div class="menu">',$bai);
$bai = explode($cuoi,$bai[1]);
$bai = trim($bai[0]);
$bai = strip_tags($bai,'<br>,<img>');
$bai =  str_replace('[Tải ảnh]','',$bai);
curl_exec ($bv);
echo $bai;
}
curl_close($bv);
echo '</textarea><br/>
Từ khóa:(Cách nhau dấu ",")<br/>
<input type="text" name="tags" value="'.$title.'"/><br/>
Ảnh đại diện: <br/><input type="text" name="img_thumb" value=""/><br/>
Title trên google:<br/><input type="text" name="title_seo" value=""/><br/>
Link tải:(Dùng HTML)<br/>
<textarea name="link_down" id="editor"></textarea><br/>
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