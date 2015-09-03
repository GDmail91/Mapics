<?
	include '../Class/mapLoad.php';
	include '../Class/Hash_tag.php';

	$mapReg = new mapLoad;

	$reg_result = $mapReg->upload_img(array(
		'map_id'=>$_POST['map_id'], 
		'loc_x'=>$_POST['loc_x'], 
		'loc_y'=>$_POST['loc_y'],
		'description'=>$_POST['description']
		)
	);
/*
// 사진에는 해쉬태그 불필요?
	// tag_name과 맵을 넣은 결과값이 true일 경우만
	if (!empty($_POST['tag_name']) && $reg_result['db_result']) {
		// POST 로 온 map_id 에 해당하는 태그들 DB에 넣음
		// 해시태그 갯수만큼 불러와야함 (추후에 배열로 받는걸로 바꿔야함)
		$hash_tag = new Hash_tag;
		$tag = explode(" ", trim($_POST['tag_name']));
		foreach ($tag as $tag_name) {
			$hash_result = $hash_tag->set_tag($tag_name, $reg_result['map_id']);	
			if (!$hash_result) 
				break;
		}
	} else {
		$hash_result = false;
	}
*/
	if ($reg_result['db_result']) {
		$result = array('result'=>'true', 'img_id'=>(string)$reg_result['img_id']);
	} else {
		$result = array('result'=>'false');
	}

	echo urldecode( json_encode ( $result )) ;

?>