<?
	include '../Class/Img_ctl.php';

	$img_ctl = new Img_ctl;


	if ($img_ctl->get_img_like($_POST['img_id']) != 0) {
		$liker = $img_ctl->img_dislike($_POST['img_id']);

		if (!empty($liker)) {
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