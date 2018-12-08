<title>Leech truy&#7879;n Conan</title>
<?php
session_start();
require 'head.php';
if (!isset($_SESSION['domain']))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>Bạn chưa đăng nhập | <a href="">Đăng nhập</a>';
}
elseif (!isset($_GET['url']))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<form method="get">Chap: <input name="url" type="text"><br />
<input type="submit" value="Leech" ></form>';
}
elseif ($_POST['submit']){
$post = post_dl($_POST['title'],$_POST['url'],$_POST['content'], $_POST['tags'],$_POST['img_thumb'],$_POST['title_seo'],$_POST['link_down'],$_POST['desc'],$_POST['temp_index'],$_POST['box'],$_POST['phan_trang'],$_POST['submit']);
echo $post;
echo '<u>Tiếp tục</u>:<br /><form method="get">Url: <input name="url" type="text"><br /><input type="submit" value="Leech" ></form>';
}
else
{
$url = $_GET['url'];
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, 'http://xomtruyen.com/detective-conan-chap-'.$url.'-tiengviet');
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$lay = curl_exec($curl);
$lay = explode("<script type='text/javascript' src='http://ads.qadserve.com/t?id=1467bf4e-b965-46f7-98f8-6bfc6553bfae&size=728x90'></script>",$lay);
$lay = explode('<!--div id="adVatgia_block_1"></div>',$lay[1]);
$lay = trim($lay[0]);
$lay = strip_tags($lay,'<img>,<br>');
$lay =  str_replace('-->','',$lay);
$lay =  str_replace('<br />','',$lay);
$lay =  str_replace('<br>','<br />',$lay);
$lay =  str_replace('src=','src="',$lay);
$lay =  str_replace('imgmax=2000','imgmax=2000" alt="7 vien ngoc rong tap '.$url.'"',$lay);
$lay =  str_replace("'",'"',$lay);
$lay = trim($lay);
curl_close($curl);
echo '<form method="post">
* Tiêu đề:<br/><input type="text" name="title" value="[Truyện tranh] Thám tử Conan chap '.$url.'" required=""/><br/>
URL:<br/> <input type="text" name="url" id="url" value=""/><br />
* Nội dung:<br/><textarea name="content">'.$lay.'</textarea><br/>
Từ khóa:(Cách nhau dấu ",")<br/>
<input type="text" name="tags" value="truyen tranh hay, doc truyen tranh conan, truyen conan tap '.$url.', truyen conan chap '.$url.'"/><br/>
Ảnh đại diện: <br/><input type="text" name="img_thumb" value=""/><br/>
Title trên google:<br/><input type="text" name="title_seo" value=""/><br/>
Link tải:(Dùng HTML)<br/>
<textarea name="link_down" id="editor"></textarea><br/>
Mô tả:<br/><input type="text" name="desc" value="truyen tranh hay, doc truyen tranh conan, truyen conan tap '.$url.', truyen conan chap '.$url.'"/><br/>
Mục hiển thị:<br />
'.$_SESSION['cm'].'
<label for="phan_trang">
<input type="checkbox" name="phan_trang" value="1"/> Phân trang
</label><br/>
<input type="submit" name="submit" value="Đăng bài"/>
</form>';
}
?>