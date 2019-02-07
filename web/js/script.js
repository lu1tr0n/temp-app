$(document).ready(function() {
    
    $("body").on("click", "#btnSubmit", function(e) {
        e.preventDefault();
        /**
         * Get Variables
         */
        var username = $("#inputEmail").val();
        var password = $("#inputPassword").val();

        if (username != "" && password != "") {
            $("#formLogin").submit();
        } else {
            
            /*$(".myAlert-top").show();
            setTimeout(function(){
              $(".myAlert-top").hide(); 
            }, 2000);*/

            $(".myAlert-bottom").show();
            setTimeout(function(){
              $(".myAlert-bottom").hide(); 
            }, 2000);
        }
        
        /*var url = 'http://localhost:9000/api/profile';
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(json) {
                alert("Success", json);
                console.log(json);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
               alert(textStatus, errorThrown);
            },
            //headers: {'Authorization': 'Basic bWFkaHNvbWUxMjM='},
            headers: {
                'Authorization': 'Basic ' + btoa(username + ":" + password)
            }
        });*/
    });
    
    /* setTimeout(function() {
        $(".message-alert").fadeOut(1500);
    },3000); */

});