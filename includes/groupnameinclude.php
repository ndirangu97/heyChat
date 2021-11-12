<?php


$contacts="

<div id='groupNameHolder'>
              
    <div style='margin: 100px 0 20px 80px;color:gray;'>
        Add Group Name:<br>
    </div>
    <div>
        <input type='text' name='groupName' id='groupNameInput'>
        <span class='addGroupIcon' onclick=newGroup()>&plus;</span>
    </div>
</div>
";


$info->message = $contacts;
$info->dataType = 'groupName';
echo json_encode($info);







?>