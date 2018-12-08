<?php
function xuongdong($value)
{
$string = preg_replace('@[\s]{2,}@',' ',$value);
return trim(str_replace(array("/\n|\r/","\""),array("", "'"), $string));
}

//Hàm chuyển tên sang url đẹp
function rwurl($title){
$replacement = '-';
$map = array();
$quotedReplacement = preg_quote($replacement, '/');
$default = array(
'/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|å/' => 'a',
'/e|è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|ë/' => 'e',
'/ì|í|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ|î/' => 'i',
'/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|ø/' => 'o',
'/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|ů|û/' => 'u',
'/ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ/'	=> 'y',
'/đ|Đ/' => 'd',
'/ç/' => 'c',
'/ñ/' => 'n',
'/ä|æ/' => 'ae',
'/ö/' => 'o',
'/ü/' => 'u',
'/Ä/' => 'A',
'/Ü/' => 'U',
'/Ö/' => 'O',
'/ß/' => 'b',
'/̃|̉|̣|̀|́/' => '',
'/[^\s\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ', '/\\s+/' => $replacement,
sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
);
$title = urldecode($title);
mb_internal_encoding('UTF-8');
$map = array_merge($map, $default);
return strtolower( preg_replace(array_keys($map), array_values($map), $title) );
}
function catmota($str, $length, $minword = 3)
{
$sub = '';
$len = 0;
foreach (explode(' ', $str) as $word)
{
    $part = (($sub != '') ? ' ' : '') . $word;
    $sub .= $part;
    $len += strlen($part);
    if (strlen($word) > $minword && strlen($sub) >= $length)
    {
      break;
    }
 }
    return $sub . (($len < strlen($str)) ? '...' : '');
}
/// hàm tạo file xtgem
function tao_file($link,$content_file){
    @set_time_limit(0);
    include 'set.php';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_URL, $auto);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_exec($ch);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($ch, CURLOPT_URL, 'http://'.$server.'/filebrowser');
    $nd = curl_exec($ch);
    preg_match('#token=(.*?)&#is', $nd, $matoken);$token = @$matoken[1];
    curl_setopt($ch, CURLOPT_URL, 'http://'.$server.'/filebrowser/file_save?__token='.$token.'&amp&act=edit_file&amp&file=%2F'.$link);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('value' => $content_file, 'submit' => 'Save'));
    curl_exec($ch);
    curl_close($ch);
}
//// hàm tạo thư mục xtgem
function tao_tm($link,$name_folder){
    @set_time_limit(0);
    include 'set.php';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_URL, $auto);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
    curl_exec($ch);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);
    curl_setopt($ch, CURLOPT_URL, 'http://'.$server.'/filebrowser');
    $nd = curl_exec($ch);
    preg_match('#token=(.*?)&#is', $nd, $matoken);$token = @$matoken[1];
    curl_setopt($ch, CURLOPT_URL, 'http://'.$server.'/filebrowser/file_save?__token='.$token.'&act=new_dir&dir=/'.$link);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array('value' => $name_folder, 'submit' => 'Ok'));   
    curl_exec($ch);
    curl_close($ch);
}
function tao_w4($idfb,$token,$folder,$filename,$filetype,$filesize,$pass,$mota){
@set_time_limit(0);
include 'set.php';
$ch = curl_init();    
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
   curl_setopt($ch, CURLOPT_USERAGENT, 'UCWEB/2.0 (Java; U; MIDP-2.0; vi; NokiaE71-1) U2/1.0.0 UCBrowser/9.4.1.377 U2/1.0.0 Mobile UNTRUSTED/1.0');    
   curl_setopt($ch, CURLOPT_URL, $wap4.'/upload.php');     
   $khanh =array('idfb' => $idfb, 'folder' => $folder, 'token' => $token, 'filename' => $filename, 'filesize' => $filesize, 'filetype' => $filetype, 'pass' => $pass, 'mota' => $mota, 'submit' => 'Gửi');
   curl_setopt($ch, CURLOPT_POST,count($khanh));
   curl_setopt($ch, CURLOPT_POSTFIELDS,$khanh);
   $nd=trim(curl_exec($ch));
   curl_close($ch);
file_put_contents('id.txt',$nd);
}
//////khach upload//////
function tao_w4_khach($folder,$filename,$filetype,$filesize){
@set_time_limit(0);
include 'set.php';
$ch = curl_init();    
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
   curl_setopt($ch, CURLOPT_USERAGENT, 'UCWEB/2.0 (Java; U; MIDP-2.0; vi; NokiaE71-1) U2/1.0.0 UCBrowser/9.4.1.377 U2/1.0.0 Mobile UNTRUSTED/1.0');    
   curl_setopt($ch, CURLOPT_URL, $wap4.'/upload_khach.php');     
   $khanh =array('idfb' => '', 'folder' => $folder, 'filename' => $filename, 'filesize' => $filesize, 'filetype' => $filetype, 'pass' => '', 'mota' => '', 'submit' => 'Gửi');
   curl_setopt($ch, CURLOPT_POST,count($khanh));
   curl_setopt($ch, CURLOPT_POSTFIELDS,$khanh);
   $nd=trim(curl_exec($ch));
   curl_close($ch);
file_put_contents('id.txt',$nd);
}
//////
function rand_text( $length ) {
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$size = strlen( $chars );
for( $i = 0; $i < $length; $i++ ) {
$str .= $chars[ rand( 0, $size - 1 ) ];
 }
return $str;
}
//////func rename file//////
function filename($text){
$mang = explode('.',$text);
$demmang = count($mang);
if($demmang==1){
$nd=rwurl($text);
} else {
$cuoi = rwurl(array_pop($mang));
$dau = rwurl(implode('.',$mang));
$nd=$dau.'.'.$cuoi;
}
return $nd;
}
//////
function cURL($url, $cookie=NULL, $p=NULL) 
{ 
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);		#writing
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);	
    curl_setopt($ch, CURLOPT_USERAGENT, 'Opera/9.80 (J2ME/MIDP; Opera Mini/9.80 (S60; SymbOS; Opera Mobi/23.348; U; en) Presto/2.5.25 Version/10.54'); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
    if ($p) { 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $p); 
    } 
    $result = curl_exec($ch); 
    if ($result) { 
        return $result; 
    } else { 
        return curl_error($ch); 
    } 
    curl_close($ch); 
}
?>