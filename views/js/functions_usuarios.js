$("#tableUsuarios").DataTable();

var tableusuarios;

document.addEventListener("DOMContentLoaded", function () {
  tableusuarios = $("#tableUsuarios").DataTable({
    aProcessing: true,
    aServerSide: true,
    searching: true,
    lengthMenu: [
      [20, 50, 100, -1],
      [20, 50, 100, "All"],
    ],
    pageLength: 20,
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: "Mostrando un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
    },
    dom: "B<clear>frtip",
    buttons: ["copy", "excel", "pdf"],
    /*"ajax":{
            "url":"./models/usuarios/table_usuarios.php",
            "dataSrc":"",
        },
        "columns":[
            {"data":"acciones"},
            {"data":"nombre"},
            {"data":"apellidos"},
            {"data":"telefono_fijo"},
            {"data":"dni"},
            {"data":"usuario"},
            {"data":"dni"},
            {"data":"dni"},
            {"data":"estado"},
        ],*/
    responsive: true,
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "asc"]],
  });
  /*var formUsuario = document.querySelector('#formUsuario');
    formUsuario.onsubmit = function(e){
        e.preventDefault();
        
        

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest : new ActiveXObject('Microfost.XMLHTTP');
        var url = './models/usuarios/ajax-usuarios.php';
        var form = new FormData(formUsuario);
        request.open('POST',url,true);
        request.send(form);
        request.onreadystatechange = function(){
            
            if(request.readyState == 4 && request.status == 200){
                var data = JSON.parse(request.responseText);
                if(request.status){
                    $('#modalUsuario').modal('hide');
                    formUsuario.reset();
                    swal('Usuario',data.msg,'success');
                    tableusuarios.ajax.reload();
                }else{
                    swal('Usuario',data.msg,'error');
                }
            }
        }
    }*/
});

function inicioAlumno() {
  $("#registrarUsuarios").hide();
  $("#editarUsuarios").hide();
  $("#listaMovimientosUsuarios").hide();
}
inicioAlumno();

function openRegistrarUsuario() {
  $("#registrarUsuarios").show();
  $("#listaUsuarios").hide();
  $("#btnRegistrarUsuario").hide();
  $("#editarUsuarios").hide();
  $("#listaMovimientosUsuarios").hide();
}

function closeRegistrarUsuario() {
  $("#registrarUsuarios").hide();
  $("#listaUsuarios").show();
  $("#btnRegistrarUsuario").show();
  $("#editarUsuarios").hide();
  $("#listaMovimientosUsuarios").hide();
  document.querySelector("#formUsuario").reset();
}

function openEditarUsuario() {
  $("#registrarUsuarios").hide();
  $("#listaUsuarios").hide();
  $("#btnRegistrarUsuario").hide();
  $("#editarUsuarios").show();
  $("#listaMovimientosUsuarios").hide();
}

function openListaMovimientosUsuarios() {
  $("#registrarUsuarios").hide();
  $("#listaUsuarios").hide();
  $("#btnRegistrarUsuario").hide();
  $("#editarUsuarios").hide();
  $("#listaMovimientosUsuarios").show();
}
function closeListaMovimientosUsuarios() {
  $("#registrarUsuarios").hide();
  $("#listaUsuarios").show();
  $("#btnRegistrarUsuario").hide();
  $("#editarUsuarios").hide();
  $("#listaMovimientosUsuarios").hide();
}

function editarPersona(id) {
  openEditarUsuario();
  var idPersona = id;
  $.ajax({
    url: "ajax/usuarios.ajax.php",
    type: "POST",
    data: { idPersona: idPersona },
    dataType: "json",
    success: function (data) {
      $("#idPersona").val(data.idPersona);
      $("#nombre_persona").val(data.nombre_persona);
      $("#apellido_persona").val(data.apellido_persona);
    },
    fail: function (data) {
      swal("Usuario", data.msg, "error");
    },
  });
}

function verMovimientos(id) {
  openListaMovimientosUsuarios();
  var idPersonaMovimientos = id;
  $.ajax({
    url: "ajax/usuarios.ajax.php",
    type: "POST",
    data: { idPersonaMovimientos: idPersonaMovimientos },
    dataType: "json",
    success: function (data) {
      
      $("#movimientosCliente").html("");
      for (const prop in data) {
        console.log(data[prop].fecha_recarga);
        $("#movimientosCliente").append(`
              <tr>
                <th>${data[prop].medioPago_recarga}</th>
                <th>${data[prop].canalComunicacion_recarga}</th>
                <th>${data[prop].banco_recarga}</th>
                <th>${data[prop].codigo_recarga}</th>
                <th><h5 class="m-b-0">${data[prop].monto_recarga}</h5></th>
                <th><button class="btn btn-info btn-sm mt-1" title="Editar" onclick="editarDeposito()"><i class="mdi mdi-account-edit"></i></button>
                </th>
            </tr>
          `);
      }
    },
    fail: function (data) {
      swal("Usuario", data.msg, "error");
    },
  });
}
