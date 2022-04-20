function loginAlert() //Funkcija pri pokusaju ulaska na druge delove sajta sa Login stranice
{
    errorText = "You need to be logged in before accessing other areas!";
    alert(errorText);
}

$(document).ready(function(){
    var navBarLimit = $(".nav-item");
    for(var i=0;i<navBarLimit.length;i++)
    {
        navBarLimit[i].addEventListener("click", loginAlert);
    }
})