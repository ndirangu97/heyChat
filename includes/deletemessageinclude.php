<?php

$sql=false;
$log=false;

$log['messid']=$DATA_OBJECT->messId;
$sql='select * from messages where id=:messid ';

$results=$DB->read($sql,$log);

if (is_array($results) ){

    $row=$results[0];

      if ($row->sender==$_SESSION['userid']) {
            $query=false;
            $data=false;

            $data['true']=1;
            $data['messid']=$DATA_OBJECT->messId;


            $query='update messages set deletedsender=:true where id=:messid';
            $r=$DB->write($query,$data);
            if($r){
              
            }
      }elseif ($row->reciever==$_SESSION['userid']) {
            $query=false;
            $data=false;

            
            $data['true']=1;
            $data['messid']=$DATA_OBJECT->messId;

            $query='update messages set deletedreciever=:true where id=:messid';
            $DB->write($query,$data);
      }
    
}
  
$info->dataType = "deleteMessage";

echo json_encode($info);










?>