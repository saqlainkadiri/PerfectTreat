function checkAdmin(){
    var admin = $('#adminname').val();
    if (admin.length >= 5) {
        $.post('../php/perfect_adminsignup.php',{validateadmin:"yes",adminname:$('#adminname').val()})
            .done(function(data){
                if (data.trim() == "success") {
                    $('#errorAdminname').html('Adminname Already exists !');
                    $('#signupbtn').attr('disabled','');
                }
                else{
                    $('#errorAdminname').html('');
                    $('#signupbtn').removeAttr('disabled');
                }
            })
    }
    else {
        $('#errorAdminname').html('Adminname Length is Too Short !');
        $('#signupbtn').attr('disabled','');
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