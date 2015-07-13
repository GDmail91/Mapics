<?php  
// db information  
$db_host = "localhost";  
$db_id = "mini";  
$db_password = "mini";  
$db_dbname = "mini";  

// connect db  
$db_conn = mysql_connect ( $db_host, $db_id, $db_password ) or 
    die ( "Fail to connect database!!" );  
mysql_select_db ( $db_dbname, $db_conn );  

$query = "select user_name, user_age, middle_exam, final_exam from json";  
$result = mysql_query ( $query );  

if (! $result) {  
    $message = 'Invalid query: ' . mysql_error () . "\n";  
    $message .= 'Whole query: ' . $query;  
    die ( $message );  
}  

// make json from database result set  
$resultArray = array ();  
while ( $row = mysql_fetch_assoc ( $result ) ) {  
    $arrayMiddle = array (  
        "name" => urlencode( $row ['user_name'] ),  //json에서 한글이 깨질수도 있어서 인코딩
        "age" => (int) $row ['user_age'] ,  
        "exam" => array()  
    );  

    array_push($arrayMiddle['exam'], (int)$row['middle_exam']);  
    array_push($arrayMiddle['exam'], (int)$row['final_exam']);  

    array_push ( $resultArray, $arrayMiddle );  
}  

// print result array   
print_r ( urldecode ( json_encode ( $resultArray ) ) );  // 디코딩

// close db  
mysql_close ( $db_conn );  
?>  