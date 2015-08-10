<?
include '../Class/Hash_tag.php';

// POST 로 온 map_id 에 해당하는 태그들 DB에 넣음
// 해시태그 갯수만큼 불러와야함 (추후에 배열로 받는걸로 바꿔야함)
$hash_tag = new Hash_tag;
$hash_tag->set_tag($_POST['tag_name'], $_POST['map_id']);
?>