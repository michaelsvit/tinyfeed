//Imported from http://keithscode.com/tutorials/javascript/3-a-simple-javascript-password-validator.html
function checkPass()
{
	//Store password fields objects
	var pass1 = document.getElementById('password');
	var pass2 = document.getElementById('password_confirm');
	
	//Store confirmation message object
	var message = document.getElementById('confirmMessage');
	
	//Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
	
	//If both fields are not empty
	if(pass1.value != "" && pass2.value != "")
	{
		//Compare the values in the password field 
		//and the confirmation field
		if(pass1.value == pass2.value)
		{
			//The passwords match. 
			//Set the color to the good color and inform
			//the user that they have entered the correct password 
			pass2.style.backgroundColor = goodColor;
			message.style.color = goodColor;
			message.innerHTML = "Passwords Match!"
		}
		else
		{
			//The passwords do not match.
			//Set the color to the bad color and
			//notify the user.
			pass2.style.backgroundColor = badColor;
			message.style.color = badColor;
			message.innerHTML = "Passwords Do Not Match!"
		}
	}
}

function checkPassSubmit()
{
	//Store passwords
	var pass1 = document.getElementById('password').value;
	var pass2 = document.getElementById('password_confirm').value;
	
	if(pass1 == pass2)
	{
		return true;
	}
	else
	{
		return false;
	}
}