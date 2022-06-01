$(document).ready(function(){
    function checkOrderData()
    {
        //alert('Test!');

        //Data to send For Server side
        var userId = $("userId").val();
        var planId = $("planId").val();

        //Data for Check Client Side
        var cardNumber = $('#cardNumber').val();
        var cardOwner = $('#cardOwner').val();
        var year = $("#year").val();
        var month = $("#month").val();
        var cvv = $("#cvv").val();
        var errors = new Array();
        var print = "";

        if(month < 10)
        {
            month = "0"+month;
        }

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        var yy = yyyy.toString().slice(2);


        var regCardOwner = /^([a-zA-Z]{2,}(\s)?[a-zA-Z]{1,}'?-?[a-zA-Z]{2,}\s?([a-zA-Z]{1,})?)/

        if(!regCardOwner.test(cardOwner))
        {
            errors.push("Card Owner wasn't filled properly!");
        }
        if(cardNumber.length != 16 )
        {
            errors.push("Credit Card Number is invalid!");
        }
        if(year < yy)
        {
            errors.push("Your card is no longer valid. Pls Check the date on it");
        }
        if(year == yy && month < mm)
        {
            errors.push("Your card is no longer valid. Please Check the date on it");
        }

        if(cvv.length != 3)
        {
            errors.push("CVV cannot be longer or shorter than 3 numbers");
        }

        if(errors.length == 0)
        {
            var dataForSending = 
            {
                "userId" : userId,
                "planId" : planId,
                "submitOrder" : true
            }
            $.ajax({
                url: "models/submitOrder.php",
                    method: "post",
                    data: dataForSending,
                    dataType: "json",
                    success: function(data){
                        console.log(data);
                        $("#errorMsg").html(`<p class="alert alert-success">You've Successfully Purchased the Server</p>`);
                    },
                    error: function (xhr, statusText,error,response) {
                        //alert(error);
                        console.log(xhr.status+' '+statusText);
                        if(xhr.status == 422){
                            $("#errorMsg").html(`<p class="alert alert-warning">There has been an error processing your data.</p>`);
                        }
                        if(xhr.status == 500){
                            console.log(response+" "+error+" "+xhr);
                            alert("The Server appears to be broken!!");
                        }
                    }
            });
        }
        else
        {
            for(var i=0;i<errors.length; i++)
            {
                print += errors[i]+"<br>";
                $("#errorMsg").html(print);
            }
            $("#errorMsg").removeClass('hidden');
        }
        
    }

    $("#submitOrder").on('click', function(e)
    {
        e.preventDefault();
        checkOrderData();
    });
});
