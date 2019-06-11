$(function(){

    $("#btnAsociar").on("click", function(){
        let code = $("#code").val();
        $.post(base_url + "usuario/asociar/" + code,
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                $(".toast-body").html("Se ha asociado con el éxito al nuevo colaborador.");
                $(".toast").toast("show");
            } else {
                if(typeof result[1] == "undefined"){
                    $(".toast-body").html("Se ha experimentado un error. Por favor contacte al administrador o intente de nuevo más tarde.");
                    $(".toast").toast("show");
                } else {
                    window.location.replace(result[1]);
                }
            }
        });
    });
});