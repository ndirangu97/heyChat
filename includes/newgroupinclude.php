<?php


$name=$DATA_OBJECT->groupname;
    
$sql = false;
$log = false;

$log['userid'] = $_SESSION['userid'];

$sql = 'select * from users where userid!=:userid ';
$results = $DB->read($sql, $log);

$contacts = " <div id='addGroupHeader'>

</div>
<hr>
";

if (is_array($results)) {
    foreach ($results as $row) {

        $image = "";

        if (!file_exists($row->image)) {
            if ($row->gender == 'male') {
                $image = './ui/images/user_male.jpg';
            } else {
                $image = './ui/images/user_female.jpg';
            }
        } else {
            $image = $row->image;
        }
        //loop through contacts
        $contacts .= "
        <div id='addGroupHolder' >
         <div class='contactsContainer' id='$row->userid' ondblclick='addToGroup(event)' >
                <img src=$image >
                <div class='contactandStatus' id='$row->userid' >
                        <div id='$row->userid'>$row->username</div>
                        <div class='contactsStatus' id='$row->userid'>$row->status</div>
                </div>
            
            </div>
        <div/>    
        
        
        ";
    }
}
$contacts .= "<div>
<button style='bottom:20%;right:20%;position:absolute;cursor:pointer;' onclick='saveGroup()'>click me</button>
</div>";

$info->name=$name;
$info->message = $contacts;
$info->dataType = "newGroup";
echo json_encode($info);
    













?>