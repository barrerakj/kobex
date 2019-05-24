$(function(){

    $.post(base_url + "doc/obtener",
    {
        _token: token
    },
    function(data){
        let result = JSON.parse(data);
        if(result[0]){
            let cliente = result[1][0];
            let documento = result[2][0];
            let version = result[3][0];

            $(".infoClienteDocumento").html(`
                    <h5>Cliente: `+ cliente['name'] +` `+ cliente['lastname'] +`</h5>
                    <h5>Documento: `+ documento['name'] +`</h5>
            `);

            let table_content = `
                <tr>
                <th scope="row">`+ version['id'] +`</th>
                <td>`+ version['name'] +` `+ version['lastname']+`</td>
                <td>`+ version['created_at'] +`</td>
                <td>`+ version['description'] +`</td>
                </tr>
            `;

            $(".tbody").html(table_content);

        } else {
            if(typeof result[1] == "undefined"){
                $(".toast-body").html("Se ha experimentado un error. Por favor contacte al administrador o intente de nuevo más tarde.");
                $(".toast").toast("show");
            } else {
                window.location.replace(result[1]);
            }
        }

    });

    $(".btnActualizar").on("click", function(){
        let descripcion = $("#descripcion").val();
        let formData = new FormData();

        if( document.getElementById("archivo").files.length == 0 ){
            alert("Porfavor seleccione un archivo.");
        } else {
            formData.append('files[]', document.getElementById('archivo').files[0]);

            $.post(base_url + "doc/actualizar_version",
            {
                _descripcion: descripcion,
                _token: token
            },
            function(data){
                let result = JSON.parse(data);
                if(result[0]){
                    fetch(base_url + "doc/archivo", {
                        method: 'POST',
                        body: formData
                    }).then((res) => { return res.json() })
                    .then(function (data) {
                        let result2 = data;
                        if(result2[0]){
                            window.location.replace(base_url + "/doc/detalle/" + result2[1]);
                        } else {
                            $(".toast-body").html(result2[1]);
                            $(".toast").toast("show");
                        }
                    });
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
    });
});