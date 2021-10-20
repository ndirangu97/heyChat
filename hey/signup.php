<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="./ui/icon/icon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="./signup.css">
</head>
<body>
	<section>
        <div class="leftContainer">
            <p>HEY</p>
        </div>
        <div class="rightContainer">
            <form id="myform">
                <input type="text" name="firstname"  placeholder="firstname" id="">
                <input type="text" name="lastname"  placeholder="lastname"  id="">
                <input type="text" name="username" placeholder="username"  id="">
                <input type="text" name="email" placeholder="email" id="">
               <span style="margin-bottom: 7px;transform: translateX(-8px);"> Gender</span>
                <div>
                    <div>
                        <input type="radio" name="gender" value="male" id="male">
                        <label for="male">Male</label>
                    </div>
                    <div>
                    <input type="radio" name="gender" value="female" id="female">
                    <label for="female">Female</label>
                    </div>
                    <div>
                    <input type="radio" name="gender" value="other" id="other">
                    <label for="other">Other</label>
                    </div>
                </div>
                
                <input type="password" name="password"  placeholder="password"  id="password">
				<div> 
					<input type="checkbox" name="togglePassword" onclick="showPassword()"><span style="margin-left: 10px;">show password</span><br><br>
				</div>
                <input type="submit" value="Signup" onclick="collectData()" id="signupButton">
            </form>
            <div class="errorDiv">

            </div>
        </div>
    </section>
    
    
</body>
</html>

<script type="text/javascript">

	function _(element){

		return document.getElementById(element);
	}

	//func to toggle password visibility
	const showPassword=()=>{
		var input=_("password");
		if (input.type=="password") {
			input.type="text";
		}else{
			input.type="password";
		}

	}

   	var signup_button = _("signupButton");

   	const collectData=()=>{

   		signup_button.disabled = true;
   		signup_button.value = "Loading...Please wait..";

   		var myform = _("myform");
   		var inputs = myform.getElementsByTagName("input");

   		var data = {};
   		for (var i=0;i<=inputs.length-1;++i) {

   			var key = inputs[i].name;

   			switch(key){

   				case "firstname":
   					data.firstname = inputs[i].value;
   					break;

   				case "lastname":
   					data.lastname = inputs[i].value;
   					break;
                 
                case "username":
                    data.username = inputs[i].value;
                    break; 

                case "email":
                    data.email = inputs[i].value;
                    break;    

   				case "gender":
   					if(inputs[i].checked){
   						data.gender = inputs[i].value;
   					}
   					break;

   				case "password":
   					data.password = inputs[i].value;
   					break;

   			}
   		}
   		sendData(data,"signup");
   	}

   	const sendData=(data,type)=>{

   		var xml = new XMLHttpRequest();

   		xml.onload = function(){

   			if(xml.readyState == 4 || xml.status == 200){

				handleResult(xml.responseText);
   				signup_button.disabled = false;
   				signup_button.value = "Signup";
   			}
   		}

		data.dataType = type;
		var data_string = JSON.stringify(data);

		xml.open("POST","routes.php",true);
		xml.send(data_string);
   	}

   	const handleResult=(results)=>{
	
   		var data = JSON.parse(results);
   		if(data.dataType == "signup"){

   			window.location = "./login.php";
   		}else{

   			// var error = _("error");
   			// error.innerHTML = data.message;
   			// error.style.display = "block";
			   alert(data.message);
 
   		}
   	}

</script>