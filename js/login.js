window.onload = function()
{
	var loginTab = document.getElementById('login');
	var signTab = document.getElementById('signUp');
	loginTab.style.display = 'block';
	signTab.style.display = 'none';

}

function changestuff()
{
	var loginTab = document.getElementById('login');
	var signTab = document.getElementById('signUp');
	if(loginTab.style.display == 'block')
	{
		loginTab.style.display = 'none';
		signTab.style.display = 'block';
		document.title = 'Sign Up Page';
	}
	else 
	{
		loginTab.style.display = 'block';
		signTab.style.display = 'none';
		document.title = 'Login Page';
	}
}