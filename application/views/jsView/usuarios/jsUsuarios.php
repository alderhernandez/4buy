<script>
$(document).ready(function(){
  $("#tel1").numeric();
  $("#tel2").numeric();
  $("#idRol").select2({
        placeholder: "Seleccione un Rol",
        allowClear: true,
        language: "es"
    });
  
  $("#Rutas").select2({
        placeholder: "Seleccione una Ruta",
        allowClear: true,
        language: "es"
    });

  $("#datatable").DataTable({
    "order": [
				[2, "asc"]
			],
    "language": {
            "info": "Registro _START_ a _END_ de _TOTAL_ entradas",
            "infoEmpty": "Registro 0 a 0 de 0 entradas",
            "zeroRecords": "No se encontro coincidencia",
            "infoFiltered": "(filtrado de _MAX_ registros en total)",
            "emptyTable": "NO HAY DATOS DISPONIBLES",
            "lengthMenu": '_MENU_ ',
            "search": '<i class="fa fa-search"></i>',
            "paginate": {
                "first": "Primera",
                "last": "Última ",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
  });

  $("#newUserbtn").click(function () {
  	$("#tituloModal").text("Nuevo Usuario");
  	$("#btnSaveUser").show();
  	$("#btnUpdUser").hide();
  	$("#iduser").val("");
  	$("#username").val("");
  	$("#nombre").val("");
  	$("#apellido").val("");
    $("#chk1").prop("checked",false);
    $("#chk2").prop("checked",false);
	  $("#Reimprime").prop("checked",false);
  	$("#idRol option:selected").val("0");
  	$("#idRol option:selected").text("Selecciona un rol");
  	$("#Rutas option:selected").val("");
  	$("#Rutas option:selected").text("Selecciona una ruta");
  	$("#ddRutas").hide();
  	$("#tel1").val("");
    $("#tel2").val("");
  	$("#mail").val("");
  	$("#direccion").val("");
  	$("#pass").attr("disabled", false);
  	$("#idRol").val("0").trigger('change.select2');
    $("#Rutas").val("").trigger('change.select2');
  });
});

$("#btnSaveUser").click(function(){
    let Gen = 0; let reprint = 'N';
    if ($("#chk1").prop("checked") == true) {
        Gen = 1;
    }
    if($("#chk2").prop("checked") == true){
        Gen = 2;
    }

	if ($("#Reimprime").prop("checked") == true) {
		reprint = "Y";
	}else{
		reprint = "N";
	}
   
  var form_data = {
    username: $("#username").val(),
    nombre: $("#nombre").val(),
    apellido: $("#apellido").val(),
    pass: $("#pass").val(),
    idRol: $("#idRol option:selected").val(),
    tel1: $("#tel1").val(),
    tel2: $("#tel2").val(),
    mail: $("#mail").val(),
    direccion: $("#direccion").val(),
    IdRutas: $("#Rutas option:selected").val(),
    Rutas: $("#Rutas option:selected").text(),
    genero: Gen,
	reimprime: reprint
  };
  swal({
    title: "Guardar Usuario",
    text: "Antes de guardar verifica que los datos esten correctos",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Guardar',
    cancelButtonText: "Cancelar",
    allowOutsideClick: false
  }).then(result => {
    if (result.value) {
      $.ajax({
      url: "GuardarUsuario",
      type: "POST",
      data: form_data,
      beforeSend: function(){
        if ($("#chk1").prop("checked") == false && $("#chk2").prop("checked") == false) {
          swal({
            text: "Debe seleccionar un genero",
            type: "info",
            allowOutsideClick: false
          });
          $.ajax.abort();
        }
        if ($("#username").val() == "") {
          swal({
            text: "El campo nombre de usuario es requerido",
            type: "info",
            allowOutsideClick: false
          });
          $.ajax.abort();
        }
        if ( $("#nombre").val() == "") {
          swal({
            text: "El campo nombre es requerido",
            type: "info",
            allowOutsideClick: false
          });
          $.ajax.abort();
        }
        if ($("#apellido").val() == "") {
          swal({
            text: "El campo apellido es requerido",
            type: "info",
            allowOutsideClick: false
          });
          $.ajax.abort();
        }
        if ($("#pass").val() == "") {
          swal({
            text: "El campo Contraseña es requerido",
            type: "info",
            allowOutsideClick: false
          });
          $.ajax.abort();
        }
        if ($("#idRol option:selected").val() == 0) {
          swal({
            text: "Debe seleccionar un rol",
            type: "info",
            allowOutsideClick: false
          });
          $.ajax.abort();
        }
        if ($("#tel1").val() == "") {
          swal({
            text: "El campo Telefono es requerido",
            type: "info",
            allowOutsideClick: false
          });
          $.ajax.abort();
        }
        if($("#mail").val() == "")
        {
          swal({
            text: "El campo Correo es requerido",
            type: "info",
            allowOutsideClick: false
          });
          $.ajax.abort();
        }
    },
    success: function(data){
      if (data=='-1') {
        swal({
            title: "Error, ya existe un vendedor con esta ruta",
            text:  "para asignar esta ruta al nuevo vendedor debe dar de baja al vendedor anterior",
            type: "error",
            allowOutsideClick: false
        });
      }else{
          if (data == "FALSE") {
              swal({
                text: "No tienes permiso para realizar esta operacion",
                type: "warning",
                allowOutsideClick: false
              });
          }else{
			  GuardarConsecutivos($("#Rutas option:selected").val());
              swal({
                text: "Datos almacenados con éxito",
                type: "success",
                allowOutsideClick: false
              }).then(result => {
                  location.reload();
              });
          }
      }
    },
    error: function(){
      swal({
          text: 'No se pudo completar la operación, si el problema persiste contáctece con el administrador.',
          type: "error",
          allowOutsideClick: false
      });
    }
  });
    }
  });
});

function ActualizarEstado(id, estado, idruta) {
	if (estado == 1) {
		var titulo = "Dar de baja";
		var mensaje = "Estas seguro que deseas dar de baja a este Usuario?";
	} else {
		var titulo = "Restaurar";
		var mensaje = "Estas seguro que deseas restaurar este Usuario?";
	}
	swal({
		title: titulo,
		text: mensaje,
		type: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Aceptar',
		cancelButtonText: "Cancelar",
    allowOutsideClick: false
	}).then(result => {
		if (result.value) {
			$.ajax({
				url: "ActualizarEstUser/" + id + "/" + estado +"/"+idruta,
				type: "POST",
        async: true,
				success: function (JSON) {
					if (JSON == "-1") {
              swal({
                  title: "Error, ya existe un vendedor con esta ruta",
                  text:  "No se puede restaurar porque otro vendedor ya tiene asignada la ruta "+idruta+" ",
                  type: "error",
                  allowOutsideClick: false
              });
          }else{
            if (JSON == "FALSE") {
                swal({
                    text: "No tienes permiso para realizar esta operacion",
                    type: "warning",
                    allowOutsideClick: false
                });
            }else{
                swal({
                    text: "La operación se llevo a cabo con éxito",
                    type: "success",
                    allowOutsideClick: false
                }).then(function () {
                      location.reload();
                });
             }
           }
				},
				error: function () {
					swal({
						text: 'No se pudo completar la operación, si el problema persiste contáctece con el administrador.',
						type: "error",
            allowOutsideClick: false
					});
				}
			});
		}
	});
}

function editar(iduser, user, nom, ape, tel1, tel2, mail, rol, roltxt, dir, ruta, rutatxt, genero, reprint) {
    $("#iduser").val(iduser);
    $("#username").val(user);
    $("#nombre").val(nom);
    $("#apellido").val(ape);
    $("#tel1").val(tel1);
    $("#tel2").val(tel2);
    $("#mail").val(mail);
    $("#idRol option:selected").val(rol);
    $("#idRol option:selected").text(roltxt);
    $("#direccion").val(dir);
    $("#Rutas option:selected").val(ruta);
    $("#Rutas option:selected").text(rutatxt).prop(":disabled", true);
    if (genero == 1) {
      $("#chk1").prop("checked",true);
      $("#chk2").prop("checked",false);
    }else if(genero == 2){
      $("#chk2").prop("checked",true);
      $("#chk1").prop("checked",false);
    }
    if(reprint == "Y"){
		$("#Reimprime").prop("checked",true);
	}else{
		$("#Reimprime").prop("checked",false);
	}
    $("#pass").attr("disabled", true);
    $("#tituloModal").text("Editar Usuario");
    $("#btnSaveUser").hide();
    $("#btnUpdUser").show();
    if ($("#idRol option:selected").val() == "4") {
      $("#ddRutas").show();
    } else {
      $("#ddRutas").hide();
    }
    $("#idRol").val(rol).trigger('change.select2');
    $("#Rutas").val(ruta).trigger('change.select2');
    $("#nuevoUser").modal('show');
}

$("#btnUpdUser").click(function(){
      var Gen = 0; let reprint = "N";
      if ($("#chk1").prop("checked") == true) {
          Gen = 1;
      }
      if($("#chk2").prop("checked") == true){
          Gen = 2;
      }

	if ($("#Reimprime").prop("checked") == true) {
		reprint = "Y";
	}else{
		reprint = "N";
	}

  var ruta = $("#Rutas option:selected").val(), 
  txtruta = $("#Rutas option:selected").text();
  if($("#idRol option:selected").val() != "4"){
    ruta = "";
    txtruta = "";
  }
  var form_data = {
    iduser: $("#iduser").val(),
    username: $("#username").val(),
    nombre: $("#nombre").val(),
    apellido: $("#apellido").val(),
    idRol: $("#idRol option:selected").val(),
    tel1: $("#tel1").val(),
    tel2: $("#tel2").val(),
    mail: $("#mail").val(),
    direccion: $("#direccion").val(),
    IdRutas: ruta,
    Rutas: txtruta,
    genero: Gen,
	reimprime: reprint
  };
  $.ajax({
    url: "ActualizarUsuario",
    type: "POST",
    data: form_data,
    beforeSend: function(){
      if ($("#username").val() == "") {
          swal({
            text: "El campo nombre de usuario es requerido",
            type: "info",
            allowOutsideClick: false
          });
          $.ajax.abort();
        }
        if ( $("#nombre").val() == "") {
          swal({
            text: "El campo nombre es requerido",
            type: "info",
            allowOutsideClick: false
          });
          $.ajax.abort();
        }
        if ($("#apellido").val() == "") {
          swal({
            text: "El campo apellido es requerido",
            type: "info",
            allowOutsideClick: false
          });
          $.ajax.abort();
        }
        if ($("#tel1").val() == "") {
          swal({
            text: "El campo Telefono es requerido",
            type: "info",
            allowOutsideClick: false
          });
          $.ajax.abort();
        }
        if($("#mail").val() == "")
        {
          swal({
            text: "El campo Correo es requerido",
            type: "info",
            allowOutsideClick: false
          });
          $.ajax.abort();
        }
    },
    success: function (data){
      if(data == "FALSE"){
        swal({
           text: "No tienes permiso para realizar esta operacion",
           type: "warning",
           allowOutsideClick: false
          })
      }else{
        swal({
          text: "Datos atualizados con éxito",
          type: "success",
          allowOutsideClick: false
        }).then(function () {
            location.reload();
        });
      }
    },
    error: function(){
      swal({
          text: 'No se pudo completar la operación, si el problema persiste contáctece con el administrador.',
          type: "error",
          allowOutsideClick: false
      });
    }
  });
});

$("#idRol").on("change", function () {
	if ($("#idRol option:selected").val() == "4" && $("#idRol option:selected").text() == "Vendedor") {
		$("#ddRutas").show();
	} else {
		$("#ddRutas").hide();
	}
});

function GuardarConsecutivos(ruta) {
	$.ajax({
		url: "GuardarConsecutivos/"+ruta,
		type: "POST",
		success: function () {
			console.log("success")
		},
		error: function () {
			console.log("error");
		}
	});
}
</script>
