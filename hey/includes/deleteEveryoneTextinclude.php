<?php


$query=false;
$data=false;

$data['id']=$DATA_OBJECT->messId;


$query='DELETE FROM MESSAGES WHERE id=:id';
$write=$DB->write($query,$data);

if ($write) {
    
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



}
$info->message = $messages;
$info->dataType = "deleteMessage";
echo json_encode($info);





?>