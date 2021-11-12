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

    $query='update users set image=:image where userid=:userid';
    $write1=$DB->write($query,$data);
    if ($write1) {
        $info->message = 'profile updated successfully';
    $info->dataType = 'updateProfile';
    echo json_encode($info);
    }

    
        
    
        
  
   
    
}elseif ($_POST['type']=='sendMessageFile') {
    $sql=false;
    $log=false;

    $query=false;
    $data=false;

    $log['sender']=$_SESSION['userid'];
    $log['reciever']=$_POST['chatid'];

    //read from DB to ensure same messages have the same messid
    $sql='select * from messages where (sender=:sender && reciever=:reciever) || (sender=:reciever && reciever=:sender) limit 1';
    $read=$DB->read($sql,$log);

    
    $data['messageid']= messageId();

    if (is_array($read)) {
        $read=$read[0];
        $data['messageid']= $read->messageid;

    }
    $data['image']=$destination;
    $data['sender']=$_SESSION['userid'];
    $data['reciever']=$_POST['chatid'];
    $data['date']=date('Y-m-d H:i:s');


    
    $query='insert into messages(files,messageid,sender,reciever,date) values(:image,:messageid,:sender,:reciever,:date) ';
    $write=$DB->write($query,$data);
    $messages="";
    if ($write) {
        $sql=false;
        $log=false;
    
        $log['reciever']=$_POST['chatid'];
        $log['sender']=$_SESSION['userid'];
    
    
        $sql='select * from messages where  (sender=:sender && reciever=:reciever  && deletedsender=0) || (sender=:reciever && reciever=:sender && deletedreciever=0) ';
        $results2=$DB->read($sql,$log);
        if (is_array($results2)) {
            foreach ($results2 as $row) {
                if ($row->sender==$_SESSION['userid']) {
                    $messages.=messageRight($row);
                }else {
                    $messages.=messageLeft($row);
                }
            }
        }
        
    }
    $messages.="";

    $info->message = $messages;
    $info->dataType = "sendMessage";
    echo json_encode($info);
}elseif ($_POST['type']=='sendGroupMessageFile') {
    $query=false;
    $data=false;
   
    $data['image']=$destination;
    $data['sender']=$_SESSION['userid'];
    $data['id']= $_POST['groupid'];
    $data['date']=date('Y-m-d H:i:s');


    
    $query='insert into groupmessages(files,groupId,sender,date) values(:image,:id,:sender,:date) ';
    $write=$DB->write($query,$data);
    $messages="";
    if ($write) {
        $sql=false;
        $log=false;
    
        $log['id']=$_POST['groupid'];
        
        $sql='select * from groupmessages where groupid =:id ';
        $results2=$DB->read($sql,$log);
        if (is_array($results2)) {
            foreach ($results2 as $row) {
                if ($row->sender==$_SESSION['userid']) {
                    $messages.=messageRight($row);
                }else {
                    $messages.=messageLeft($row);
                }
            }
        }
        
    }
    $messages.="";

    $info->message = $messages;
    $info->dataType = "sendGroupMessage";
    echo json_encode($info);



}



//generates messageid
function messageId()
{	

	$array=array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$rand=rand(4,60);
	$r='';
	for ($i=0; $i <=$rand ; $i++) { 
		$random=rand(0,61);
		$r.=$array[$random];
	}
	return $r;
}  


//function returning messageLeft
function messageLeft($row)
{
	return"
	<div class='messageLeftDiv''>
		<div class='messageleft'  ondblclick='openDeleteModal(event)' id='$row->id'> 
		$row->message
        <img src='$row->files' style='max-width:200px;max-height:200px;object-fit:cover;'   id='$row->id'>
		</div>
	</div>
	";
}




//function returning messageRight
function messageRight($row)
{
	return"
	<div class='messageRightDiv' >
            <div class='messageRight'  ondblclick='openDeleteModal(event)' id='$row->id' >
			$row->message
            <img src='$row->files' style='max-width:200px;max-height:200px;object-fit:cover;'   id='$row->id'>
            </div>

        </div>
	";
}


?>