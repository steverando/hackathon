$(document).ready(function(){
   $("#create").click(function(){

        $("#create").html('<i class="fas fa-circle-notch fa-spin"></i>');
        $("#create").attr("disabled",1);

        // the data
        var username = $("#username").val();
        var phone    = $("#phone").val();
        var password = $("#password").val();

        $.post("create.php",
        {
            username:username,
            phone:phone,
            password:password
        },
        function(response){
            $("#info").html(response);
            $("#po").slideDown(1000).html('<i style="font-size:50px; color:green;" class="fas fa-check-circle"></i>');
            $("#create").html('Create Account');
            $("#create").attr("disabled","false");
        });
   });
});