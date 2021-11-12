<?php

$query=false;
$data=false;
$data['email']=$DATA_OBJECT->email;
$data['id']=$_SESSION['userid'];

$query="UPDATE users SET email=:email WHERE userid=:id";
$write=$DB->write($query,$data);
 
if($write){
$info->dataType = "changeStatus";
echo json_encode($info);
}


?>