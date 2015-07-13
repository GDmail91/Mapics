<?
// CONTROLLER, MODEL 불러오기
include '../Class/mapLoad.php';

// 서버에 사진 저장하기
$map = new MapLoad;
$result = $map->imgUpload(null, null, null, null);

echo $result;
?>