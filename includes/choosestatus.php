<?php

$messages="<div style='text-align:center;color:gray;margin-bottom:20px;margin-top:20px;'>Choose status</div>
<hr style='width:60%;margin-left:90px;margin-bottom:30px;'>
<div style='margin-left:20px;'>
";

$messages.="
<div style='margin-top:80px;margin-left:300px;'><input type='file' id='statusFile' name='statusInput[]' multiple='multiple' onchange='uploadProfile(this.files)' style='display:none;'>
        <label for='statusFile' id='statusFileLabel' >choose status</label>
</div>
";


$info->message = $messages;
$info->dataType = "choosestatus";
echo json_encode($info);

?>