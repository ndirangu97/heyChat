<?php



$sql=false;
$log=false;

$members=array();

$log['groupid']=$DATA_OBJECT->groupid;

$sql='select * from groups where groupid=:groupid';
$results=$DB->read($sql,$log);

if (is_array($results)) {
   
    $groupDetails=$results[0];

    $groupid= $groupDetails->groupId;
    $groupname=$groupDetails->groupName;
    $image="";
    if (!file_exists($results[0]->groupProfile)) {
       $image='./ui/images/group_image.png';
    }else {
        $image=$group->groupProfile;
    }

    $messages="
                    
    <div class='rightContainerHeader'>
    <img src='$image'  id='CurrentChatProfile' >
    <span id='CurrentChatName'> $groupDetails->groupName</span>
    <span id='onlineStatus'>Online</span>
    </div>
       
    <hr style=' margin-bottom: 10px;'>
    ";
  
    $messages.=" <div id='messageHolder'>"; 
      
    
    
    $sql=false;
    $log=false;

    $log['id']=$DATA_OBJECT->groupid;

    $sql='select * from groupmessages where groupid=:id  order by id asc';
    $read=$DB->read($sql,$log);

    if (is_array( $read)) {
        foreach ($read as $row) {            
                    if ($row->sender==$_SESSION['userid']) {
                
                        $messages.=groupMessageRight($row);
                      
                   }else {
                      
                       $messages.=groupMessageLeft($row);
                }
            
        }
    }

    

    $messages.="</div>
        <hr>";
    $messages.=groupInputController(); 

    $info->id =  $DATA_OBJECT->groupid;
    $info->members =$members;
    $info->groupname = $groupname;
    $info->message = $messages;
    $info->dataType = "startGroupChat";
    echo json_encode($info);
}











?>