<?php

 

$query=false;
$data=false;
$data['status']=$DATA_OBJECT->status;
$data['id']=$_SESSION['userid'];

$query="UPDATE users SET status=:status WHERE userid=:id";
$write=$DB->write($query,$data);
 
if($write){
$info->dataType = "changeStatus";
echo json_encode($info);
}










?>