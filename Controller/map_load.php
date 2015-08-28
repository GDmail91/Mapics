<?
	include '../Class/mapLoad.php';
	include '../Class/Auth.php';
	include '../Class/Hash_tag.php';

	$mapLoad = new mapLoad;
	$auth = new Auth;
	$hash_tag = new Hash_tag;

	$map = $mapLoad->get_map_info($_POST['map_id']);

	//var_dump($map);
	$user_info =  $auth->user_info($map['user_id']); // 맵의 사용자 정보 가져옴

	$tag = $hash_tag->get_tag_id_by_map($map['map_id']);	// 태그 정보
	foreach ($tag as $tag_id) {
		$tag_name .= "#".$hash_tag->get_tag_name($tag_id)." ";	// 태그 네임 저장
	}

	$map_info = $map+array(
		'nickname'=>$user_info['nickname'], // 사용자 정보에서 nickname 값 가져옴
		'tag_name'=>$tag_name); // tag 이름 가져옴

	echo urldecode( json_encode ( $map_info ));

?>