function crearDataTable(nombreTabla) {
	let tabla = $(nombreTabla).DataTable({
		"responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        "columns":[
            {"data":"nombre_completo"},
            {"data":"correo"},
            {"data":"rol"},
            {"data":"id",
             "render":function(data,type,row){
                 var id = data;										
                 return '<div class="btn-group">'+
                 '<button id="btnVisualizar" name="'+id+'" class="btn btn-outline-primary btn-sm ml-1" data-toggle="tooltip" data-placement="top" title="Visualizar" onclick="visualizarUsuario('+id+')"> <i class="far fa-eye"></i></button>' +
                 '<button id="btnEditar" name="'+id+'" class="btn btn-outline-warning btn-sm ml-1" data-toggle="tooltip" data-placement="top" title="Editar" onclick="editarUsuario('+id+')"><i class="far fa-edit"></i></button>' +
                 '<button id="btnEliminar" name="'+id+'" class="btn btn-outline-danger btn-sm ml-1" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick="eliminarUsuario('+id+')"> <i class="far fa-trash-alt"></i></button>'
                 +'</div>';
             }
            }
        ],
        "language": {
            "decimal": "",
            "emptyTable": "No existe ningún registro en la tabla.",
            "info": "Registros del _START_ al _END_ (_TOTAL_ registros totales)",
            "infoEmpty": "Registros del 0 al 0 (0 registros totales)",
            "infoFiltered": "(Filtro de _MAX_ registros totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontró ningún resultado.",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        "lengthChange": true,					//Habilitar o deshabilitar la lista desplegable para seleccionar la cantidad de registros mostrador por página
        "lengthMenu": [5, 10, 15, 20, 25],	//Definir los valores que aparederán en la lista desplegable para seleccionar la cantidad de registros mostrador por página
        "searching": true,						//Habilitar o deshabilitar la búsqueda en la tabla
        "ordering": true,						//Habilitar o deshabilitar el ordenamiento de columnas en la tabla
        "order": [[ 1, 'asc' ]],				//Definir el tipo de ordenamiento por default en cada una de las columnas de la tabla
        "columnDefs": [{						//Habilitar o deshabilitar el ordenamiento y filtrado en columnas específicas de la tabla
	    	"targets": [3],					//Define la columna o columnas afectadas "NC", "[C1, C2, ..., CN"], "_all", ".nombre-clase"
	    	"searchable": false,					//Habilitar o deshabilitar la búsqueda en la columna o columnas
	    	"orderable": false					//Habilitar o deshabilitar el ordenamiento en la columna o columnas
	    }],
        "pageLength": 5,						//Definir el número que registros que mostrarán de manera inicial en cada página
        "info": true,							//Habilitar y deshabilitar del información referente al número de registros mostrador por página
        "pagingType": "simple_numbers"			//"numbers" "simple_numbers" "full_numbers" "first_last_numbers" 
		
	});
   
    return tabla;
}

function mostrarTablaUsuarios(tablaUsuarios) {
    tablaUsuarios.ajax.url("../controladores/ctrl_usuarios.php?opcion=5");
    tablaUsuarios.ajax.reload();
}

function limpiaCamposDatosRegistro(){
    $("#frmNuevoUsuario")[0].reset();
}

function limpiaCamposDatosRegistroEditar(){
    $("#frmEditarUsuario")[0].reset();
}

function limpiaCamposDatosRegistroVisualizar(){
    $("#frmVisualizarUsuario")[0].reset();
}

function validaCamposUsuario(){
    
    let faltaCampo=0;
    let mensaje = "Todos los campos son obligatorios!"
    //Obtener los valores de los campos
    let txtNombre = $("#txtNombre").val();
    let txtApellido_pat = $("#txtApellido_pat").val();
    let txtApellido_mat = $("#txtApellido_mat").val();
    let txtCorreo = $("#txtCorreo").val();
    let txtContrasena = $("#txtContrasena").val();

    if(txtNombre == ""){
        faltaCampo = 1;			
    }
    if(txtApellido_pat == ""){
        faltaCampo = 1;			
    }
    if(txtApellido_mat == ""){
        faltaCampo = 1;			
    }
    if(txtCorreo == ""){
        faltaCampo = 1;			
    }
    if(txtContrasena == ""){
        faltaCampo = 1;			
    }

    if(faltaCampo==1){
        Swal.fire({
            title: "¡Faltan campos!",//Avisa duplicidad
            text: "Todos los campos son obligatorios.",
            confirmButtonColor: '#FFC107',
            icon: "warning",
            dangerMode: true
        });
        return false;
    }else{
        return true;
    }    
}

function validaCamposEditarUsuario(){
    
    let faltaCampo=0;
    let mensaje = "Todos los campos son obligatorios!"
    //Obtener los valores de los campos
    let txtNombre = $("#txtNombreE").val();
    let txtApellido_pat = $("#txtApellido_patE").val();
    let txtApellido_mat = $("#txtApellido_matE").val();
    let txtCorreo = $("#txtCorreoE").val();
    //let txtContrasena = $("#txtContrasenaE").val();

    if(txtNombre == ""){
        faltaCampo = 1;			
    }
    if(txtApellido_pat == ""){
        faltaCampo = 1;			
    }
    if(txtApellido_mat == ""){
        faltaCampo = 1;			
    }
    if(txtCorreo == ""){
        faltaCampo = 1;			
    }
    /*if(txtContrasena == ""){
        faltaCampo = 1;			
    }*/

    if(faltaCampo==1){
        Swal.fire({
            title: "¡Faltan campos!",//Avisa duplicidad
            text: "Todos los campos son obligatorios.",
            icon: "warning",
            dangerMode: true
        });
        return false;
    }else{
        return true;
    }    
} 

function guardaUsuario(){
    //Obtener los datos del formulario
    let formData = new FormData(document.getElementById("frmNuevoUsuario"));
    
    //Uso de ajax para enviar el formulario y procesar los datos
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "../controladores/ctrl_usuarios.php?opcion=1",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
           
            if(data['success']==1){
                Swal.fire({
                    title:'¡Éxito!',
                    text:data['message'],
                    icon:'success'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Cerrar el modal
                        $('#registrarUsuario').modal('hide');
                    }
                });
                //Limpiar los campos de la ventana modal
                limpiaCamposDatosRegistro();

            }//Fin if data success
            else{
                Swal.fire({
                    title: "¡Error!",//Avisa duplicidad
                    text: data['message'],
                    icon: "warning",
                    dangerMode: true
                });
            }
        } //Fin success						
    }); //Fin ajax		
}

function editarUsuario(id){
    //Traer datos del usuario
    $.ajax({
        type: "POST",
        data: "id=" + id,
        url: "../controladores/ctrl_usuarios.php?opcion=4",
        success:function(respuesta){
            datos = JSON.parse(respuesta);
            //Mostrar datos en el formulario de edicion
            $('#txtIdE').val(datos[0]['id']);
            $('#txtNombreE').val(datos[0]['nombre']);
            $('#txtApellido_patE').val(datos[0]['apellido_pat']);
            $('#txtApellido_matE').val(datos[0]['apellido_mat']);
            $('#txtCorreoE').val(datos[0]['correo']);
            $('#selRolE').val(datos[0]['id_rol'])
        }
    });

    $('#editarUsuario').modal({"backdrop"  : "static"});
}

function visualizarUsuario(id){
    //Traer datos del usuario
    $.ajax({
        type: "POST",
        data: "id=" + id,
        url: "../controladores/ctrl_usuarios.php?opcion=4",
        success:function(respuesta){
            datos = JSON.parse(respuesta);
            //Mostrar datos en el formulario de visualización
            $('#txtNombreV').val(datos[0]['nombre']);
            $('#txtApellido_patV').val(datos[0]['apellido_pat']);
            $('#txtApellido_matV').val(datos[0]['apellido_mat']);
            $('#txtCorreoV').val(datos[0]['correo']);
            $('#selRolV').val(datos[0]['id_rol'])
        }
    });

    $('#visualizarUsuario').modal({"backdrop"  : "static"});
}

function modificaUsuario(id){
    //Obtener los datos del formulario
    let formData = new FormData(document.getElementById("frmEditarUsuario"));
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "../controladores/ctrl_usuarios.php?opcion=3&id="+id,
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success:function(data){
            
            if(data['success']==1){
                Swal.fire({
                    title:'¡Éxito!',
                    text:data['message'],
                    icon:'success'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Cerrar el modal
                        $('#editarUsuario').modal('hide');
                    }
                });
                //Limpiar los campos de la ventana modal
                limpiaCamposDatosRegistroEditar();
                
            }
            else{
                Swal.fire({
                    title: "Error!",
                    text: data['message'],
                    icon: "warning",
                    dangerMode: true
                });
            }
        
        }
    });
	
}

function eliminarUsuario(id){
    Swal.fire({
        title:'¿Estás seguro de eliminar el registro?',
        text:'¡Esta acción no se puede revertir!',
        icon:'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#dc3545',
        cancelButtonText: 'Cancelar',
        confirmButtonText: '¡Si, eliminar!',
        reverseButtons: true,
        customClass: {
            confirmButton: 'confirm-button-class',
            cancelButton: 'cancel-button-class'
        }
    }).then((result) => {
        if (result.isConfirmed){
            $.ajax({
                type: "POST",
                dataType: "json",
                url:"../controladores/ctrl_usuarios.php?opcion=2&id="+id,
                async: false,
                cache: false,
                success: function(data){
                    if(data['success']==1){
                        Swal.fire({
                            title:'¡Éxito!',
                            text: data['message'],
                            icon:'success'
                        });
                        //Recargar la tabla de usuarios
                        tablaUsuariosAlias.ajax.reload();
                    }else{
                        Swal.fire({
                            title:'¡Error!',
                            text: data['message'],
                            icon:'warning',
                            dangerMode:true
                        });
                    }
                }
            });
        }
    });  
}

//Alias para la dataTables tablaUsuarios, como variable global
let tablaUsuariosAlias;

//Método ready del objeto document. Se ejecuta cuando se carga completamente la página
$(document).ready(function() {

    
    let tablaUsuarios = crearDataTable("#tablaUsuarios");

    tablaUsuariosAlias = tablaUsuarios;

    //Referenciar el alias a la dataTable tablaUsuarios para que pueda
    //ser usado desde cualquier parte del código

    mostrarTablaUsuarios(tablaUsuarios);

    //Asociar el evento onclick del elemento btnNuevoRegistro con la apertura
    //del formulario modal
    $('#btnNuevoRegistro').click(function(){	
        $("#txtNombre").focus();	
        $('#registrarUsuario').modal({"backdrop"  : "static"});        	
    }); //Fin evento click

    //Evento click del btnCancelarUsuario del formulario frmNuevoRegistro
	$('#btnCancelarUsuario').click(function(){
		limpiaCamposDatosRegistro();
        $('#registrarUsuario').modal('toggle');
	});

    //Evento click del btnGuardarUsuario del formulario frmNuevoRegistro
    $('#btnGuardarUsuario').click(function(){
        if(!validaCamposUsuario())
            return;
        
        guardaUsuario();
        mostrarTablaUsuarios(tablaUsuarios);    
    });

    //Evento click del btnCancelarUsuarioE del formulario frmEditarRegistro
	$('#btnCancelarUsuarioE').click(function(){
		limpiaCamposDatosRegistroEditar();
        $('#editarUsuario').modal('toggle');
	});

    //Evento click del btnGuardarUsuarioE del formulario frmEditarRegistro
    $('#btnGuardarUsuarioE').click(function(){
        if(!validaCamposEditarUsuario())
            return;
        
        modificaUsuario($("#txtIdE").val());
        mostrarTablaUsuarios(tablaUsuarios);
             
    });

    //Evento click del btnCerrarUsuarioV del formulario frmVisualizarRegistro
	$('#btnCerrarUsuarioV').click(function(){
		limpiaCamposDatosRegistroVisualizar();
        $('#visualizarUsuario').modal('toggle');
	});

});