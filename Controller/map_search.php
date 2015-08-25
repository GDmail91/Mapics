<?
	include '../Class/mapLoad.php';
	include '../Class/Auth.php';
	include '../Class/Hash_tag.php';

	$mapLoad = new mapLoad;
	$userLoad = new Auth;
	$hash_tag = new Hash_tag;
	$mapArray = array();

	// POST 로 온 map_id 에 해당하는 태그 출력
	$result_map_id = $hash_tag->get_map($_POST['tag_name']);

	// 각 맵ID 별로 가져옴
	foreach ($result_map_id as $map_id) {
		$map_info = $mapLoad->get_map_info($map_id);	// 맵정보
		$user_info = $userLoad->user_info($map_info['user_id']);	// 유저정보
		$tag = $hash_tag->get_tag_id_by_map($map_id);	// 태그 정보
		foreach ($tag as $tag_id) {
			$tag_name .= $hash_tag->get_tag_name($tag_id)." ";	// 태그 네임 저장
		}
		array_push($mapArray, array(
			'user_id'=>$map_info['user_id'],
			'nickname'=>$user_info['nickname'],
			'user_photo'=>$user_info['user_photo'],
			'map_id'=>$map_id, 
			'map_name'=>$map_info['map_name'],
			'map_capture'=>$map_info['map_capture'],
			'description'=>$map_info['description'],
			'liker'=>$map_info['liker'],
			'tag_name'=>$tag_name
			));
	}
	//var_dump($mapArray);
	
	echo urldecode( json_encode ( $mapArray ));

?>