<?php
session_start();
require 'head.php';
echo '<title>Tool leech wapseo By Hehe9x</title>';
if (!isset($_POST['user']) && (!isset($_SESSION["user"]) && !isset($COOKIE["user"])))
{
	echo '<b>Đăng nhập</b><br />
	<div class="menu">Đăng nhập</div><div class="list"><div class="list-group-item">
<form method="post">
Tên đăng nhập<br>
<input name="user" value="" /></div></div>
Mật khẩu<br><div><input name="pass" maxlength="32" /></div><button type="submit">Đăng nhập</button></div></div>
</div>  ';
}
elseif (isset($_POST['user']) &&(!isset($_SESSION["user"]) || !isset($_COOKIE["user"])))
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://top18.viwap.com/manager');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'user='.$_POST['user'].'&pass='.$_POST['pass'].'&submit=Đăng Nhập');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_COOKIEJAR, 'hehe/'.$_POST['user'].'.txt');
	curl_exec($ch);
	curl_setopt($ch, CURLOPT_URL, 'http://top18.viwap.com/manager/post');
	$cm = curl_exec($ch);
	$cm = explode('Thể loại:',$cm);
	$cm = explode('<div class="list-group-item">Ảnh đại diện:',$cm[1]);
	$cm = trim($cm[0]);
	curl_exec($ch);
	curl_close($ch);
	if (!$cm)
	{
		echo 'Không thể đăng nhập <a href="">Thử lại</a>';
		unlink('hehe/'.$_POST['user'].'.txt');
	}
	else 
	{
		$_SESSION["user"] = $_POST['user'];
		$_SESSION["cm"] = $cm;
		if(isset($_POST['nho']))
		{
		setcookie("domain",$_SESSION["user"],time() + 3600000);
		setcookie("cm",$_SESSION["cm"],time() + 3600000);
		}
		echo '<meta http-equiv="refresh" content="1;url=index.php">Đăng nhập thành công.... <br /><a href="/">Ấn vào đây nếu trình duyệt không tự chuyển</a>';
	}
}
elseif (isset($_GET['xoa']))
{
	setcookie("user",$_SESSION["user"],time() - 3600000);
	setcookie("cm",$_SESSION["cm"],time() - 3600000);
	unlink('hehe/'.$_SESSION["user"].'.txt');
	session_destroy();
	echo '<meta http-equiv="refresh" content="1;url=/index.php"><div class="hehe">Đã thoát</div>';
	
}
elseif(isset($_SESSION['user']))
{
	echo '<a href="360.php">leech truyện ngắn doctruyen360.com</a><br />
	<a href="xemanh.php">Leech ảnh xemanhdep.com</a><br />
	<a href="trasua.php">Leech Trasua.mobi</a><br />
	<a href="ohdep.php">Leech Ohdep.net</a><br />
	<a href="xemsexmobi.php">Leech ảnh Xemsex.mobi</a><br />
	<a href="kutublog.php">Truyện xxx Kutublog.com</a><br />
	<a href="truyen3s.php">Leech Truyen3s.com & Topkute.net</a><br />
	<a href="truyenwc.php">Leech truyen.wapchoi.mobi</a><br />
	<a href="mbox.php">Leech game mbox.sh</a> (vd: hehe9x.mbox.sh)<br />
	<a href="hayday.php">Leech game online hayday.mobi</a> (vd:hehe9x.hayday.mobi)<br />
	<a href="ptb.php">Leech phuthobay.pro</a><br />
	<a href="haycuc.php">Leech Tai3x.com</a><br />
	<a href="blogtamsu.php">Leech Blogtamsu.vn</a><br />
	<a href="cucdinh.php">Leeh cucdinh.mobi</a> (vd: hehe9x.cucdinh.mobi)<br />
	<a href="ngocrong.php">7VNR</a><br />
	<a href="naruto.php">Naruto</a><br />
	<a href="conan.php">Conan</a><br />
	<a href="dptk.php">DPTK</a><br />
	<a href="conan1.php">Conan (TT8 remake) blogtruyen.com</a></br />
	<a href="wtt.php">Leech Wapthuthuat.net</a><br />
	<a href="css.php">Edit CSS Cho Mobile</a><br />
	<a href="apphd.php">Leech User.apphd.com</a><br />
	<a href="apkvn.php">Leech User.apk.vn</a> (đã fix)<br />
	<a href="gocvnorg.php">Leech nội dung tại gocvn.org</a><br />
	<a href="truyenvip.php">Leech tại truyenvip.pro</a><br />
	<a href="gamevina.php">Leech tại gamevina.us</a><br />
	<a href="wapvip.php">Leech wapvip.pro</a><br />
	<a href="tgt.php">Leech thegioitruyen.mobi</a><br />
	<a href="hoanvu.php">Leech Photo.hoanvu.net</a><br />
	<a href="lmht360.php">Leech lienminh360.vn</a><br />
	<a href="ltg.php">Leech gamemod.linktaigame.com</a><br />
	<a href="dt360.php">Leech truyện dài doctruyen360.com</a> (Thử nghiệm)<br />
	<a href="hay.php">Leech Hayso1.vn</a><br />
	<a href="doremonche.php">Leech tại doctruyendoremon.vn/</a><br />
	<a href="code.php">Xem mã nguồn web</a> (không cần đăng nhập cũng có thể xem)<br />
	<a href="post.php">Hỗ trợ đăng bài cho mobile<br />
	<a href="ngam.php">leech tại ngam.mobi</a><br />
	<a href="thuvientruyen.php">leech tại thuvientruyen.info</a><br />
	<a href="pinyeu.php">leech tại pinyeu.com</a><br />
	<a href="truyentranhgay.php">leech tại truyentranhgay.com</a><br />
    <a href="truyenmacothat.php">leech tại truyenmacothat.net</a><br />
    <a href="tophinh.php">leech tại tophinh.com</a><br />
    <a href="truyenvoz.php">leech tại truyenvoz.com</a><br />
    <a href="kenhtruyen.php">leech tại Kenhtruyen.biz</a><br />
    <a href="xemgame.php">leech tại xemgame.com</a><br />';
}	
?>
