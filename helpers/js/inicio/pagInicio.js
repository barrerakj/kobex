$(function(){
    $.post(base_url + "doc/versiones",
    {
        _token: token
    },
    function(data){
        let result = JSON.parse(data);
        if(result[0]){
            versiones = result[1].slice(0,3);
            for (let i = 0; i < versiones.length; i++) {
                $.post(base_url + "doc/obtener/" + versiones[i]["documents_id"],
                {
                    _token: token
                },
                function(data){
                    let result1 = JSON.parse(data);
                    if(result1[0]){
                       let cliente = result1[1];
                       let documento = result1[2];

                       tarjetas = `
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                <h5 class="card-title">`+ documento[0]["name"] +`</h5>
                                <h6 class="card-subtitle mb-2 text-muted">`+ cliente[0]["name"] + ` ` + cliente[0]["lastname"] +`</h6>
                                <p class="card-text">`+ versiones[i]["description"] +`</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                    <a href="`+ base_url + `doc/detalle/`+ documento[0]["id"] +`" class="btn btn-sm btn-outline-secondary">Ver</a>
                                    <a href="`+ base_url + `doc/actualizar/`+ documento[0]["id"] +`" class="btn btn-sm btn-outline-secondary">Actualizar</a>
                                    </div>
                                    <small class="text-muted">`+ versiones[i]["created_at"] +`</small>
                                </div>
                                </div>
                            </div>
                        </div>`;

                        $(".tarjetas").append(tarjetas);
                        
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