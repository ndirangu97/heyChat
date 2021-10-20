<?php

$sql=false;
$log=false;

$log['userid']=$_SESSION['userid'];

$sql='SELECT * FROM USERS WHERE userid=:userid limit 1';
$results=$DB->read($sql,$log);

$image="";
$genderMale ="";
$genderFemale ="";
if (is_array($results)) {
    $results=$results[0];
    if (!file_exists($results->image)) {
        if ($results->gender=="male") {
            $image='./ui/images/user_male.jpg';
        }else {
            $image='./ui/images/user_female.jpg';
        }
    }else {
        $image=$results->image;
    }
    if ($results->gender=='male') {
        $genderMale ='checked';
    }else {
        $genderFemale ='checked';
    }
    
}

$settings="

<div  >
<img class='changeProfileSetting' id='profilePicDrag' ondrop='ondropPic(event)' ondragover='ondragoverPic(event)' ondragleave='ondragleavePic(event)' src=$image >
</div>
<input type='file' id='fileInput' onchange='changeProfilePic(this.files)' style='display:none;'>
<label for='fileInput' id='ChangeProfilePicButton'>Change ProfilePic</label>
<form id='collectSettingForm'>
    <input type='text' id='statusInput' name='status' value=$results->status>
    <div class='settingForm'>
    <input class='settingFormInput' name='username' type='text' value=$results->username>
    <input class='settingFormInput' name='email' type='text' value=$results->email>
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


    <input class='settingFormInput' name='password' id='password' type='password' placeholder='Change Password'>
        <div> 
            <input type='checkbox' name='togglePassword'  onclick='showPassword()'><span style='margin-left: 10px;color:gray;'>show password</span><br><br>
        </div>
    <input id='settingFormSubmit' type='submit' value='Change Profile' onclick='collectSetting()'>
    </div>
</form>

";




$info->message = $settings;
$info->dataType = "getSettings";
echo json_encode($info);

?>