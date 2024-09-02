const registerButton = document.getElementById('register')
const loginButton = document.getElementById('login')

displayRegisterForm = () =>{
    document.getElementsByClassName('login-section')[0].style.display = "none";
    document.getElementsByClassName('register-section')[0].style.display = "flex";
}
displayLoginForm = () =>{
    document.getElementsByClassName('login-section')[0].style.display = "flex";
    document.getElementsByClassName('register-section')[0].style.display = "none";
}

registerButton.addEventListener('click', displayRegisterForm)
loginButton.addEventListener('click', displayLoginForm)
