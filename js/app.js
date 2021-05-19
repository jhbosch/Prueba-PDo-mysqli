$(document).ready(function(){

    $('form#formLogin').on('submit',function(e){
        e.preventDefault();
        let username = $("#username").val();
        let password = $("#password").val();
        $.ajax({
            url:'index.php',
            data:{action:'login',username,password},
            method:'post',
            success:function(resp){
                var json = JSON.parse(resp);
                if(json.status === "FAILS"){
                    alert("Credenciales invalidas.")
                }else{
                    window.location = "index.php";
                }
            },
            error:function(err){
                console.log(err)
                alert("Upss ha ocurrido un error.");
            }
        })
    })

});