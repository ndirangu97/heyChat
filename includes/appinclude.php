<?php

    $sql=false;
    $log=false;
    
    $status="";

    $log['userid']=$_SESSION['userid'];

    $sql="select * from users where userid=:userid";
    $results=$DB->read($sql,$log);
    if (is_array($results)) {
       $result=$results[0];

       
    }

    $query=false;
    $data=false;

    $data['recieved']=true;
    $data['userid']=$_SESSION['userid'];

    $query='update messages set recieved=:recieved  where reciever=:userid';
    $update=$DB->write($query,$data);

    
$sql=false;
$log=false;

$log['sender']=$_SESSION['userid'];


$sql='select * from messages where  sender=:sender || reciever=:sender group by messageid  ';
$results2=$DB->read($sql,$log);

$chats="
<div style='text-align: center;color:gray;margin-top:10px;margin-bottom:10px;'>
    Chats
</div>
<hr style='width: 60%;margin-left:100px;margin-bottom:25px;'>";


if (is_array($results2)) {
  

    foreach ($results2 as $row) {
      

        
        if ($row->sender==$_SESSION['userid']) {
            $id=$row->reciever;
        }else if($row->reciever==$_SESSION['userid']) {
            $id=$row->sender;
        }
        $sql=false;
        $log=false;
        $log['id']=$id;
      
      
        $sql='select * from users where  userid=:id ';
        $read=$DB->read($sql,$log);
        if (is_array($read)) {
        //  print_r($read);
        //  die;
          $read=$read[0];
          $image="";
          if (!file_exists($read->image)) {
              if ($read->gender=='male') {
                  $image='./ui/images/user_male.jpg';
              }else {
                $image='./ui/images/user_female.jpg';
              }
          }else {
              $image=$read->image;
          }
           if (!file_exists($read->status)) {
             $status="Update your status in settings";
          }else {
              $status=$read->status;
          }
        $chats.="<div class=contactsContainer  id='$read->userid' onclick='startChat(event)'>";
        $chats.="    <span style='position:absolute;color:red;width:20px;height:20px;top:10px;right:20px;'>3</span>";
        
                

        $chats.="<img src=$image>
        <div class='contactandStatus'  id='$read->userid'>
            <div id='$read->userid'>$read->username</div>
            <div class='contactsStatus' id='$read->userid'>$read->status</div>
        </div>

    </div>

";
        }

    
        
    }
$info->message= $result;
$info->chats = $chats;
$info->dataType = "app";
echo json_encode($info);
}else {
$info->message= $result;    
$info->chats = 'Select a contact to start chatting';
$info->dataType = "app";
echo json_encode($info);
}

   


?>