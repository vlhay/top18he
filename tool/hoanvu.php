<?php
if (!isset($_GET['url']))
{
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/><form method="get">Url: <input name="url" type="text"><input type="submit" value="Leech" ></form>';
}
else
{

$url = $_GET['url'];
$url =  str_replace('http://m.','',$url);
$url =  str_replace('http://','',$url);
$url =  str_replace($url,'http://'.$url ,$url);
$curl = curl_init();
curl_setopt ($curl, CURLOPT_URL, $url);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
$title = curl_exec($curl);
$title = explode('<title>',$title);
$title = explode('</title>',$title[1]);
$title = trim($title[0]);
$title = explode('- Gai xinh -',$title);
$title = trim($title[0]);




$lay = curl_exec($curl);


$lay = explode("<div itemprop='articleBody'>",$lay);
$lay = explode("<i class='fa fa-tag fa-lg'></i>",$lay[1]);


$lay = trim($lay[0]);
$lay = strip_tags($lay,'<img>');
$thum = preg_replace('#<img(.*?)src="(.*?)"(.*?)>#is',"<option>$2</option>",$lay);
$lay =  str_replace('GaiXinhXinh.Com','CuocSong.ViWap.Com' ,$lay);
$lay =  str_replace('<p>','[p]' ,$lay);
$lay =  str_replace('</p>','[/p]' ,$lay);
$lay = trim($lay);
$lay =  str_replace('Tải ảnh','' ,$lay);
$lay = trim($lay);
curl_close($curl);


echo '
<h3>Viết bài</h3>
<div class="box">
  
        <form action="http://cuocsong.viwap.com/admin/" method="post">
    Tiêu đề:<br />  	
    <input name="title" value="'.$title.'"><br />
    Thể loại:<br />  
    <select name="category">  
		      		<optgroup label="Giải trí">	
				              		<option value="5">Ảnh Girl Xinh</option>
              				</optgroup>
		    </select>  
    <br />
    Thumbnail<br />  
     <select name="thumbnail">  
		   <optgroup>	
	'.$thum.'
              		 </optgroup>			
		    </select>  
    <br />
    Nội dung:<br />  
    <textarea name="content" id="content" rows="25">'.$lay.'</textarea>
    <br />
    <input type="checkbox" name="allowComment" value="1" checked> Cho phép bình luận
      <div class="frm-buttons"><button>Đăng bài</button></div>
    </form>  
</div> '; 



}

?>