<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hey</title>
    <link rel="stylesheet" href="./index.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&family=Irish+Grover&family=Montserrat:wght@100&family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

</head>

<body>

<div id="groupModal">
        added
        
    </div>
    <div id="modal">

        <span id="closeModal" onclick="closeDeleteModal()">&times</span>
        <button class="btn" onclick="deleteMessage()">Delete</button>
        <button class="btn" onclick="deleteForEveryone()">Delete for everyone</button>

    </div>
    <div id="groupDeleteModal">

    <span id="closeGroupDeleteModal" onclick="closeGroupDeleteModal()">&times</span>
    <button class="btn" onclick="deleteGroupMessage()">Delete</button>
    </div>
    
    <section>
        <div id="leftContainer">
            <div class="myPicStatus">
                <img id="myProfilePic">
                <div id="myStatus">
                    
                </div>
            </div>
            <hr class='resHr1' style="color: green;">
            <div class="nav">
        
                <input type="radio" name="chats" id="chatsRadio" style="display: none;">
                <input type="radio" name="contacts" id="contactsRadio" style="display: none;">
                <input type="radio" name="groups" id="groupsRadio" style="display: none;">
                <input type="radio" name="setings" id="settingsRadio" style="display: none;">
                <input type="radio" name="logout" id="logoutRadio" style="display: none;">
                <input type="radio" name="addGroup" id="addGroupRadio" style="display: none;">
                <input type="radio" name="status" id="statusRadio" style="display: none;">
                <label for="chatsRadio" onclick="getChats()" > <span class="labelSpan">Chats</span> <img src="./ui/images/chat.png" style="float: right;" alt=""></label>
                <hr class="hr">
                <label for="groupsRadio" onclick="getgroups()"> <span class="labelSpan">Groups</span> <img src="./ui/images/addGroup.png" style="float: right;" alt=""></label>
                <hr class="hr">
                <label for="statusRadio" onclick="chooseStatus()"><span class="labelSpan">Status</span> <img style="float: right;" src="./ui/images/addGroup.png" alt=""></label>
                <hr class="hr">
                <label for="contactsRadio" onclick="getContacts()"><span class="labelSpan">Contacts</span> <img style="float: right;" src="./ui/images/contacts.png" alt=""></label>
                <hr class="hr">
                <label for="addGroupRadio" onclick="groupName()"><span class="labelSpan">New Group</span> <img style="float: right;" src="./ui/images/addGroup.png" alt=""></label>
                <hr class="hr">
                <label for="settingsRadio" onclick="getSettings()"><span class="labelSpan">Settings</span> <img style="float: right;" src="./ui/images/settings.png" alt=""></label>
                <hr class="hr">
                <label for="logoutRadio" onclick="logout()"><span class="labelSpan">Logout</span> <img style="float: right;" src="./ui/images/logout.png" alt=""></label>
                <hr class="hr">



            </div>


        </div>
        <hr class='resHr' style="margin-top: -15px;">
        <div id="rightContainer">
          


        </div>


    </section>


</body>

</html>
<script>

</script>

<script type="text/javascript">
    //func to get element id
    function _(element) {
        return document.getElementById(element);
    }

    var CURRENT_CHAT_USER = '';
    var MESSAGE_ID = '';
    var GROUPCHAT_ID="";
    var gId="";

    
    var GROUP_MEMBERS=[];
    var GROUP_NAME="";
    var SEND_GROUP_ID="";
    var SEND_MESSAGE_MEMBERS=[];
    var SEND_MESSAGE_NAME="";


    var rightContainer = _('rightContainer');

    var data = {};

    //function for loader
    function loader() {
        var a="<div style='display:flex; justify-content: center;align-items: center;width:100%;height:100%;'><img id='giffy' src='./ui/images/loader.gif'></div>";
        return a;
    }


    //func to sendData to server
    const sendData = (data, type) => {
        rightContainer.innerHTML=loader();
        var xml = new XMLHttpRequest();
        xml.onload = function() {
            if (xml.readyState == 4 || xml.status == 200) {
                handleResult(xml.responseText);
            }
        }
        data.dataType = type;
        var dataString = JSON.stringify(data);
        xml.open('POST', 'routes.php', true);
        xml.send(dataString);

    }
       //func to sendInfo to server without loading
    const sendInfo = (data, type) => {
        
        var xml = new XMLHttpRequest();
        xml.onload = function() {
            if (xml.readyState == 4 || xml.status == 200) {
                handleResult(xml.responseText);
            }
        }
        data.dataType = type;
        var dataString = JSON.stringify(data);
        xml.open('POST', 'routes.php', true);
        xml.send(dataString);

    }

    //func to process data from server
    const handleResult = (results) => {
        // alert(results);

        var info = JSON.parse(results);

        var key = info.dataType;

        switch (key) {
            case 'logout':
                window.location = './login.php';
                break;
            case 'app':
                var profile = _('myProfilePic');
                var status = _('myStatus');
                if (info.message.image == null) {
                    if (info.message.gender == 'male') {
                        profile.src = './ui/images/user_male.jpg';
                    } else {
                        profile.src = './ui/images/user_female.jpg';
                    }
                } else {
                    profile.src = info.message.image;
                }
                if(info.message.status == null){
                    status.innerHTML="Update your status in settings";
                }else{
                     status.innerHTML=info.message.status;
                }
                status.innerHTML = info.message.status;
                rightContainer.innerHTML = info.chats;

                break;
            case 'getChats':

                rightContainer.innerHTML = info.message;
                break;
            case 'getContacts':

                rightContainer.innerHTML = info.message;
                break;

            case 'getSettings':

                rightContainer.innerHTML = info.message;
                break;
            case 'saveSettings':

                rightContainer.innerHTML = info.message;
                sendData(data, "app");
                break;
            case 'startChats':

                rightContainer.innerHTML = info.message;
                var messageHolder = _('messageHolder');
                messageHolder.scrollTo(0, messageHolder.scrollHeight);

                break;
            case 'sendMessage':
                
                rightContainer.innerHTML = info.message;
                var messageHolder = _('messageHolder');

                messageHolder.scrollTo(0, messageHolder.scrollHeight);
               
                break;
            case 'groupName':
               
                rightContainer.innerHTML = info.message;
                break;
            case 'newGroup':
               
               rightContainer.innerHTML = info.message;
               GROUP_NAME=info.name;
              
               break;
            case 'saveGroup':
               
              getgroups();
               
               break;
            case 'changeStatus':
               
             sendData(data, "getSettings");
               
               break;
            case 'getGroup':
               
               rightContainer.innerHTML = info.message;
               
               break;
            case 'startGroupChat':
               
               rightContainer.innerHTML = info.message;
               gId=info.id;
          
               (info.members).forEach(element => {
                   var isIn= SEND_MESSAGE_MEMBERS.includes(element);
                   if (!isIn) {
                    SEND_MESSAGE_MEMBERS.push(element);
                   }
               });
              
               
               SEND_MESSAGE_NAME=info.groupname;
               break;
            case 'sendGroupMessage':
               
               rightContainer.innerHTML = info.message;
               var messageHolder = _('messageHolder');
                messageHolder.scrollTo(0, messageHolder.scrollHeight);

                var groupModal=_('groupDeleteModal');
                groupModal.style.display='none';
               
               break;
            case 'choosestatus':
                rightContainer.innerHTML = info.message;
                break;  
             case 'deleteMessage':
                    sendDeleteMessage();


            break;
             case 'showdeletedmessage':
                rightContainer.innerHTML = info.message;
                var messageHolder = _('messageHolder');

                // messageHolder.scrollTo(0, messageHolder.scrollHeight);


            break;


            default:
                break;
        }

    }


    //func fired to load app when browser is opened/redirected
    sendData(data, "app");


    //function to change profile settings
    const collectSetting = () => {

        var form = _('collectSettingForm');
        var inputs = form.getElementsByTagName('input');

        for (var i = 0; i <= inputs.length - 1; ++i) {
            var key = inputs[i].name;
            switch (key) {
                case 'username':
                    data.username = inputs[i].value;

                    break;
                case 'status':
                    data.status = inputs[i].value;

                    break;
                case 'email':
                    data.email = inputs[i].value;

                    break;

                case 'gender':
                    if (inputs[i].checked) {
                        data.gender = inputs[i].value;
                    }


                    break;
                case 'password':
                    data.password = inputs[i].value;

                    break;


                default:
                    break;
            }

        }
        sendData(data, 'saveSettings');
      

    }

    //func to toggle password visibility
    const showPassword = () => {
        var input = _("password");
        if (input.type == "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }

    }

    //func to logout user
    const logout = () => {
        var logout = confirm('Are you sure you want to logout?')
        if (logout) {
            sendData(data, "logout");

        }

    }

    //function to get chat history
    const getChats = () => {
        sendData(data, "getChats");
    }

    //function to get  contacts
    const getContacts = () => {
        sendData(data, "getContacts");
    }

    //function to get settings
    const getSettings = () => {
        sendData(data, "getSettings");
    }

    //function to change profile pic
    const changeProfilePic = (files) => {
        var myform = new FormData();
        myform.append('file', files[0]);
        myform.append('type', 'changeProfilePic');

        var xml = new XMLHttpRequest();
        xml.onload = function() {
            if (xml.readyState == 4 || xml.status == 200) {
                handleFileResult(xml.responseText);
            }
        }
        xml.open('POST', 'files.php', true);
        xml.send(myform);

    }

    //func to handle file results
    const handleFileResult = (results) => {

        

        var fileInfo = JSON.parse(results);
        switch (fileInfo.dataType) {
            case 'updateProfile':
                sendData(data, "app");
                sendData(data, "getSettings");
                break;
            case 'sendGroupMessage':   
            case 'sendMessage':
                var messageHolder = _('messageHolder');
                messageHolder.innerHTML = fileInfo.message;
                messageHolder.scrollTo(0, messageHolder.scrollHeight);
                break;
        
            default:
                break;
        }
    }

    //func on hover pic
    const ondragoverPic = (e) => {
        e.preventDefault();
        e.target.className = 'onhover';


    }
    //func on dragleave
    const ondragleavePic = (e) => {
        e.target.className = 'changeProfileSetting';


    }

    //func ondrop
    const ondropPic = (e) => {
        e.preventDefault();
        changeProfilePic(e.dataTransfer.files);

    }

    //func to start chat
    const startChat = (e) => {
        CURRENT_CHAT_USER = e.target.id;
        if (CURRENT_CHAT_USER == "") {
            CURRENT_CHAT_USER = e.target.parentNode.id;
        }
        sendData({
            chatid: CURRENT_CHAT_USER
        }, "startChat");

    }




    //func to send message
    const sendMessage = () => {
        var input = _('InputMessageText');
        var text = (input.value).trim();

        if (text == '') {
            alert('you cant send an empty text');
        } else {
            sendInfo({
                chatid: CURRENT_CHAT_USER,
                message: text


            }, "sendMessage");
        }

    }
    
    //func to send message from delete
    const sendDeleteMessage = () => {
        
        var input = _('InputMessageText');
      
        
            sendInfo({
                chatid: CURRENT_CHAT_USER
                }, "showDeletedMessage");
        

    }


    //func to open modal to delete message
    const openDeleteModal = (e) => {
        var modal = _('modal');
        modal.style.display = 'flex';

     MESSAGE_ID = e.target.id;
     if ( MESSAGE_ID =="") {
        MESSAGE_ID = e.target.parentNode.id;
     }
    
     

    }

     //func to open modal to delete message
     const openGroupDeleteModal = (e) => {
        var modal = _('groupDeleteModal');
        modal.style.display = 'flex';

     MESSAGE_ID = e.target.id;
     if ( MESSAGE_ID =="") {
        MESSAGE_ID = e.target.parentNode.id;
     }
     

    }

    //func to delete message
    const deleteMessage = (e) => {

        var modal = _('modal');
        modal.style.display = 'none';


        sendInfo({
            chatid: CURRENT_CHAT_USER,
            messId:MESSAGE_ID
        }, "deleteText");
    }

    //func to delete group message
    const deleteGroupMessage = (e) => {

    var modal = _('modal');
    modal.style.display = 'none';

    sendData({
        groupId:gId,
        messId: MESSAGE_ID,
        
    }, "deleteGroupText");
    }

    //func to delete messagefor everyone
    const deleteForEveryone = () => {

        var modal = _('modal');
        modal.style.display = 'none';


        sendInfo({
            messId: MESSAGE_ID,
            chatid: CURRENT_CHAT_USER,
        }, "deleteEveryoneText");
    }

    //func to close modal
    const closeDeleteModal = () => {
        var modal = _('modal');
        modal.style.display = 'none';

    }

    //func to close groupmodal
    const closeGroupDeleteModal = () => {
    var modal = _('groupDeleteModal');
    modal.style.display = 'none';

    }

    //funct to start new group
    const newGroup = () => {

        var input=_('groupNameInput');
        var groupName=input.value;
        if (groupName!="") {
            sendData({groupname:groupName}, "newGroup");
        }
        
    }

    //func to add contact to group
    const addToGroup = (e) => {
       

        var modal=_('groupModal');
        modal.style.display='flex';

        var ADDED_TOGROUP_USER = e.target.id;
        if (ADDED_TOGROUP_USER == "") {
            ADDED_TOGROUP_USER = e.target.parentNode.id;
        }
        
        var isIn=GROUP_MEMBERS.includes(ADDED_TOGROUP_USER );
        if (!isIn) {
            GROUP_MEMBERS.push(ADDED_TOGROUP_USER );
            if ( modal.style.display='flex') {
            setTimeout(() => {
                modal.style.display='none';
            }, 500);
        }
        }else{
            modal.style.display='none';
        }

        

        
    }
     
    //func to write group to database
    const saveGroup=() => {
        if (GROUP_MEMBERS.length>0) {
            sendData( {
            members:GROUP_MEMBERS,
            groupname:GROUP_NAME
        },"saveGroup");
        }else{
            alert('select at least one contact to add to group');
        }
        
        
    }

    //func to choose groupname
    const groupName=() => {

           sendData(data, "groupName");
    }

    //func to send groupmessage
    const sendGroupMessage=()=>{
        var inputMessage=_('InputMessageText');
        var message=inputMessage.value;

        if (message=="") {
            
        }else{
            sendData({ message:message,
                groupId:gId,
                members:SEND_MESSAGE_MEMBERS,
                groupname:SEND_MESSAGE_NAME
            }, "sendGroupMessage");                                                                                                                                   
        }

        
    }

    //func to get groupschats
    const getgroups=()=>{
        sendData(data, "getGroupsChats"); 
    }

    //func to start group chat
    const startGroupChat=(e)=>{
      GROUPCHAT_ID=e.target.id;
        if (GROUPCHAT_ID=="") {
            GROUPCHAT_ID=e.target.parentNode.id;
        }
        sendData({groupid:GROUPCHAT_ID}, "startGroupChat"); 
    }

    //func to send message file
    const sendFile=(files) => {
       
        var myform = new FormData();
        myform.append('file', files[0]);
        myform.append('type', 'sendMessageFile'); 
        myform.append('chatid', CURRENT_CHAT_USER);

        var xml = new XMLHttpRequest();
        xml.onload = function() {
            if (xml.readyState == 4 || xml.status == 200) {
                handleFileResult(xml.responseText);
            }
        }
        xml.open('POST', 'files.php', true);
        xml.send(myform);

    }

    //func to send group message file
    const sendGroupFile=(files) => {
        
        var myform = new FormData();
        myform.append('file', files);
        myform.append('type', 'sendGroupMessageFile'); 
        myform.append('groupid', GROUPCHAT_ID);

        var xml = new XMLHttpRequest();
        xml.onload = function() {
            if (xml.readyState == 4 || xml.status == 200) {
                handleFileResult(xml.responseText);
            }
        }
        xml.open('POST', 'files.php', true);
        xml.send(myform);

    }

    //fuction to upload status
    const chooseStatus=()=>{
        
        sendData(data, "chooseStatus");
    }

    //func to upload status
    const uploadProfile=(files)=>{
        var myform = new FormData();
        for (let index = 0; index < array.length; index++) {
            const element = array[index];
            
        }
             myform.append('file', files[0]);
       
    
     

        var xml = new XMLHttpRequest();
        xml.onload = function() {
            if (xml.readyState == 4 || xml.status == 200) {
                handleFileResult(xml.responseText);
            }
        }
        xml.open('POST', 'status.php', true);
        xml.send(myform);
    
    }
    
    //fuction to change status
     const changeStatus=()=>{
         var statusInput=_('statusInput');
         var status=statusInput.value;
         if(status==""){
            
         }else{
              sendData({status:status}, "changeStatus");
        }
        
      
    }
    
      //fuction to change username
    const changeUsername=()=>{

         var usernameInput=_('usernameInput');
         var username=usernameInput.value;
         if(username==""){
             
         }else{
               sendData({username:username}, "changeUsername");
               
         }
        
      
    }
    
    //   //fuction to change email
    const changeEmail=()=>{
        var emailInput=_('emailInput');
        var email=emailInput.value;
        if(email==""){
            
        }else{
              sendData({email:email}, "changeEmail");
        }
        
      
    }
    
    //   //fuction to change password
    const changePassword=()=>{
        var changePassword=_('changePassword');
        var password=changePassword.value;
        if(password==""){
            
        }else{
              sendData({password:password}, "changePassword");
        }
        
      
    }


</script>