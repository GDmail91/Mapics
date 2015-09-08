<?
include '../Class/img_ctl.php';

$img_ctl = new img_ctl;
$img_ctl->anti_sqlinjection();
$result =$img_ctl->addComment(0, $_POST['dest_id'], $_POST['user_id'], $_POST['nickname'], $_POST['comment']);

echo urldecode( json_encode ( $result ));
?>