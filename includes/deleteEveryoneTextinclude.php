<?php


$query=false;
$data=false;

$data['id']=$DATA_OBJECT->messId;


$query='delete from messages where id=:id';
$write=$DB->write($query,$data);

if ($write) {

$info->dataType = "deleteMessage";
echo json_encode($info);
}






?>