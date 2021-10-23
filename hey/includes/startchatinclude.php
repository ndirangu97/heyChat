<?php


$query=false;
$data=false;

$data['recieved']=true;
$data['userid']=$_SESSION['userid'];

$query='UPDATE MESSAGES SET recieved=:recieved  WHERE reciever=:userid';
$update=$DB->write($query,$data);

$query=false;
$data=false;

$data['seen']=true;
$data['sender']=$DATA_OBJECT->chatid;
$data['userid']=$_SESSION['userid'];
$query='UPDATE MESSAGES SET seen=:seen  WHERE reciever=:userid && sender=:sender';
$DB->write($query,$data);



$sql=false;
$log=false;

$log['userid']=$DATA_OBJECT->chatid;

$sql='SELECT * FROM USERS WHERE userid=:userid LIMIT 1';
$results=$DB->read($sql,$log);

$image="";
if (is_array($results)) {
    $results= $results[0];

    if (!file_exists($results->image)) {
        if ($results->gender=='male') {
            $image='./ui/images/user_male.jpg';
        }else {
            $image='./ui/images/user_female.jpg';
        }
        
    }else {
        $image=$results->image;
    }
}


    $messages="
                    
        <div class='rightContainerHeader'>
        <img src='$image'  id='CurrentChatProfile' >
        <span id='CurrentChatName'>$results->username</span>
        <span id='onlineStatus'>Online</span>
        </div>
           
        <hr style=' margin-bottom: 10px;'>
        ";
     
        $messages.=" <div id='messageHolder'>";

        $sql=false;
        $log=false;

        $log['reciever']=$DATA_OBJECT->chatid;
        $log['sender']=$_SESSION['userid'];
        
        

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

       
       
       
        
        

        $messages.="</div>
        <hr>";
    $messages.=inputController();   









$info->message = $messages;
$info->dataType = "startChats";
echo json_encode($info);











?>