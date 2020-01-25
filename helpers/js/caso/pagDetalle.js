$(function(){

    function listado_casos(){
        $.post(base_url + "casos/listar-activos",
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                let caso = result[1];
            } else {
                if(typeof result[1] == "undefined"){
                    $(".toast-body").html("Se ha experimentado un error. Por favor contacte al administrador o intente de nuevo más tarde.");
                    $(".toast").toast("show");
                } else {
                    window.location.replace(result[1]);
                }
            }
        });
    }

    listado_casos();

});