<script>
	$(document).ready(function () {
		$("#tblRoles").DataTable({
			/*"scrollY":"100px",
            "scrollCollapse": true,*/
			"order": [
				[2, "desc"]
			],
			"language": {
				"info": "Registro _START_ a _END_ de _TOTAL_ entradas",
				"infoEmpty": "Registro 0 a 0 de 0 entradas",
				"zeroRecords": "No se encontro coincidencia",
				"infoFiltered": "(filtrado de _MAX_ registros en total)",
				"emptyTable": "NO HAY DATOS DISPONIBLES",
				"lengthMenu": '_MENU_ ',
				"paginate": {
					"first": "Primera",
					"last": "Última ",
					"next": "Siguiente",
					"previous": "Anterior"
				}
			}
        });
        
        $("#newRol").click(function(){
            $("#tituloModal").text("Nuevo Rol");
        });

		$(document).on('click', '#btnSaveRol', function () {
			var form_data = {
				Rol: $("#Rol").val(),
				rtadescripcion: $("#tadescripcion").val()
			};
			$.ajax({
				url: "GuardarRoles",
				type: "POST",
				data: form_data,
				beforeSend: function () {
					if ($("#Rol").val() == "" || $("#tadescripcion").val() == "") {
                        swal({
                            text: "Nombre rol y Descripción son requeridos.",
                            type: "warning",
                            allowOutsideClick: false
                        });
						$.ajax.abort();
					}
				},
				success: function (data) {
					if(data == "FALSE") {
						swal({
	                        text: 'No tienes permiso para realizar esta operación',
	                        type: 'warning',
	                        allowOutsideClick: false
	                    });
					}else{
						swal({
	                        text: 'Los datos se han almacenado con éxito.',
	                        type: 'success',
	                        allowOutsideClick: false
	                    }).then(result =>{
	                        location.reload();
	                    });
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
		});
    }); 

function ActualizarEstado(id, estado) {
	if (estado == 1) {
		var titulo = "Dar de baja";
		var mensaje = "Estas seguro que deseas dar de baja a este Rol?";
	} else {
		var titulo = "Restaurar";
		var mensaje = "Estas seguro que deseas restaurar este Rol?";
	}
	swal({
		title: titulo,
		text: mensaje,
		type: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Aceptar',
		cancelButtonText: "Cancelar"
	}).then(result => {
		if (result.value) {
			$.ajax({
				url: "ActualizarEst/" + id + "/" + estado,
				type: "POST",
				success: function (JSON) {
					if (JSON == "FALSE") {
						swal({
							text: "No tienes permiso para realizar esta operación",
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

function editar(id,nombre,descripcion){
    $("#tituloModaledit").text("Editar Rol");
    $("#IdRol").val(id);
    $("#Roledit").val(nombre);
    $("#tadescripcionedit").val(descripcion);
    $('#editRol').modal('show');
}

$("#btnUpdateRol").click(function(){
	var form_data = {
		Roledit: $("#Roledit").val(),
		tadescripcionedit: $("#tadescripcionedit").val()
	};
    $.ajax({
        url: "ActualizarRol/" + $("#IdRol").val(),
        type: "POST",
		data: form_data,
		success: function(data){
			if (data == "FALSE") {
				swal({
					text: "No tienes permiso para realizar esta operación",
					type: "warning",
					allowOutsideClick: false
				});
			}else{
				swal({
					text: "Datos atualizados con éxito",
					type: "success",
					allowOutsideClick: false
				}).then(result => {
					location.reload();
				});
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
});
</script>
