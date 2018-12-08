<title>Leech doctruyen360.com</title>
<?php
session_start();
require 'head.php';
if (!isset($_SESSION["domain"]))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>Bạn chưa đăng nhập! <a href="index.php">Login</a>';
}
elseif ($_POST['submit']){
echo post_dl($_POST['title'],$_POST['url'],$_POST['content'].$_POST['content1'].$_POST['content2'].$_POST['content3'].$_POST['content4'].$_POST['content5'].$_POST['content6'].$_POST['content7'].$_POST['content8'].$_POST['content9'], $_POST['tags'],$_POST['img_thumb'],$_POST['title_seo'],$_POST['link_down'],$_POST['desc'],$_POST['temp_index'],$_POST['box'],$_POST['phan_trang'],$_POST['submit'],$_POST['down_index']);
echo '<form method="post">
* Tiêu đề:<br/><input type="text" name="title" id="title" value="" required=""/><br/>
URL:<br/> <input type="text" name="url" id="url" value=""/><br />
* Nội dung:<br/><textarea name="content"></textarea><br/>
<textarea name="content1"></textarea><br/>
<textarea name="content2"></textarea><br/>
<textarea name="content3"></textarea><br/>
<textarea name="content4"></textarea><br/>
<textarea name="content5"></textarea><br/>
<textarea name="content6"></textarea><br/>
<textarea name="content7"></textarea><br/>
<textarea name="content8"></textarea><br/>
<textarea name="content9"></textarea><br/>
Từ khóa:(Cách nhau dấu ",")<br/>
<input type="text" name="tags" value=""/><br/>
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
else
{
echo '<form method="post">
* Tiêu đề:<br/><input type="text" name="title" id="title" value="" required=""/><br/>
URL:<br/> <input type="text" name="url" id="url" value=""/><br />
* Nội dung:<br/><textarea name="content"></textarea><br/>
<textarea name="content1"></textarea><br/>
<textarea name="content2"></textarea><br/>
<textarea name="content3"></textarea><br/>
<textarea name="content4"></textarea><br/>
<textarea name="content5"></textarea><br/>
<textarea name="content6"></textarea><br/>
<textarea name="content7"></textarea><br/>
<textarea name="content8"></textarea><br/>
<textarea name="content9"></textarea><br/>
Từ khóa:(Cách nhau dấu ",")<br/>
<input type="text" name="tags" value=""/><br/>
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