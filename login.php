<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="./ui/icon/icon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./login.css">
</head>
<body>
	<section>
	<div class="leftContainer">
            <p>HEY</p>
    </div>
	<div class="rightContainer">
	<form id="myform">
     
	 <input type="text" name="email" placeholder="email" id="">
	 <input type="password" name="password"  placeholder="password"  id="password">
	 <div> 
	 <input type="checkbox" name="togglePassword" onclick="showPassword()"><span style="margin-left: 10px;">show password</span><br><br>
	 </div>
	
	 <input type="submit" value="Login" onclick="collectData()" id="loginButton">
	</form>
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

   	var loginButton = _("loginButton");

   	const collectData=()=>{

        loginButton.disabled = true;
        loginButton.value = "Loading...Please wait..";

   		var myform = _("myform");
   		var inputs = myform.getElementsByTagName("input");

   		var data = {};
   		for (var i=0;i<=inputs.length-1;++i) {

   			var key = inputs[i].name;

   			switch(key){

                case "email":
                    data.email = inputs[i].value;
                    break;    

   				
   				case "password":
   					data.password = inputs[i].value;
   					break;

   			}
   		}
   		sendData(data,"login");
   	}

   	const sendData=(data,type)=>{

   		var xml = new XMLHttpRequest();

   		xml.onload = function(){

   			if(xml.readyState == 4 || xml.status == 200){

                handleResult(xml.responseText);
                   loginButton.disabled = false;
                   loginButton.value = "Login";
   			}
   		}

		data.dataType = type;
		var data_string = JSON.stringify(data);

		xml.open("POST","routes.php",true);
		xml.send(data_string);
   	}

   	const handleResult=(results)=>{
		

   		var data = JSON.parse(results);
   		if(data.dataType == "login"){

   			window.location = "./index.php";
   		}else{

   			// var error = _("error");
   			// error.innerHTML = data.message;
   			// error.style.display = "block";
			   alert(data.message);
 
   		}
   	}

</script>