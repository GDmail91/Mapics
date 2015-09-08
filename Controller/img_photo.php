<?
	include '../Class/mapLoad.php';
	include '../Class/Img_ctl.php';

	$mapLoad = new mapLoad;
	$Img_ctl = new Img_ctl;

	$img = $mapLoad->get_image($_POST['img_id']); // POST값으로 바꿀것
	$comments = array('comments' => $Img_ctl->getComments($_POST['img_id'], 0)); // POST값으로 바꿀것

	echo urldecode( json_encode ( $img + $comments ));
?>