<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hey</title>
    <link rel="stylesheet" href="./index.css">
</head>

<body>

    <div id="modal">

            <span id="closeModal" onclick="closeDeleteModal()">&times</span>
            <button class="btn" onclick="deleteMessage()">Delete</button>
            <button class="btn" onclick="deleteForEveryone()">Delete for everyone</button>

       
    </div>
    <section>
        <div id="leftContainer">
            <div class="myPicStatus">
                <img id="myProfilePic">
                <div id="myStatus">

                </div>
            </div>
            <hr style="color: green;">
            <div class="nav">
                <input type="radio" name="chats" id="chatsRadio" style="display: none;">
                <input type="radio" name="contacts" id="contactsRadio" style="display: none;">
                <input type="radio" name="setings" id="settingsRadio" style="display: none;">
                <input type="radio" name="logout" id="logoutRadio" style="display: none;">
                <label for="chatsRadio" onclick="getChats()"> <span class="labelSpan">Chats</span> <img src="./ui/images/chat.png" style="float: right;" alt=""></label>
                <hr class="hr">
                <label for="contactsRadio" onclick="getContacts()"><span class="labelSpan">Contacts</span> <img style="float: right;" src="./ui/images/contacts.png" alt=""></label>
                <hr class="hr">
                <label for="settingsRadio" onclick="getSettings()"><span class="labelSpan">Settings</span> <img style="float: right;" src="./ui/images/settings.png" alt=""></label>
                <hr class="hr">
                <label for="logoutRadio" onclick="logout()"><span class="labelSpan">Logout</span> <img style="float: right;" src="./ui/images/logout.png" alt=""></label>
                <hr class="hr">
            </div>


        </div>
        <hr style="margin-top: -15px;">
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
    var MESSAGE_ID='';

    var rightContainer = _('rightContainer');

    var data = {};


    //func to sendData to server
    const sendData = (data, type) => {
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
        alert(results);

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

                status.innerHTML = info.message.status;


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

                break;
            case 'sendMessage':
                rightContainer.innerHTML = info.message;
                var messageHolder = _('messageHolder');


                messageHolder.scrollTo(0, messageHolder.scrollHeight);
                break;
            case 'deleteMessage':
                var messageHolder = _('messageHolder');
                messageHolder.innerHTML = info.message;

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
        alert(JSON.stringify(data));

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
        console.log('chats');
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

        // alert(results);

        var fileInfo = JSON.parse(results);
        if (fileInfo.dataType == 'updateProfile') {

            sendData(data, "app");
            sendData(data, "getSettings");

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
            sendData({
                chatid: CURRENT_CHAT_USER,
                message: text


            }, "sendMessage");
        }

    }
   

    //func to open modal to delete message
    const openDeleteModal=(e)=>{
        var modal=_('modal');
        modal.style.display='flex';

        MESSAGE_ID=e.target.id;

    }

     //func to delete message
     const deleteMessage = () => {

        var modal=_('modal');
        modal.style.display='none';


        sendData({
            messId: MESSAGE_ID,
            chatid: CURRENT_CHAT_USER,
        }, "deleteText");
    }

      //func to delete messagefor everyone
      const deleteForEveryone = () => {

        var modal=_('modal');
        modal.style.display='none';


        sendData({
            messId: MESSAGE_ID,
            chatid: CURRENT_CHAT_USER,
        }, "deleteEveryoneText");
    }

    //func to close modal
    const closeDeleteModal=() => {
        var modal=_('modal');
        modal.style.display='none';
        
    }
</script>