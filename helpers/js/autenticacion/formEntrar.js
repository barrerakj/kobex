$(function(){

    var base_url = "http://localhost/kobex-app/";

    function entrar(){
        let correo = $("#email").val();
        let pass = $("#pass").val();

        if(correo == '')
            alert("Porfavor ingrese su usuario.");
        else if(pass == '')
            alert("Porfavor ingrese su contraseña.");
        else {

            $.post(base_url + "aut/verificar",
            {
                email: correo,
                password: pass
            },
            function(data){
                let result = JSON.parse(data);
                if(result[1]){
                    document.cookie = "username="+result[0]+";path=/";
                    document.cookie = "token="+result[1]+";path=/";
                    window.location.replace(base_url + "inicio");
                } else {
                    alert("Valores erróneos. Intente de nuevo.")
                }
            });
        } 
    }

    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            entrar();
        }
    });

    $("#btnEntrar").on("click", function(){
        entrar();
    });    
  
});