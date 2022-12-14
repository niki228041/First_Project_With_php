

var current_user;

var imgToUploadImg = document.getElementById("selectUploadImage");


const name = document.getElementById("name").value;
const surname = document.getElementById("surname").value;
const email = document.getElementById("email").value;
const phone = document.getElementById("phone").value;
const land = document.getElementById("land").value;
const password = document.getElementById("password").value;
const repeat_password = document.getElementById("repeat_password").value;


function handleReg() {



    console.log("aaaaaaa");
    validateInput();

    const user={
        name:name,
        surname:surname,
        email:email,
        phone:phone,
        land:land,
        password:password,
        repeat_password:repeat_password,
        //photo:photo
    }

    current_user = user;

    console.log(user);
}

function setError(element,message){
    const inputControl= element.parentElement;
    const errorDisplay= inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success');
}

function setSucces(element){
    const inputControl= element.parentElement;
    const errorDisplay= inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
}


function validateInput(){

    console.log("dsa")
    const nameValue = name.trim();
    //const surnameValue = surname.trim();
    //const emailValue = email.trim();
    //const phoneValue = phone.trim();
    //const landValue = land.trim();
    //const passwordValue = password.trim();
    //const repeat_passwordValue = repeat_password.trim();

    if (nameValue === '')
    {
        setError(name,'Username is required');
    } else{
        setSucces(name);
    }
}

function getCurrentUser() {
    console.log("dsa");

    console.log(current_user);
    console.log("dsa");

}