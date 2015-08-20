<?
	include '../Class/mapLoad.php';

	$mapReg = new mapLoad;

	$reg_result = $mapReg->upload_map(array(
		'user_id'=>$_POST['user_id'], 
		'map_name'=>$_POST['map_name'], 
		'map_locate'=>$_POST['map_locate'],
		'map_type'=>$_POST['map_type']
		)
	);

	
	echo $reg_result;

?>