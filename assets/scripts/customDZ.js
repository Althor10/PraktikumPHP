$(document).ready(function(){

function loginAlert(){
    $("#hidden").removeAttr("id");
    var error = $(".errors");
    console.log(error[0]);
    errorText = "You need to be logged in before accessing other areas!";
    error[0].innerHTML = errorText;
}

//Obavestenje prilikom pokusavanja ulaska na druge delove sajta sa Login stranice

var navBarLimit = $(".nav-item");
for(var i=0;i<navBarLimit.length;i++){
    navBarLimit[i].addEventListener("click", loginAlert);
}

// Remove hidden f-ja
function removeHiddenErrors(){
    $("#hidden").removeAttr("id");
}

// On submit -> Skidanje hidden-a. **Regularni JS PROVERA!!
// Namesti da kada se prodje Serverski deo se lepo prikaze da ne postoji taj user.

function loginValidate(){
    var username = $("#username").value();
    var password = $("#password").value();
        console.log(console+" "+password);
}

$("#loginSubmit").on("click",function(){
    loginValidate();
});

// var sub = document.getElementById("loginSubmit");

// sub.addEventListener("click", removeHiddenErrors());

});