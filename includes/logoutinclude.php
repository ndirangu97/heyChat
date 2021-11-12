<?php

if (isset($_SESSION['userid'])) {
    unset($_SESSION['userid']);
    
    $info->message = "you have been logged out";
    $info->dataType = "logout";
    echo json_encode($info);
    session_destroy();
    
   
}


?>