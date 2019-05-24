$(function(){
    
    var documentos = '';

    function listar_documentos(){
        $.post(base_url + "doc/listar/2",
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                documentos = result[1];
                let accordion_content = "";

                for (let i = 0; i < documentos.length; i++) {
                    accordion_content += `
                    <div class="card">
                        <div class="card-header" id="heading`+ i +`" data-toggle="collapse" data-target="#collapse`+ i +`" aria-expanded="false" aria-controls="collapse`+ i +`">
                            `+ documentos[i][0]['name']+ ` ` + documentos[i][0]['lastname'] +`
                        </div>
                        <div id="collapse`+ i +`" class="collapse" aria-labelledby="heading`+ i +`">
                            <div class="card-body" style="padding: 0;">
                                <ul class="list-group">`;
                                    for (let j = 0; j < documentos[i][1].length; j++) {
                                        accordion_content += `
                                            <li class="list-group-item">
                                                <div class="row" style="margin-right: 0px;">
                                                    <div class="col-7">
                                                        `+ documentos[i][1][j]['name'] +`
                                                    </div>
                                                    <div class="col-5">
                                                        <button class="btn btn-outline-secondary btn-sm btnPrevia" value="`+ documentos[i][1][j]['id'] +`">Previa</button>
                                                        <a href="`+ base_url + `doc/detalle/` + documentos[i][1][j]['id'] +`" class="btn btn-outline-secondary btn-sm">Detalle</a>
                                                    </div>
                                                </div>                                   
                                            </li>
                                        `;                             
                                    }
                                    accordion_content += `                                                                        
                                </ul>
                            </div>
                        </div>
                    </div>
                    `;  
                }

                if(accordion_content == "")
                    accordion_content = 'Por el momento no tiene documentos archivados. Si ha terminado de trabajar con el documento de un cliente, recuerde presionar el boton "Marcar como finalizado".';

                $(".accordion").html(accordion_content);
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

    $(".accordion").on("click", ".btnPrevia", function(){
        let id = $(this).val();
        
        let nombre = "";
        for (let i = 0; i < documentos.length; i++) {
            for(let j = 0; j < documentos[i][1].length; j++)
                if(documentos[i][1][j]['id'] == id){
                    nombre = documentos[i][1][j]["name"];
                }
        }

        $.post(base_url + "doc/ultVersion/" + id,
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                let version = result[1];
                let ruta_absoluta = base_url + version['path'];

                console.log(ruta_absoluta);

                $(".DocView").html('');

                $(".DocView").html(`
                    <p>` + nombre + `</p>
                    <iframe style="width: 100%; height: 700px;" src='https://view.officeapps.live.com/op/embed.aspx?src=`+ ruta_absoluta +`' width='1366px' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>
                    <br><br>
                    <a href="` + ruta_absoluta + `" target=_blank class="btn btn-outline-secondary">Descargar Documento</a>
                    <br><br>
                `);

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

    listar_documentos();

});