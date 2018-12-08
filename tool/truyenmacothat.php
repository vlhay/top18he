<title>Leech Truyenmacothat.net</title>
<?php
session_start();
require 'head.php';
if (!isset($_SESSION['domain']))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>Bạn chưa đăng nhập! <a href="/">Đăng nhập</a>';
}
elseif (!isset($_GET['url']))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><form method="get">Url: <input name="url" type="text"><br />Bỏ trống để leech hết truyện. Nhập trang đầu và kết thúc cách nhau dấu chấm vd:"0.3"<br /> <input name="pt" type="text"><input type="submit" value="Leech" ></form>';
}
elseif ($_POST['submit']){
$post = post_dl($_POST['title'],$_POST['url'],$_POST['content'], $_POST['tags'],$_POST['img_thumb'],$_POST['title_seo'],$_POST['link_down'],$_POST['desc'],$_POST['temp_index'],$_POST['box'],$_POST['phan_trang'],$_POST['submit']);
echo $post;
echo '<u>Tiếp tục</u>:<br /><form method="get">Url: <input name="url" type="text"><br />Bỏ trống để leech hết truyện. Nhập trang đầu và kết thúc cách nhau dấu chấm vd:"0.3"<br /> <input name="pt" type="text"><input type="submit" value="Leech" ></form>';
}
else
{
$url = $_GET['url'];
$url =  str_replace('http://m.','',$url);
$url =  str_replace('http://','',$url);
$url =  str_replace($url,'http://m.'.$url ,$url);
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.1.2; vi; SAMSUNG Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 UCBrowser/9.7.5.418 U3/0.8.0 Mobile Safari/533.1');
$lay = curl_exec($curl);
$title = curl_exec($curl);
$tag = explode('<b>Tags:</b>',$title);
$tag = explode('</div>',$tag[1]);
$tag = strip_tags($tag[0]);
$tag = trim($tag);
$lay = explode('class="page-links">',$title);
$lay = explode('</div>',$lay[1]);
$lay = trim($lay[0]);
$lay = strip_tags($lay);
$lay = explode(' ',$lay);
$lay = array_pop($lay);
if (!$lay){$lay = 1;}
$title = explode('<title>',$title);
$title = explode('</title>',$title[1]);
$title = explode('|',$title[0]);
$title = trim($title[0]);
curl_close($curl);
$pt = $_GET['pt'];
$pt = explode('.',$pt);
$bd = $pt[0];
$kt = $pt[1];
if ($bd > $lay || $kt > $lay || $bd > $kt )  {
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>Truyện '.$title.' có '.$lay.' thôi mà !!';
}
else{
if (($kt && !$bd) || ($bd <= 1 && $kt > 0 )) {
$bd = 1;
$thong = 'Leech từ đầu đến trang '.$kt;
}
elseif (!$bd && !$kt ) {
$kt = $lay;
$bd = 1;
$thong = 'Đã leech tất cả '.$lay.' trang' ;
}
elseif (!$kt && $bd) {
$kt = $lay;
$thong = "Đã leech từ trang " .$bd." đến hết";
}
else {
$thong = 'Đã leech từ trang '.$bd.' đến trang '.$kt; 
}
echo '<b><u>'.$thong.'</u></b>
<form method="post">
* Tiêu đề:<br/><input type="text" name="title" id="title" value="'.$title.'" required=""/><br/>
URL:<br/> <input type="text" name="url" id="url" value=""/><br />
* Nội dung:<br/><textarea name="content">';
$bv = curl_init();
for ($i = $bd; $i <= $kt ; $i++) { 
curl_setopt ($bv, CURLOPT_URL, $url.'/'.$i);
curl_setopt ($bv, CURLOPT_RETURNTRANSFER, 1);
$bai = curl_exec($bv);
$bai = explode('class="entry-content" style="margin: 10px 0;">',$bai);
$bai = explode('class="dmca-badge none">',$bai[1]);
$bai = trim($bai[0]);
$bai = strip_tags($bai,'<p>,<br>,<b>,<i>,<u>,<strong>');
$bai = preg_replace('#truyenmacothat.net#i',$_SESSION['domain'],$bai);
echo $bai;
}
curl_close($bv);
echo '</textarea><br/>
Từ khóa:(Cách nhau dấu ",")<br/>
<input type="text" name="tags" value="'.$tag.'"/><br/>
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
}
?>