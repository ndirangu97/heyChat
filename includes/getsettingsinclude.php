<?php

$sql=false;
$log=false;
$status='';
$log['userid']=$_SESSION['userid'];

$sql='select * from users where userid=:userid limit 1';
$results=$DB->read($sql,$log);

$image="";
$genderMale ="";
$genderFemale ="";
if (is_array($results)) {
    $results=$results[0];
    
    if ($results->gender=='male') {
        $genderMale ='checked';
    }else {
        $genderFemale ='checked';
    }
     if ($results->status==null) {
       $status="No status. Update your status";
    }else {
       $status=$results->status;
    }
    
}

$settings="
<div class='settingsHolder' style='display:flex;justify-content:center;align-items:center;flex-direction:column;'>
<div  >
<img class='changeProfileSetting' src='$results->image' id='profilePicDrag' ondrop='ondropPic(event)' ondragover='ondragoverPic(event)' ondragleave='ondragleavePic(event)'  >
</div>
<input type='file' id='fileInput' onchange='changeProfilePic(this.files)' style='display:none;'>
<div style='align-self:center;justify-self:center;'>
<label for='fileInput' id='ChangeProfilePicButton'>Change ProfilePic</label>
</div>
<form id='collectSettingForm'>
    <input type='text' id='statusInput' name='status' placeholder='$status'>
    <div><button style='margin-left:200px;margin-top:5px;background:gray;border-radius:8px;padding:4px;border:none;cursor:pointer;' onclick='changeStatus()'> Change status</button></div>
    <div class='settingForm'>
    <div><input class='settingFormInput' name='username' type='text' id='usernameInput' value='$results->username'></div>
      <div><button onclick='changeUsername()' style='margin-left:85px;margin-top:5px;background:gray;border-radius:8px;padding:4px;border:none;cursor:pointer;' > Change username</button></div>
    <div><input class='settingFormInput' name='email' type='text' id='emailInput' value='$results->email'></div>
      <div><button style='margin-left:85px;margin-top:5px;background:gray;border-radius:8px;padding:4px;border:none;cursor:pointer;' onclick='changeEmail()'> Change email</button></div>
    <span style='color: #999999;;margin-top:10px'>Gender</span>
    <div style='display: flex;flex-direction:column;color: #999999;margin-top:10px'>
        <div>
            <input type='radio' name='gender' value='male' $genderMale id='male'>
        <label for='male'>Male</label>
        </div>
        <div>
            <input type='radio' name='gender' value='female'  $genderFemale id='female'>
        <label for='female'>Female</label>
        </div>
        
        
    </div>


   
</form>
</div>

";




$info->message = $settings;
$info->dataType = "getSettings";
echo json_encode($info);

?>