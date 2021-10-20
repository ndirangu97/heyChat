<?php
  if(empty($DATA_OBJECT->username))
  {
      $err .= "Please enter a valid username . <br>";
      
  }else
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

       
  if(empty($DATA_OBJECT->firstname))
  {
      $err .= "Please enter a valid firstname . <br>";
      
  }else
  {
      if(strlen($DATA_OBJECT->firstname) < 3)
      {
          $err  .= "firstname must be at least 3 characters long. <br>";
      }

      if(!preg_match("/^[a-z A-Z]*$/", $DATA_OBJECT->firstname))
      {
          $err .= "Please enter a firstname . <br>";
      }
      if(strlen($DATA_OBJECT->firstname) >10)
      {
          $err  .= "firstname must not be more than 10 characters long. <br>";
      }

      
      
  }
  if(empty($DATA_OBJECT->lastname))
  {
      $err .= "Please enter a valid lastname . <br>";
      
  }else
  {
      if(strlen($DATA_OBJECT->lastname) < 3)
      {
          $err  .= "lastname must be at least 3 characters long. <br>";
      }

      if(!preg_match("/^[a-z A-Z]*$/", $DATA_OBJECT->lastname))
      {
          $err .= "Please enter a lastname . <br>";
      }
      if(strlen($DATA_OBJECT->lastname) >10)
      {
          $err  .= "lastname must not be more than 10  characters long. <br>";
      }

      
      
  }
  if(empty($DATA_OBJECT->email))
  {
      $err .= "Please enter a valid email . <br>";
      
  }
  if (!filter_var($DATA_OBJECT->email, FILTER_VALIDATE_EMAIL)) {
      $err .= "Please enter a valid email format . <br>";
  }
  if(strlen($DATA_OBJECT->email) >30)
  {
      $err  .= "email must not be more than 30  characters long. <br>";
  }

  if(empty($DATA_OBJECT->password))
  {
      $err .= "Please enter a valid password. <br>";
      
  }
  if(strlen($DATA_OBJECT->password) <6)
  {
      $err  .= "password must  be more than 6  characters long. <br>";
  }

  $sql=false;
  $log=false;
  $log['email']=$DATA_OBJECT->email;

    $sql="SELECT * FROM users WHERE email =:email LIMIT 1";
    $results=$DB->read($sql,$log);
  if (is_array($results)) {
     $err.='email already exists';
  }

  if(empty($DATA_OBJECT->gender))
  {
      $err .= "Please select gender. <br>";
      
  }
 

  

  if($err == "")
  {
      $data=false;
      $query=false;
      $password=password_hash($DATA_OBJECT->password,PASSWORD_DEFAULT);
  

      $data["firstname"]=$DATA_OBJECT->firstname;
      $data["lastname"]=$DATA_OBJECT->lastname;
      $data["username"]=$DATA_OBJECT->username;
      $data["email"]=$DATA_OBJECT->email;
      $data["gender"]=$DATA_OBJECT->gender;
      $data["password"]= $password;
      $data["userid"]=$DB-> generateuserid(60);
      $data["date"]=date('Y-m-d H-i-s');
      if ($DATA_OBJECT->gender=='male') {
        $data["image"]='./ui/images/user_male.jpg';
      }elseif ($DATA_OBJECT->gender=='female') {
        $data["image"]='./ui/images/user_female.jpg';
      }
      

      $query = "insert into users (userid,firstname,lastname,username,gender,email,password,date,image) values (:userid,:firstname,:lastname,:username,:gender,:email,:password,:date,:image)";
      $write = $DB->write($query,$data);

      if($write)
      {
          
          $info->message = "Your profile was created";
          $info->dataType = "signup";
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
