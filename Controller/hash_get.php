<?
include '../Class/Hash_tag.php';

// POST 로 온 map_id 에 해당하는 태그 출력
$hash_tag = new Hash_tag;
$result_map_id = $hash_tag->get_map($_POST['tag_name']);

echo $json = urldecode( json_encode ( $result_map_id )) ;
echo "<br>";
var_dump( json_decode($json) );
?>