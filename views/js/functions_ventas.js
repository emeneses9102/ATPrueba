$("#idPlayer").blur(function () {
  let idPlayer = $("#idPlayer").val();
  buscarCliente(idPlayer);
});
listaRecargasRecientes();

function listaRecargasRecientes() {
    let recargasRecientes = "recargasRecientes";
    $.ajax({
      url: "ajax/ventas.ajax.php",
      type: "POST",
      data: { recargasRecientes: recargasRecientes },
      dataType: "json",
      success: function (data) {
        $("#ultimasRecargas").html('')
        for (const prop in data) {
          console.log(data[prop].fecha_recarga);
          $("#ultimasRecargas").append(`
              <div class="mt-2 pb-3 d-flex align-items-center">
                  <span class="btn btn-primary btn-circle d-flex align-items-center">
                      <i class="mdi mdi-cart-outline fs-4"></i>
                  </span>
                  <div class="ms-3">
                      <h5 class="mb-0 fw-bold">${data[prop].nombreCompleto}</h5>
                      <span class="text-muted fs-6">${data[prop].fecha_recarga}</span>
                  </div>
                  <div class="ms-auto">
                      <h6">${data[prop].monto_recarga}</h6>
                  </div>
              </div>
          `);
        }
      },
      fail: function (data) {
        swal("Usuario", data.msg, "error");
      },
    });
  }

function buscarCliente(idPlayer) {
  $.ajax({
    url: "ajax/usuarios.ajax.php",
    type: "POST",
    data: { idPlayer: idPlayer },
    dataType: "json",
    success: function (data) {
      if (data == "error") {
        $("#nombre_persona").val("");
        $("#apellido_persona").val("");
        $("#idCliente").val("");
        swal.fire({
          icon: "error",
          title: "No se encontró al usuario",
          confirmButtonText: "Cerrar",
        });
      } else {
        $("#idCliente").val(data.idCliente);
        $("#nombre_persona").val(data.nombre_persona);
        $("#apellido_persona").val(data.apellido_persona);
        listaRecargasRecientes()
      }
    },
    fail: function (data) {
      swal("Usuario", data.msg, "error");
    },
  });
}

function limpiarFormVentas() {
  document.querySelector("#formRecarga").reset();
}


