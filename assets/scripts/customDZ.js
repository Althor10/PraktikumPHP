// Remove hidden f-ja.
function removeHiddenErrors()
{
    $("#hidden").removeAttr("id");
}

$(document).ready(function()
{


    //Validacija Registracije funkcija i logika.
    function registerValidate()
    {
        //Promenjive.
        var username = $("#username").val();
        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var confirm = $("#confirmPassword").val();
        var errors = new Array();

        //Regularni Izrazi.
        var regUsername = /^[A-Za-z][A-Za-z0-9]{5,31}$/;
        var regPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$^+=!*()@%&_-]).{8,}$/;
        var regFirstName = /^([a-zA-Z]{2,}(\s)?[a-zA-Z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)/;
        var regLastName = /^([a-zA-Z]{2,}(\s)?[a-zA-Z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)/;
        var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        if(!regUsername.test(username))
        {
            errors.push("Username is a wrong format");
        }
        if(!regPassword.test(password))
        {
            errors.push("Password needs to be at least 8 characters long and at least 1 special character.");
        }
        if(!regPassword.test(confirm) && password != confirm)
        {
            errors.push("The passwords need to match!");
        }
        if(!regFirstName.test(firstName))
        {
            errors.push("First Name is in wrong format");
        }
        if (!regLastName.test(lastName))
        {
            errors.push("Last Name is in wrong format!");
        }
        if(!regEmail.test(email))
        {
            errors.push("Email is in the wrong format. You need to have a valid email!");
        }

        if(errors.length == 0)
        {
            //Ajax response
          
                var dataForSending = {
                    "firstName": firstName,
                    "lastName": lastName,
                    "username": username,
                    "password": password,
                    "email": email,
                    "regSubmit" : true
                };
    
                $.ajax({
                    url: "models/register.php",
                    method: "post",
                    data: dataForSending,
                    dataType: "json",
                    success: function(data){
                        console.log(data);
                        $("#errorMsg").html(`<p class="alert alert-success">You've been Successfully Added</p>`);
                        alert("Success!");
                    },
                    error: function (xhr, statusText,error) {
                        alert(error);
                        console.log(xhr.status+' '+statusText);
                        if(xhr.status == 422){
                            $("#errorMsg").html(`<p class="alert alert-warning">There has been an error processing your data.</p>`);
                            alert("Im here bish!");
                        }
                        if(xhr.status == 500){
                            alert("Aw, Shit cuz!!");
                        }
                    }
                });
            

        }else
        {
            console.log(errors);
        }
    }

    //Validacija registracije on Click.
    $("#regSubmit").on("click",function(e){
        e.preventDefault();
        registerValidate();
    });


});