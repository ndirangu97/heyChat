<?php



$query = false;
$data = false;

$members=$DATA_OBJECT->members;
array_push($members,$_SESSION['userid']);
$gid=groupId();
$data['groupid']=$gid;

foreach ($members as $mem) {
   
    $data['groupname'] =$DATA_OBJECT->groupname ;

    
    $data['members']=$mem;
    $data['date']=date('Y-m-d H:i:s');

    


    $query= 'insert into groups(groupid,groupname,member,date) values(:groupid,:groupname,:members,:date)';
    $write = $DB->write($query, $data);
    
    
        
}

$query = false;
$data = false;

$data['admin']=1;
$data['memberid']=$_SESSION['userid'];

$query='update groups set admin=:admin where member=:memberid';
$write = $DB->write($query, $data);





$info->dataType = "saveGroup";
echo json_encode($info);

?>