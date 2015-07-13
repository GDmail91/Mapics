<?
    $file_path = "/var/www/html/Mapics/appimg/";
    $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
    
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
        echo "file upload success";
    } else{
        echo "file upload fail";
    }
?>
<!-- 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
</head>   
<body>
<?php
ini_set("display_errors", "1");
$uploaddir = 'C:\Bitnami\wampstack-5.4.39-0\apache2\htdocs\Mapics\appimg\\';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
echo $uploadfile.'<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "파일이 유효하고, 성공적으로 업로드 되었습니다.\n";
} else {
    print "파일 업로드 공격의 가능성이 있습니다!\n";
}
echo '자세한 디버깅 정보입니다:';
print_r($_FILES);
print "</pre>";
?>
</body>
</html>
 -->