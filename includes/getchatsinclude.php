<?php


$chats="
<div style='text-align: center;color:gray;margin-top:10px;margin-bottom:10px;'>
    Chats
</div>
<hr style='width: 60%;margin-left:100px;margin-bottom:25px;'>";

$sql=false;
$log=false;

$log['sender']=$_SESSION['userid'];


$sql='select * from messages where  sender=:sender || reciever=:sender group by messageid  ';
$results=$DB->read($sql,$log);


if (is_array($results)) {
    
    foreach ($results as $row) {
        $log=false;
       
        if ($row->sender==$_SESSION['userid']) {
            $log['id']=$row->reciever;
        }else if($row->reciever==$_SESSION['userid']) {
            $log['id']=$row->sender;
        }
        $sql=false;

        $sql='SELECT * FROM users WHERE  userid=:id ';
        $read=$DB->read($sql,$log);
        if (is_array($read)) {
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
        }
        $chats.="<div class=contactsContainer  id='$read->userid' onclick='startChat(event)'>

                    <img src=$image>
                    <div class='contactandStatus'  id='$read->userid'>
                        <div id='$read->userid'>$read->username</div>
                        <div class='contactsStatus' id='$read->userid'>$read->status</div>
                    </div>

                </div>

";
    }
$info->message = $chats;
$info->dataType = "getChats";
echo json_encode($info);
}else {
$info->message = "<div style='margin:auto'>Select a contact to start chatting</div>";
$info->dataType = "getChats";
echo json_encode($info);
}







?>