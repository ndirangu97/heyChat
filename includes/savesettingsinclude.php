<?php


if(!empty($DATA_OBJECT->username))
{
   
     if(strlen($DATA_OBJECT->username) < 3)
    {
        $err  .= "username must be at least 3 characters long. <br>";
    }

    if(!preg_match("/^[a-z A-Z 0-9]*$/", $DATA_OBJECT->username))
    {
        $err .= "Please enter a valid username . <br>";
    }
    if(strlen($DATA_OBJECT->username) >10)
    {
        $err  .= "username must not be more than 10 characters long. <br>";
    }

}
   
    
if(!empty($DATA_OBJECT->email))
{
    if (!filter_var($DATA_OBJECT->email, FILTER_VALIDATE_EMAIL)) {
    $err .= "Please enter a valid email format . <br>";
}
if(strlen($DATA_OBJECT->email) >30)
{
    $err  .= "email must not be more than 30  characters long. <br>";
}
    
}


if(!empty($DATA_OBJECT->password))
{
    if(strlen($DATA_OBJECT->password) <6)
{
    $err  .= "password must  be more than 6  characters long. <br>";
}
}

$sql=false;
$log=false;
$log['email']=$DATA_OBJECT->email;

  $sql="select * from users where email =:email limit 1";
  $results=$DB->read($sql,$log);
if (is_array($results)) {
   $err.='email already exists';
}





if($err == "")
{
    $data=false;
    $query=false;
    $password=password_hash($DATA_OBJECT->password,PASSWORD_DEFAULT);

    $data["status"]=$DATA_OBJECT->status;
    $data["username"]=$DATA_OBJECT->username;
    $data["email"]=$DATA_OBJECT->email;
    $data["gender"]=$DATA_OBJECT->gender;
    $data["password"]= $password;
    $data['userid']=$_SESSION['userid'];
    
    $query = "update users set status=:status,username=:username,email=:email,gender=:gender,password=:password where userid=:userid  ";
    $write = $DB->write($query,$data);

    if($write)
    {
        
        $info->message = "Your profile updated successfully";
        $info->dataType = "saveSettings";
        echo json_encode($info);
       
    }else
    {

        $info->message = "Oops!!Something went wrong try again later";
        $info->dataType = "error";
        echo json_encode($info);
     

    }
}else
{
    $info->message = $err;
    $info->dataType = "error";
    echo json_encode($info);
  
}





?>