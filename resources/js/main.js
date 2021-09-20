var eye_slash = document.getElementById('show');
var eye = document.getElementById('hide');
var password = document.getElementById('password');

function show(){
    eye_slash.style.display = "none";
    eye.style.display = "inline";
    password.type = "text";
}
function hide(){
    eye_slash.style.display = "inline";
    eye.style.display = "none";
    password.type = "password";
}