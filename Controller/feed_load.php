<?
	include '../Class/mapLoad.php';
	include '../Class/Auth.php';

	$mapLoad = new mapLoad;
	$auth = new Auth;

	if ($_POST['num'])
		$maps = $mapLoad->getMapAllCapture($_POST['num']);
	else	
		$maps = $mapLoad->getMapAllCapture();

	$map_list[] = null ;
	foreach ($maps as $map) {
		$user_info =  $auth->user_info($map['user_id']);
		array_push($map_list, $map+array('nickname'=>$user_info['nickname']));
	}

	for ($i=0; $i < count($maps); $i++) { 
		$mapArray['mapInfo'.$i] = $map_list[$i+1];
	}
	echo(urldecode( json_encode ( $mapArray ))) ;

?>