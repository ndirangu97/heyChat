<?php


$query=false;
$data=false;

$data['recieved']=true;
$data['userid']=$_SESSION['userid'];

$query='update messages set recieved=:recieved  where reciever=:userid';
$update=$DB->write($query,$data);

$query=false;
$data=false;

$data['seen']=true;
$data['sender']=$DATA_OBJECT->chatid;
$data['userid']=$_SESSION['userid'];
$query='update messages set seen=:seen  where reciever=:userid && sender=:sender';
$DB->write($query,$data);



$sql=false;
$log=false;

$log['userid']=$DATA_OBJECT->chatid;

$sql='select * from users where userid=:userid limit 1';
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
        
        

        $sql="select  * from messages where  (sender=:sender && reciever=:reciever && deletedsender=0 ) || (sender=:reciever && reciever=:sender  && deletedreciever=0) ";
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