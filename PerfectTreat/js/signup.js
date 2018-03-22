function checkUser(){
    var user = $('#username').val();
    if (user.length >= 5) {
        $.post('../php/signup.php',{validateuser:"yes",username:$('#username').val()})
            .done(function(data){
                if (data.trim() == "success") {
                    $('#errorUsername').html('Username Already exists !');
                    $('#signupbtn').attr('disabled','');
                }
                else{
                    $('#errorUsername').html('');
                    $('#signupbtn').removeAttr('disabled');
                }
            })
    }
    else {
        $('#errorUsername').html('Username Length is Too Short !');
        $('#signupbtn').attr('disabled','');
    }
}

function validateEmail(email) {
    console.log(email);
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(!re.test(email)) {
        document.getElementById('errorEmail').innerHTML = " Invalid Email";
        document.getElementById('signupbtn').setAttribute('disabled','');
    }
    else {
        document.getElementById('errorEmail').innerHTML = "";
        document.getElementById('signupbtn').removeAttribute('disabled');
    }
}

function validateMobile() {
    var mobile = document.getElementById('mobile').value;
    if (!isNaN(mobile)) {
        if (parseInt(mobile.length) !== 10) {
            document.getElementById('errorMobile').innerHTML = "Mobile number Length should be equal to 10";
            document.getElementById('signupbtn').setAttribute('disabled','');
        }
        else {
            document.getElementById('errorMobile').innerHTML = " ";
            document.getElementById('signupbtn').removeAttribute('disabled');
        }
    }
    else {
        document.getElementById('errorMobile').innerHTML = " Should be a Number";
        document.getElementById('signupbtn').setAttribute('disabled','');
    }
}

function validatePassword() {
    var pass = document.getElementById('password').value;
    if (pass.length <= 8) {
        document.getElementById('errorPassword').innerHTML = " Password length too short !";
        document.getElementById('signupbtn').setAttribute('disabled','');
    }
    else{
        document.getElementById('errorPassword').innerHTML = " ";
        document.getElementById('signupbtn').removeAttribute('disabled');
    }
}

function validateRepeatPassword() {
    var pass1 = document.getElementById('password').value;
    var pass2 = document.getElementById('repeatpassword').value;
    if (pass1 != pass2) {
        document.getElementById('errorRepeatPassword').innerHTML = " Passwords Don't Match !";
        document.getElementById('signupbtn').setAttribute('disabled','');
    }
    else {
        document.getElementById('errorRepeatPassword').innerHTML = " ";
        document.getElementById('signupbtn').removeAttribute('disabled');
    }
}