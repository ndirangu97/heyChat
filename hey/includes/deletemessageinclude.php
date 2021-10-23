<?php

$sql=false;
$log=false;

$log['messid']=$DATA_OBJECT->messId;
$sql='SELECT * FROM MESSAGES WHERE id=:messid ';
$results=$DB->read($sql,$log);

if (is_array($results) ){

    $row=$results[0];

       if ($row->sender==$_SESSION['userid']) {
            $query=false;
            $data=false;

            $data['true']=1;
            $data['messid']=$DATA_OBJECT->messId;


            $query='UPDATE MESSAGES SET deletedSender=:true WHERE id=:messid';
            $DB->write($query,$data);
       }elseif ($row->reciever==$_SESSION['userid']) {
            $query=false;
            $data=false;

            
            $data['true']=1;
            $data['messid']=$DATA_OBJECT->messId;

            $query='UPDATE MESSAGES SET deletedReciever=:true WHERE id=:messid';
            $DB->write($query,$data);
       }
  
    
}
$sql=false;
$log=false;

$log['reciever']=$DATA_OBJECT->chatid;
$log['sender']=$_SESSION['userid'];

$messages="";

$sql="SELECT * FROM MESSAGES WHERE  (sender=:sender && reciever=:reciever && deletedSender=0 ) || (sender=:reciever && reciever=:sender  && deletedReciever=0) ";
$results2=$DB->read($sql,$log);
if (is_array($results2)) {
    foreach ($results2 as $row) {
        if ($row->sender==$_SESSION['userid']) {
            
             $messages.=messageRight($row);
           
        }else{
           
            $messages.=messageLeft($row);
        
    }
}
}
$messages.="";


$info->message = $messages;
$info->dataType = "deleteMessage";
echo json_encode($info);




?>