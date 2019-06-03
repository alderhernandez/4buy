<script type="text/javascript">
$(document).ready(function(){
	$('#treeCheckbox').jstree({
		'core' : {
			'themes' : {
				'responsive': true
			}
		},
		'types' : {
			'default' : {
				'icon' : 'fa fa-folder'
			},
			'file' : {
				'icon' : 'fa fa-folder'
			}
		},
		'plugins': ['types', 'checkbox']
	});

	$("#ddlUsuarios, #single-append-text").select2({
		theme: "bootstrap",
        placeholder: "Seleccione un usuario",
        allowClear: true,
        language: "es"
    });
});
	

$("#btnSetAuth").on('click', function(){
	var ddlUser = $("#ddlUsuarios option:selected").val(),
	 i = 0,
	 array = new Array(),
	 sms,
	 retorno;
	$("#treeCheckbox li .jstree-leaf").each(function(){
		if ($(this).children().hasClass("jstree-clicked")) {
			array[i] = ddlUser+","+$(this).attr('id');
		 	i++;
		}
	});

	var form_data = {
		datos: array
	};

	$.ajax({
		url: "AsignarPermiso",
		type: "POST",
		data: form_data,
		beforeSend: function(){
			if ($("#ddlUsuarios option:selected").val() == '') {
				swal({
					text: "Debe Seleccionar Un Usuario",
					type: "error",
					allowOutsideClick: false
				});
				$.ajax.abort();
			}
		},
		success: function(data){
			var obj = jQuery.parseJSON(data);
			$.each(obj, function(key, value){
				sms = value.MENSAJE;
				retorno = value.RETORNO;
			});

			if (retorno < 0) {
				swal({
					type: "error",
					text: sms,
					allowOutsideClick: false
				});
			}else{
				swal({
					type: "success",
					text: sms,
					allowOutsideClick: false
				}).then(result => {
					location.reload();
				});
			}
		}
	});
});	

$("#btnSetAuth").on('click', function(){
	var ddlUser = $("#ddlUsuarios option:selected").val(),
	 i = 0,
	 array = new Array(),
	 sms,
	 retorno;
	$("#treeCheckbox li .jstree-leaf").each(function(){
		if (!$(this).children().hasClass("jstree-clicked")) {
			array[i] = ddlUser+","+$(this).attr('id');
		 	i++;
		}
	});

	var form_data = {
		datos: array
	};

	$.ajax({
		url: "QuitarPermiso",
		type: "POST",
		data: form_data,
		beforeSend: function(){
			if ($("#ddlUsuarios option:selected").val() == '') {
				$.ajax.abort();
			}
		},
		success: function(data){
			var obj = jQuery.parseJSON(data);
			$.each(obj, function(key, value){
				sms = value.MENSAJE;
				retorno = value.RETORNO;
			});

			if (retorno < 0) {
				swal({
					type: "error",
					text: sms,
					allowOutsideClick: false
				});
			}else{
				swal({
					type: "success",
					text: sms,
					allowOutsideClick: false
				}).then(result => {
					location.reload();
				});
			}
		}
	});
});

$("#ddlUsuarios").on("change", function(){
	$("#treeCheckbox").jstree("refresh");
	if ($("#ddlUsuarios option:selected").val() != '') {
		$.ajax({
		url: "GetAuthAsig/" + $(this).val(),
		type: "GET",
		dataType: "json",
		contentType: false,
		processData:false,
		success: function(datos){
		   $.each(datos, function(key, value){
			  $("#"+value.IdAutorizacion).find(".jstree-anchor").addClass("jstree-clicked");
		  });
		}
	});
  }
});
</script>