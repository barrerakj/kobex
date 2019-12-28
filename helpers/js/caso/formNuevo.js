$(function(){
    
    $( "#txtNombre" ).keyup(function() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("txtNombre");
        filter = input.value.toUpperCase();
        table = document.getElementById("tablaColaboradores");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
            }
        }
      });
    
    function listado_clientes(){
        $.post(base_url + "cliente/listar",
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                let clients = result[1];
                let select_content = "";
                for (let i = 0; i < clients.length; i++) {
                    select_content += `<option value="`+ clients[i]["id"] +`">`+ clients[i]["name"] +` `+ clients[i]["lastname"] +`</option>`;
                    
                }
                $(".sltClientes").html(select_content);
                $(".sltClientes").chosen({
                    placeholder_text_multiple: "Listado de clientes",
                    no_results_text: "No hay resultados para"
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

    function listado_colaboradores(){
        $.post(base_url + "usuario/listar",
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                var users = result[1];
                var roles = [];
                //Get roles information
                $.post(base_url + "rol/listado",
                {
                    _token: token
                },
                function(data){
                    let result = JSON.parse(data);
                    if(result[0]){
                        roles = result[1];

                        let table_content = "";
                        for (let i = 0; i < users.length; i++) {
                            table_content += `
                                <tr>
                                    <td>`+ users[i]["name"] +` `+ users[i]["lastname"] +`</td>
                                    <td>`+ users[i]["phone"] +`</td>
                                    <td>`+ users[i]["email"] +`</td>
                                    <td>
                                        <select class="form-control usuario_roles">
                                            <option value="` + users[i]["id"] +`,0">Asigne un permiso a este usuario</option>`;
                                            for (let j = 0; j < roles.length; j++) {
                                                table_content += '<option value="'+ users[i]["id"] +','+ roles[j]['id'] +'">'+ roles[j]['name'] + ' - ' + roles[j]['description'] +'</option>'                                        
                                            }
                    table_content += ` </select>
                                    </td>
                                </tr>`;  
                        }
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

    $(".btnGuardar").on("click", function(){
        //Recopilar informacion general
        let nombre = $("#nombre").val();
        let descripcion = $("#descripcion").val();

        //Recopilar Id de clientes
        let clientes = $(".sltClientes").chosen().val();
        clientes = clientes.join();
        
        //Recopilar Id de usuario junto a Id de rol
        let usuariosRol = $('.usuario_roles').map(function() {
            return $(this).val().split(",");
        }).toArray();
        usuariosRol = usuariosRol.join();

        console.log(usuariosRol)

        //Guardar informacion general
        $.post(base_url + "caso/guardar/",
            {
                _nombre: nombre,
                _descripcion: descripcion,
                _token: token
            },
            function(data){
                let result = JSON.parse(data);
                if(result[0]){
                    let casoId = result[1];
                    //Guardar clientes asignados al caso

                    $.post(base_url + "caso-clientes/guardar",
                        {
                            _casoId: casoId,
                            _clientes: clientes,
                            _token: token
                        },
                        function(data) {
                            if(result[0]){
                                //Guardar usuarios y sus roles para el caso

                                $.post(base_url + "caso-usuarios/guardar",
                                    {
                                        _casoId: casoId,
                                        _usuariosRol: usuariosRol,
                                        _token: token
                                    },
                                    function(data) {
                                        console.log("callback")
                                        if(result[0]){
                                            console.log("respuesta true")
                                            $(".toast-body").html("El caso se ha guardado con éxito.");
                                            $(".toast").toast("show");
                                        } else {
                                            if(typeof result[1] == "undefined"){
                                                $(".toast-body").html("Se ha experimentado un error. Por favor contacte al administrador o intente de nuevo más tarde.");
                                                $(".toast").toast("show");
                                            } else {
                                                window.location.replace(result[1]);
                                            }
                                        }
                                    }
                                );

                            } else {
                                if(typeof result[1] == "undefined"){
                                    $(".toast-body").html("Se ha experimentado un error. Por favor contacte al administrador o intente de nuevo más tarde.");
                                    $(".toast").toast("show");
                                } else {
                                    window.location.replace(result[1]);
                                }
                            }
                        }
                    );
                } else {
                    if(typeof result[1] == "undefined"){
                        $(".toast-body").html("Se ha experimentado un error. Por favor contacte al administrador o intente de nuevo más tarde.");
                        $(".toast").toast("show");
                    } else {
                        window.location.replace(result[1]);
                    }
                }
            }
        );
    });

    listado_clientes();
    listado_colaboradores();

});