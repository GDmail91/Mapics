<?
	include '../Class/Img_ctl.php';

	$img_ctl = new Img_ctl;


	$liker = $img_ctl->map_like($_POST['map_id']);

	if ( is_int($liker)) {
		$result = array(
			'result'=>'true',
			'liker'=>$liker
			);
	} else {
		$result = array( 'result'=>'false' );
	}
	
	echo urldecode( json_encode ( $result )) ;

?>