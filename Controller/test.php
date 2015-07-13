<?
// CONTROLLER, MODEL 불러오기
include '../Class/mapLoad.php';

// 지도 불러오기
$map = new MapLoad;
$result = $map->getMap('5');

echo $result;
?>