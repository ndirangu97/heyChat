<?php

if(empty($DATA_OBJECT->email))
    {
        $err .= "Please enter a valid email . <br>";
        
    }
    if(empty($DATA_OBJECT->password))
    {
        $err .= "Please enter a valid password . <br>";
        
    }
    if ($err=="") {
        $sql=false;
        $log=false;

        $log['email']=$DATA_OBJECT->email;
        
        $sql="SELECT * FROM users WHERE email =:email LIMIT 1";
        $results=$DB->read($sql,$log);
        if (is_array($results)) {
            $results=$results[0];
            if (password_verify($DATA_OBJECT->password,$results->password)) {
                $_SESSION['userid']=$results->userid;
                $info->message =" you are logged in";
                $info->dataType = "login";
                echo json_encode($info);
                
                
            }else{
            $info->message =" wrong password";
            $info->dataType = "error";
            echo json_encode($info);
                
            }

        }else
        {
            $info->message =" email doesn't exist";
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