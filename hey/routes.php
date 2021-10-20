<?php

require_once './connection/auth.php';
session_start();

$DATA_RAW=file_get_contents('php://input');
$DATA_OBJECT=json_decode($DATA_RAW);

$DB=new Database();

$info=(object)[];
$err="";


if (!isset($_SESSION['userid'])) {
	if (isset($DATA_OBJECT->dataType)) {
		if ($DATA_OBJECT->dataType != "signup"&&$DATA_OBJECT->dataType != "login") {
			$info->dataType = "logout";
			echo json_encode($info);
			die;
			
		}
		
	}
}

if(isset($DATA_OBJECT->dataType) && $DATA_OBJECT->dataType == "signup")
{
	//signup
	include("./includes/signupinclude.php");
}
if(isset($DATA_OBJECT->dataType) && $DATA_OBJECT->dataType == "login")
{
	//login
	include("./includes/logininclude.php");
}
if(isset($DATA_OBJECT->dataType) && $DATA_OBJECT->dataType == "logout")
{
	//logout
	include("./includes/logoutinclude.php");
}
if(isset($DATA_OBJECT->dataType) && $DATA_OBJECT->dataType == "app")
{
	//signup
	include("./includes/appinclude.php");
	
}
if(isset($DATA_OBJECT->dataType) && $DATA_OBJECT->dataType == "getChats")
{
	include('./includes/getchatsinclude.php');

}
if(isset($DATA_OBJECT->dataType) && $DATA_OBJECT->dataType == "getContacts")
{
	include('./includes/getcontactsinclude.php');

}
if(isset($DATA_OBJECT->dataType) && $DATA_OBJECT->dataType == "getSettings")
{
	
	include('./includes/getsettingsinclude.php');
}
if(isset($DATA_OBJECT->dataType) && $DATA_OBJECT->dataType == "saveSettings")
{
	include('./includes/savesettingsinclude.php');
	
}
if(isset($DATA_OBJECT->dataType) && $DATA_OBJECT->dataType == "startChat")
{
	include('./includes/startchatinclude.php');
	
}
if(isset($DATA_OBJECT->dataType) && $DATA_OBJECT->dataType == "sendMessage")
{
	include('./includes/sendmessageinclude.php');
	
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

//function returning input
function inputController()
{
	return "
	<div class='messageInput'>
	<img src='./ui/images/clip.png' id='sendFileInput' >
	<textarea id='InputMessageText' rows='2' cols='50' placeholder='Type message' style='letter-spacing: 1px;'></textarea>
	<button id='sendMessageButton' onclick='sendMessage()'>Send</button>
	</div>
	
	";
}

//function returning messageLeft
function messageLeft($row)
{
	return"
	<div class='messageLeftDiv''>
		<div class='messageleft'  onclick='deleteMessage(event)' id='$row->id'> 
		$row->message
		</div>
	</div>
	";
}


//function returning messageRight
function messageRight($row)
{
	return"
	<div class='messageRightDiv' >
            <div class='messageRight'  onclick='deleteMessage(event)' id='$row->id' >
			$row->message
            </div>

        </div>
	";
}






?>