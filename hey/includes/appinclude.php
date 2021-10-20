<?php

    $sql=false;
    $log=false;

    $log['userid']=$_SESSION['userid'];

    $sql="SELECT * FROM users WHERE userid=:userid";
    $results=$DB->read($sql,$log);
    if (is_array($results)) {
       $results=$results[0];

       
    }

    $query=false;
    $data=false;

    $data['recieved']=true;
    $data['userid']=$_SESSION['userid'];

    $query='UPDATE MESSAGES SET recieved=:recieved  WHERE reciever=:userid';
    $update=$DB->write($query,$data);

    $info->message= $results;
    $info->dataType = "app";
    echo json_encode($info);


?>