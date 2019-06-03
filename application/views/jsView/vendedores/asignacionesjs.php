<script type="text/javascript">	
 $(document).ready(function(){
 	$("#contenidoRutaAsig").html("");
 	$("#contenidoRutaNoAsig").html("");
 });


 $("#ddlSupervisores").change(function(){
 		$("#contenidoRutaAsig").html("");
		if ($("#ddlSupervisores option:selected").val() == '') {
			$("#contenidoRutaAsig").html("");
			$("#btnAsignar").addClass("disabled");
		}else{
			$("#btnAsignar").removeClass("disabled");
			$.ajax({
			url: "RutasAsignadas/"+ $("#ddlSupervisores option:selected").val(),
			type: "GET",
			dataType: "json",
			contentType: false,
			processData:false,
			success: function(datos){
				$.each(datos, function(key, value){
					$("#contenidoRutaAsig").append('<section class="panel panel-primary" id="panel'+value.IdRuta+'" data-portlet-item style="width:100% !important;">'+
								'<header class="panel-heading portlet-handler">'+
						'<div class="panel-actions">'+
							'<a href="#" class="fa fa-caret-down" id="showhideas'+value.IdRuta+'"></a>'+
						'</div>'+
					'<h6 class="panel-title" style="font-size:10pt !important;">'+ value.Ruta +'</h6>'+
							'</header>'+
							'<div class="panel-body" id="cuerpoas'+value.IdRuta+'">'+
								'<p class="col-md-8"><i class="fa fa-envelope"></i> '+ value.Correo +'</p>'+
								'<p class="col-md-6"><i class="fa fa-pencil"></i> '+ value.Nombre +'</p>'+
								'<p class=""><i class="fa fa-phone"></i> (+505) '+ value.Telefono1 +'</p>'+
								'<p class="idVend" style="display:none;">'+ value.IdUsuario +'</p>'+
							'</div>'+
					'</section>');

				/**************************************************************************************************/
					$("#cuerpoas"+value.IdRuta+"").hide();
					$("#showhideas"+value.IdRuta+"").click(function(){
				 		$("#cuerpoas"+value.IdRuta+"").toggle();
				 	});
				/**************************************************************************************************/
				});
			}
		});
	  }
	});


 $("#ddlSupervisores").change(function(){
 	    $("#contenidoRutaNoAsig").html("");
		if ($("#ddlSupervisores option:selected").val() == '') {
			$("#contenidoRutaNoAsig").html("");
		}else{
			$.ajax({
			url: "RutasNoAsignadas",
			type: "GET",
			dataType: "json",
			contentType: false,
			processData:false,
			success: function(datos){
				$.each(datos, function(key, value){
					$("#contenidoRutaNoAsig").append('<section class="panel panel-primary" id="panel'+value.IdRuta+'" data-portlet-item style="width:100% !important;">'+
								'<header class="panel-heading portlet-handler">'+
						'<div class="panel-actions">'+
							'<a href="#" class="fa fa-caret-down" id="showhide'+value.IdRuta+'"></a>'+
						'</div>'+
					'<h6 class="panel-title" style="font-size:10pt !important;">'+ value.Ruta +'</h6>'+
							'</header>'+
							'<div class="panel-body" id="cuerpo'+value.IdRuta+'">'+
								'<p class="col-md-8"><i class="fa fa-envelope"></i> '+ value.Correo +'</p>'+
								'<p class="col-md-6"><i class="fa fa-pencil"></i> '+ value.Nombre +'</p>'+
								'<p class=""><i class="fa fa-phone"></i> (+505) '+ value.Telefono1 +'</p>'+
								'<p class="idVend" style="display:none;">'+ value.IdUsuario +'</p>'+
							'</div>'+
					'</section>');
			/**************************************************************************************************/
			        $("#cuerpo"+value.IdRuta+"").hide();
					$("#showhide"+value.IdRuta+"").click(function(){
				 		$("#cuerpo"+value.IdRuta+"").toggle();
				 	});
			/**************************************************************************************************/
				});
			}
		});
	  }
	});

 $("#btnAsignar").click(function(){
 	var sms, retorno;
 	var select = $("#ddlSupervisores option:selected").val();
 	var i = 0;
 	var array = new Array();
 	$("#portlet-3 section .idVend").each(function(){
 		array[i] = select +","+ $(this).text();
 		i++;
 		console.log(array);
 	});

 	var form_data = {
 		asignar: array
 	}
 	$.ajax({
 		url: "AsignarVendedor",
 		type: "POST",
 		data: form_data,
 		success: function(data){
			if(data == "FALSE") {
				swal({
					text: 'No tienes permiso para realizar esta operación',
					type: 'warning',
					allowOutsideClick: false
				});
			}else{
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
				}
				else{
					swal({
						type: "success",
						text: sms,
						allowOutsideClick: false
					}).then(result =>{
						location.reload();
					});
				}
			}
 		}
 	});
 });

$("#btnAsignar").click(function(){
 	var sms, retorno;
 	var select = $("#ddlSupervisores option:selected").val();
 	var i = 0;
 	var array = new Array();
 	$("#portlet-1 section .idVend").each(function(){
 		array[i] = select +","+ $(this).text();
 		i++;
 		console.log(array);
 	});

 	var form_data = {
 		quitar: array
 	}
 	$.ajax({
 		url: "QuitarVendedor",
 		type: "POST",
 		data: form_data,
 		success: function(data){
			if(data == "FALSE") {
				swal({
					text: 'No tienes permiso para realizar esta operación',
					type: 'warning',
					allowOutsideClick: false
				});
			}else{
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
				}
				else{
					swal({
						type: "success",
						text: sms,
						allowOutsideClick: false
					}).then(result =>{
						location.reload();
					});
				}
			}
 		}
 	});
 });
</script>		
