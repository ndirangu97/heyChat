<?php



$groups="<div style='text-align:center;color:gray;margin-bottom:20px;margin-top:20px;'>Groups</div>
<hr style='width:60%;margin-left:90px;margin-bottom:30px;'>
<div style='margin-left:20px;'>
";

$sql=false;
$log=false;
$log['me']=$_SESSION['userid'];


$sql='SELECT * FROM groups WHERE member=:me';
$read=$DB->read($sql,$log);


   
    foreach ($read as $group) {
     
        $image="";
        if (!file_exists($group->groupProfile)) {
           $image='./ui/images/group_image.png';
        }else {
            $image=$group->groupProfile;
        }

        $groups.="
        <div class='contactsContainer' id='$group->groupid' onclick='startGroupChat(event)'>
        <img src=$image >
        <div class='contactandStatus' id='$group->groupid' >
                <div id='$group->groupid'>$group->groupname</div>
               
        </div>
        
    </div>
        
        
        ";
    }

    $groups.="</div>";

$info->message = $groups;
$info->dataType = "getGroup";
echo json_encode($info);







?>