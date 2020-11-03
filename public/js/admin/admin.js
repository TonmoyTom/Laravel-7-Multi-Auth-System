$(document).ready(function(){
    $(document).on('keyup', '#old_password', function(){
         var old_password = $("#old_password").val();
        $.ajax({
            type: 'post',
            url: '/admin/update-password',
            data:{old_password:old_password,},
            success:function(resp){
               if(resp == "false"){
                   $("#chkoldpwd").html("<font  > Current Password is InCorrect </font>").css({"color": "red"});
               }else if(resp =="true"){
                    $("#chkoldpwd").html("<font  > Current Password is Correct</font>").css({"color": "green"});
               }
            },error:function(){
                alert("eroor");
            }
        });


    });
});




