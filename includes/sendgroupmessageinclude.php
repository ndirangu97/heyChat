<?php

$messid="";

   
    $query = false;
    $data = false;

   
    $messid=messageId();
  
     
        $data['groupid']=$DATA_OBJECT->groupId;
        $data['message']=$DATA_OBJECT->message;
        
        $data['sender']=$_SESSION['userid'];
        $data['date']=date('Y-m-d H:i:s');

       
        $query= 'insert into groupmessages(groupid,message,sender,date) values(:groupid,:message,:sender,:date)';
        $write = $DB->write($query, $data);

            
    $sql=false;
    $log=false;

    $log['groupid']=$DATA_OBJECT->groupId;

    $sql="select * from groups where groupid=:groupid limit 1";
    $read2=$DB->read($sql,$log);

    if (is_array( $read2)) {
        $groupDetails=$read2[0];
        $messages="
                    
        <div class='rightContainerHeader'>
        <img src='./ui/images/user_male.jpg'  id='CurrentChatProfile' >
        <span id='CurrentChatName'> $groupDetails->groupName</span>
        <span id='onlineStatus'>Online</span>
        </div>
           
        <hr style=' margin-bottom: 10px;'>
        ";
    }
      

        
      
        $messages.=" <div id='messageHolder'>"; 

    
        $sql=false;
        $log=false;
    
        $log['id']=$DATA_OBJECT->groupId;
    
        $sql='select * from groupmessages where groupid=:id order by id asc';
        $read=$DB->read($sql,$log);
      
    if (is_array($read)){ 
        foreach ($read as $row) {
                
                    if ($row->sender==$_SESSION['userid']) {
                
                        $messages.=groupMessageRight($row);
                      
                   }else {
                      
                       $messages.=groupMessageLeft($row);
                }
            
        }

        $messages.="</div>
        <hr>";
    $messages.=groupInputController(); 
    }
    


$info->message = $messages;
$info->dataType = "sendGroupMessage";
echo json_encode($info);









?>