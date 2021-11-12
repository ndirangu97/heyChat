<?php


$query=false;
$data=false;
$data['username']=$DATA_OBJECT->username;
$data['id']=$_SESSION['userid'];

$query="UPDATE users SET username=:username WHERE userid=:id";
$write=$DB->write($query,$data);
 
if($write){
    
$info->dataType = "changeStatus";
echo json_encode($info);
}



?>