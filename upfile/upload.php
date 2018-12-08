<?php
set_time_limit(1000);
include 'set.php';
include 'function.php';
 // Xử Lý Upload
  
    // Nếu người dùng click Upload
    if (isset($_POST['uploadclick']))
    {
        // Nếu người dùng có chọn file để upload
        if (isset($_FILES['file']))
        {
$idfb = $_POST['idface'];
$token = trim($_POST['token']);
$error = $_FILES['file']['error'];
$size = $_FILES['file']['size'];
$name = $_FILES['file']['name'];
$type = $_FILES['file']['type'];
$checktoken = trim(file_get_contents($wap4.'/check.php?id='.$idfb));
            // Nếu file upload không bị lỗi,
            // Tức là thuộc tính error > 0
            if ($error > 0)
            {
header("Location: ".$wap4."/error?type=errorfile");  
                echo 'File Upload Bị Lỗi';
            }
            elseif ($checktoken != $token)
            {
header("Location: ".$wap4."/error?type=token");  
                echo 'Token sai';
            }
            elseif ($size > 15728639)
            {
header("Location: ".$wap4."/error?type=maxsize");  
                echo 'File quA dung luong';
            }
            else {
                // Upload file
                move_uploaded_file($_FILES['file']['tmp_name'], './folder/'.$name);
$fp = @fopen('folder/'.$name, "r");
  
// Kiểm tra file mở thành công không
if (!$fp) {
header("Location: ".$wap4."/error?type=notopen");  
    echo 'Mở file không thành công';
}
else
{
    // Đọc file và trả về nội dung
    $namefolder = rand_text(30);
    $data = fread($fp, filesize('folder/'.$name));
    $filename = trim(filename($name));
////upload/////
tao_tm('/upload',$namefolder);
tao_file('/upload/'.$namefolder.'/'.$filename,$data);
tao_w4($idfb,$token,$namefolder,$filename,$type,$size,$pass,$mota);
unlink('folder/'.$name);
    $id = file_get_contents('id.txt');
header("Location: ".$wap4."/files/".$id);  
    echo $id;
    echo 'Upload thanh cong';
///////upload//////
}
            }
        }
        else{
header("Location: ".$wap4."/error?type=nofile");  
            echo 'Bạn chưa chọn file upload';
        }
    }
?>