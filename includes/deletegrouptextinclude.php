<?php
// print_r($DATA_OBJECT);

$sql=false;
$log=false;

$log['id']=$DATA_OBJECT->messId;
$sql='select * from groupmessages where id=:id limit 1';
$results=$DB->read($sql,$log);

if (is_array($results)) {
    $results=$results[0];

    if ($results->sender==$_SESSION['userid']) {
        $data=false;
        $query=false;

        $data['id']=$DATA_OBJECT->messId;
        $query='delete from groupmessages where id=:id';
        $write=$DB->write($query,$data);

        if ($write) {

                
            $sql=false;
            $log=false;
        
            $log['id']=$DATA_OBJECT->groupId;
        
            $sql='select * from groupmessages where groupid=:id ';
            $read=$DB->read($sql,$log);
            if ($read) {
                $sql=false;
                $log=false;
            
                $log['id']=$DATA_OBJECT->groupId;
            
                $sql='select * from groups where groupid=:id ';
                $read2=$DB->read($sql,$log);

                if (is_array($read2)) {
                    $groupDetails=$read2[0];
                }

                $messages="
                        
                <div class='rightContainerHeader'>
                <img src='./ui/images/user_male.jpg'  id='CurrentChatProfile' >
                <span id='CurrentChatName'> $groupDetails->groupName</span>
                <span id='onlineStatus'>Online</span>
                </div>
                
                <hr style=' margin-bottom: 10px;'>
                ";
                
                $messages.=" <div id='messageHolder'>";
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

                $info->message = $messages;
                $info->dataType = "sendGroupMessage";
                echo json_encode($info);

            }
               
        }

    }
}
