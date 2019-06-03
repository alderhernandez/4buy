<script type="text/javascript">
$(document).ready(function(){
	$("#tel1").numeric();
	$("#tel2").numeric();
});

 $("#UpdUserinfo").click(function(){
      var Gen = 0;
      if ($("#chk1").prop("checked") == true) {
          Gen = 1;
      }
      if($("#chk2").prop("checked") == true){
          Gen = 2;
      }
  var form_data = {
    iduser: $("#profileId").val(),
    username: $("#user").val(),
    nombre: $("#nombre").val(),
    apellido: $("#apellidos").val(),
    tel1: $("#tel1").val(),
    tel2: $("#tel2").val(),
    mail: $("#correo").val(),
    direccion: $("#direccion").val(),
    genero: Gen
  };

  $.ajax({
    url: "ActualizarPerfil",
    type: "POST",
    data: form_data,
    beforeSend: function(){
    },
    success: function (data){
        swal({
          text: "Datos actualizados con éxito",
          type: "success",
          allowOutsideClick: false
        }).then(function () {
            location.reload();
        });
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

 $("#btnUpdPass").on("click", function(){
 	var form_data = {
		profileId: $("#profileId").val(),
		oldPass: $("#oldPass").val(),
		NewPass: $("#NewPass").val()
 	};

 	$.ajax({
 		url: "CambiarPassword",
 		type: "POST",
 		data: form_data,
 		beforeSend: function(){
 			if ($("#oldPass").val() == '' || $("#NewPass").val() == '' || $("#NewPassRepeat").val() == '') {
 				swal({
		          text: 'Todos los campos son requeridos',
		          type: "error",
		          allowOutsideClick: false
		      });
 				$.ajax.abort();
 			}
 			if ($("#NewPassRepeat").val() != $("#NewPass").val()) {
 			   swal({
		          text: 'Las contraseñas no coinciden',
		          type: "error",
		          allowOutsideClick: false
		      }).then(result => {
		      	   $("#NewPassRepeat").parents().find(".validar").removeClass("has-sucess");
		      	   $("#NewPass").parents().find(".validar").removeClass("has-sucess");
		      	   $("#NewPassRepeat").parents().find(".validar").addClass("has-error");
		      	   $("#NewPass").parents().find(".validar").addClass("has-error");
		      });
 				$.ajax.abort();	
 			}else{
   			     $("#NewPassRepeat").parents().find(".validar").removeClass("has-error");
		      	 $("#NewPass").parents().find(".validar").removeClass("has-error");
 				 $("#NewPassRepeat").parents().find(".validar").addClass("has-success");
		      	 $("#NewPass").parents().find(".validar").addClass("has-success");
 			}
 		},
 		success: function(data){
 			if (data == "FALSE") {
				swal({
			          text: 'La contraseña que intentas cambiar es erronea o no existe. Si el problema persiste contáctece con el administrador',
			          type: "error",
			          allowOutsideClick: false
			    });
 			}else{
 				swal({
			          text: 'La contraseña se actualizó con éxito, cierre e inicie sesión de nuevo para efectuar los cambios',
			          type: "success",
			          allowOutsideClick: false
			    }).then(result => {
			    	location.reload();
			    });
 			}
 		},
 		error: function() {
 			swal({
		          text: 'No se pudo completar la operación, si el problema persiste contáctece con el administrador.',
		          type: "error",
		          allowOutsideClick: false
		    });
 		}
 	});
 });
</script>
