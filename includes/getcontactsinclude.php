<?php
$sql=false;
$log=false;


$log['userid']=$_SESSION['userid'];

$sql='select * from users where userid!=:userid ';
$results=$DB->read($sql,$log);

$contacts="<div style='text-align:center;color:gray;margin-bottom:20px;margin-top:20px;'>Contacts</div>
<hr style='width:60%;margin-left:90px;margin-bottom:30px;'>
<div style='margin-left:20px;'>
";
if (is_array($results)) {
   foreach ($results as $row ) {

        $image="";

        if (!file_exists($row->image)) {
            if($row->gender=='male') {
                $image='./ui/images/user_male.jpg';
            }else {
                $image='./ui/images/user_female.jpg';
            }
        }else {
            $image=$row->image;
        }
        //llop through contacts
        $contacts.="
        <div class='contactsContainer' id='$row->userid' onclick='startChat(event)'>
        <img src=$image >
        <div class='contactandStatus' id='$row->userid' >
                <div id='$row->userid'>$row->username</div>
                <div class='contactsStatus' id='$row->userid'>$row->status</div>
        </div>
        
    </div>
        
        
        ";
    }
}
$contacts.="</div>";

$info->message = $contacts;
$info->dataType = "getContacts";
echo json_encode($info);










?>