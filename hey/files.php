<?php


require_once './connection/auth.php';
session_start();

$DB=new Database();

$info=(object)[];
$err="";

// print_r($_FILES);
// print_r($_POST);

if ($_FILES['file']['name']!="" && $_FILES['file']['error']==0) {

    $folder='./uploads/' ; 
    if (!file_exists($folder)) {
        mkdir($folder,0777,true);
    }  

    $destination=$folder.$_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'],$destination);
}

if ($_POST['type']=='changeProfilePic') {
    $query=false;
    $data=false;
    
    $data['image']=$destination;
    $data['userid']=$_SESSION['userid'];

    $query='UPDATE USERS SET image=:image WHERE userid=:userid';
    $write=$DB->read($query,$data);

    
        
    $info->message = 'profile updated successfully';
    $info->dataType = 'updateProfile';
    echo json_encode($info);
        
  
   
    
}


?>