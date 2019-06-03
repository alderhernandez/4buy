<script type="text/javascript">
 $(document).ready(function(){

 	$("#CatAuth").select2({
        placeholder: "Seleccione una Categoria",
        allowClear: true
    });

 	$("#tblNewAuth").DataTable({
    "order": [
				[0, "asc"]
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

 	$("#btnNewAuth").on("click", function(){
 		$("#tituloModal").text("Nueva Autorizacion");
 		$("#modulo").val("");
        $("#descripcion").val("");
        $("#CatAuth option:selected").val("0");
		$("#CatAuth option:selected").text("Seleccione una Categoria").prop(":disabled", true);
        $("#btnSaveAuth").show();
        $("#btnUpdAuth").hide();
        $("#CatAuth").val("0").trigger('change.select2');
 	});
 });

$("#btnSaveAuth").on("click", function(){
	var form_data = {
		descripcion: $("#descripcion").val(),
		modulo: $("#modulo").val(),
		categoria: $("#CatAuth option:selected").val()
	};
	$.ajax({
		url: "CrearPermiso",
		type: "POST",
		data: form_data,
		beforeSend: function(){
			if ($("#descripcion").val() == "" || $("#modulo").val() == "") {
				swal({
					text: "Debe Ingresar El Nombre Del Modulo Y Una Descripcion Del Permiso",
					type: "error",
					allowOutsideClick: false
				});
				$.ajax.abort();
			}
			if ($("#CatAuth option:selected").val() == 0) {
				swal({
					text: "Debe Seleccionar Una Categoria",
					type: "error",
					allowOutsideClick: false
				});
				$.ajax.abort();
			}
		},
		success: function(){
			swal({
				text: "Datos Guardados Correctamente",
				type: "success",
				allowOutsideClick: false
			}).then(result => {
				location.reload();
			});
		},
		error: function(){
			swal({
				text: "Ocurrio Un Error Inesperado En El Servidor",
				type: "error",
				allowOutsideClick: false
			});
		}
	});
});

function Baja(id, estado){
	var mensaje = "", titulo = "", texto = "";
	if(estado == 1){ titulo = 'Dar De Baja'; mensaje = 'Estas Seguro Que Deseas Dar De Baja Este Registro?'; texto = "Dar Baja"}
	else{ titulo = 'Restaurar'; mensaje = 'Estas Seguro Que Deseas Restaurar Este Registro?'; texto="Restaurar";}
	swal({
    title: titulo,
    text: mensaje,
    type: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: texto,
    cancelButtonText: "Cancelar",
    allowOutsideClick: false
  }).then(result =>{
  	if (result.value) {
  		$.ajax({
  			url: "DarBaja/"+id+"/"+estado,
  			type: "POST",
  			success: function(){
  				swal({
  					type: "success",
  					text: "Estado Actualizado"
  				}).then(result =>{
  					location.reload();
  				});
  			},
  			error: function(){
  				swal({
  					type: "error",
  					text: "Ocurrio Un Error Inesperado En El Servidor"
  				}).then(result =>{
  					location.reload();
  				});
  			}
  		});
  	}
  });
}

function editar(id, desc, modulo, idcat, cat){
	$("#tituloModal").text("Editar Autorizacion");
	$("#idAuth").val(id);
    $("#descripcion").val(desc);
    $("#modulo").val(modulo);
    $("#CatAuth option:selected").val(idcat);
    $("#CatAuth option:selected").text(cat);
    $("#btnSaveAuth").hide();
    $("#btnUpdAuth").show();
    $("#newAuth").modal("show");
    $("#CatAuth").val(idcat).trigger('change.select2');
}

$("#btnUpdAuth").on("click", function(){
	var form_data = {
		idaut : $("#idAuth").val(),
		descripcion: $("#descripcion").val(),
		modulo: $("#modulo").val(),
		categoria: $("#CatAuth option:selected").val()
	};

	swal({
    text: "¿Estas Seguro Que Deseas Actualizar Los Datos De Esta Autorizacion?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: "Actualizar",
    cancelButtonText: "Cancelar",
    allowOutsideClick: false
  }).then(result => {
  	if (result.value) {
	  		$.ajax({
			url: "ActualizarPermiso",
			type: "POST",
			data: form_data,
			beforeSend: function(){
				if($("#descripcion").val() == "" || $("#modulo").val() == "") {
					swal({
						text: "Debe Ingresar El Nombre Del Modulo Y Una Descripcion Del Permiso",
						type: "error",
						allowOutsideClick: false
					});
					$.ajax.abort();
				}
			},
			success: function(){
				swal({
					text: "Datos Actualizados Correctamente",
					type: "success"
				}).then(result => {
					location.reload();
				});
			},
			error: function() {
				swal({
					text: "Ocurrio Un Error Inesperado En El Servidor",
					type: "error"
				});
			}
		});
  	 }
  });
});
</script>
