<?php
session_start();
require 'head.php';
echo '<title>Tool leech wapseo By Hehe9x</title>';
if (!isset($_POST['domain']) && (!isset($_SESSION["domain"]) && !isset($COOKIE["domain"])))
{
	echo '<b>Đăng nhập</b><br />
	<form method="post">
	<b>Domain</b>: <input name="domain" type="text">
	<select name="sub">
	<option value="">Park Domain</option>
	<option value=".wapseo.mobi">.WapSEO.Mobi</option>
	<option value=".ovn.mobi">.Ovn.Mobi</option>
	<option value=".ngot.in">.Ngot.In</option>
	<option value=".botay.in">.Botay.In</option>
	</select><br />
	<b>Mật khẩu:</b>
	<input type="password" name="pass"><br />
	<input type="checkbox" name="nho">Nhớ cho lần sau<br />
	<input type="submit" value="Đăng nhập" ></form><p>Server phụ:<a href="http://h.leech.tk">http://h.leech.tk</a> (host cũ) </p>';
}
elseif (isset($_POST['domain']) &&(!isset($_SESSION["domain"]) || !isset($_COOKIE["domain"])))
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://wapseo.mobi/dangnhap.html');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'user='.$_POST['domain'].$_POST['sub'].'&pass='.$_POST['pass'].'&submit=Đăng Nhập');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_COOKIEJAR, 'hehe/'.$_POST['domain'].$_POST['sub'].'.txt');
	curl_exec($ch);
	curl_setopt($ch, CURLOPT_URL, 'http://wapseo.mobi/panel/index.php?mod=new_topic');
	$cm = curl_exec($ch);
	$cm = explode('<span class="red">*</span> Mục hiển thị tại trang chủ:<br/>',$cm);
	$cm = explode('<label for="upload">',$cm[1]);
	$cm = trim($cm[0]);
	curl_exec($ch);
	curl_close($ch);
	if (!$cm)
	{
		echo 'Không thể đăng nhập <a href="">Thử lại</a>';
		unlink('hehe/'.$_POST['domain'].$_POST['sub'].'.txt');
	}
	else 
	{
		$_SESSION["domain"] = $_POST['domain'].$_POST['sub'];
		$_SESSION["cm"] = $cm;
		if(isset($_POST['nho']))
		{
		setcookie("domain",$_SESSION["domain"],time() + 3600000);
		setcookie("cm",$_SESSION["cm"],time() + 3600000);
		}
		echo '<meta http-equiv="refresh" content="1;url=index.php">Đăng nhập thành công.... <br /><a href="/">Ấn vào đây nếu trình duyệt không tự chuyển</a>';
	}
}
elseif (isset($_GET['xoa']))
{
	setcookie("domain",$_SESSION["domain"],time() - 3600000);
	setcookie("cm",$_SESSION["cm"],time() - 3600000);
	unlink('hehe/'.$_SESSION["domain"].'.txt');
	session_destroy();
	echo '<meta http-equiv="refresh" content="1;url=/index.php"><div class="hehe">Đã thoát</div>';
	
}
elseif(isset($_SESSION['domain']))
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