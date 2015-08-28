<?
	include '../Class/Img_ctl.php';

	$img_ctl = new Img_ctl;


	if ($img_ctl->get_map_like($_POST['map_id']) < 0 
		|| $img_ctl->get_map_like($_POST['map_id']) != 0) {
		$liker = $img_ctl->map_dislike($_POST['map_id']);

		if (is_int($liker)) {
			$result = array(
				'result'=>'true',
				'liker'=>$liker
				);
		} else {
			$result = array( 'result'=>'false' );	
		}

	} else {
		$liker = 0;
		$result = array(
			'result'=>'true',
			'liker'=>$liker
			);
	}

	echo urldecode( json_encode ( $result )) ;

?>