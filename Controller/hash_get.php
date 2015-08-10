<?
include '../Class/Hash_tag.php';

// POST 로 온 map_id 에 해당하는 태그 출력
$hash_tag = new Hash_tag;
echo $hash_tag->get_tag($_POST['map_id']);
?>