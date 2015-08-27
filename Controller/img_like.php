<?
	include '../Class/Img_ctl.php';

	$img_ctl = new Img_ctl;


	$liker = $img_ctl->img_like($_POST['img_id']);

	if ( !empty($liker)) {
		$result = array(
			'result'=>'true',
			'liker'=>$liker
			);
	} else {
		$result = array( 'result'=>'false' );
	}
	
	echo urldecode( json_encode ( $result )) ;

?>