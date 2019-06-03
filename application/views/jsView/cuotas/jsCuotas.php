<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 27/3/2019 10:28 2019
 * FileName: jsCuotas.php
 */
?>
<script type="text/javascript">
	$(document).ready(function () {

	let url = window.location.pathname;
	let params = url.split("ExportarCuota");

	let loc = window.location;
	let pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 4);
    let ruta1 = loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));    
    url = ruta1+"../remisionOrdenSCliente"+params[1];
    url = ruta1.replace("ExportarCuota","grafica");

	$.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        data: '',
        success: function (msg) {
		paramNombres = [];
		paramDatos = [];
		bgColor = [];
		bgBorder = [];
		$.each(msg, function(i,item){ //se recorren los datos y se generan colores random
			//alert(item["Nombre"]);
				var r = Math.random() * 255;
				r = Math.round(r);

				var g = Math.random() * 255;
				g = Math.round(g);

				var b = Math.random() * 255;
				b = Math.round(b);

			paramNombres.push(item["Nombre"]);
			paramDatos.push(item["LIBRAS_VENDIDAS"]);
			bgColor.push('rgba('+r+','+g+','+b+', 0.8)');
			bgBorder.push('rgba('+r+','+g+','+b+', 1)');
		});

		//CONSTRUCCION DEL GRAFICO
		var ctx = $("#myChart");
			var myChart = new Chart(ctx, {
			    type: 'bar',
			    data: {
			        labels: paramNombres,
			        datasets: [{
			            label: 'Libras',
			            data: paramDatos,
			            backgroundColor: bgColor,
			            borderColor: bgBorder,
			            borderWidth: 1
			        }]
			    },
			    options: {
			        scales: {
			            yAxes: [{
			                ticks: {
			                    beginAtZero:true
			                }
			            }]
			        }
			    }
			});
			var ctx = $("#myChart2");
			var myChart = new Chart(ctx, {
			    type: 'pie',
			    data: {
			        labels: paramNombres,			        
			        datasets: [{
			            label: paramNombres,
			            data: paramDatos,
			            backgroundColor: bgColor,
			            borderColor: bgBorder,
			            borderWidth: 1
			        }]
			    },
			    options: {
			        scales: {
			            yAxes: [{
			                ticks: {
			                    beginAtZero:true
			                }
			            }]
			        }
			    }
			});

        }
    });


		$("#datatable").DataTable({
			"order": [
			[1, "asc"]
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
	});

	$("#newUserbtn").click(function () {
		$("#tituloModal").text("Nueva Cuota");
		$("#CuotaMensual").val("");
		$("#idCuota").val("");
		$("#Diashabiles").val("");
		$("#btnSaveCuota").show();
		$("#btnUpdCuota").hide();
		$("#Rutas option:selected").val("");
		$("#Rutas option:selected").text("Selecciona una ruta");
		$("#Rutas").val("").trigger('change.select2');
		$("#nuevoUser").modal("show");
	});

$("#btnSaveCuota").click(function () {
	let tipo = '', sms = '';
	let form_data = {
		mes: $("#Mes").val(),
		anio: $("#year").val(),
		ruta: $("#Rutas option:selected").val(),
		numruta: $("#Rutas option:selected").text(),
		cuotamens: $("#CuotaMensual").val(),
		dias: $("#Diashabiles").val()
	};
	
	$.ajax({
		url: "GuardarCuotas",
		type: "POST",
		data: form_data,
		beforeSend: function (){
			if($("#Rutas option:selected").val() == "" || $("#CuotaMensual").val() == "" || $("#Diashabiles").val() == ""){
				swal({
					type: "error",
					text: "Todos los campos son requeridos",
					allowOutsideClick: false
				});
				$.ajax().abort();
			}
		},
		success: function (data) {
			let obj = jQuery.parseJSON(data);
			$.each(obj, function (i, value) {
				tipo = value["tipo"];
				sms = value["mensaje"];
			});

			swal({
				type: tipo,
				text: sms,
				allowOutsideClick: false
			}).then(result => {
				location.reload();
			});
		}
	});
});

function editar(id,cuota,dias,ruta,rutatxt){
	$("#Rutas").prop("disabled",true);
	$("#idCuota").val(id);
	$("#CuotaMensual").val(cuota);
	$("#Diashabiles").val(dias);
	$("#tituloModal").text("Editar Cuota");
	$("#Rutas option:selected").val(ruta);
	$("#Rutas option:selected").text("Vendedor "+ rutatxt.toUpperCase()).prop(":disabled", true);
	$("#btnSaveCuota").hide();
	$("#btnUpdCuota").show();
	$("#Rutas").val(ruta).trigger('change.select2');
	$("#nuevoUser").modal("show");
}

	$("#btnUpdCuota").click(function () {
		let tipo = '', sms = '';
		let form_data = {
			id: $("#idCuota").val(),
			cuotamens: $("#CuotaMensual").val(),
			dias: $("#Diashabiles").val()

		};

		$.ajax({
			url: "ActualizarCuotas",
			type: "POST",
			data: form_data,
			beforeSend: function (){
				if($("#CuotaMensual").val() == "" || $("#Diashabiles").val() == ""){
					swal({
						type: "error",
						text: "Todos los campos son requeridos",
						allowOutsideClick: false
					});
					$.ajax().abort();
				}
			},
			success: function (data) {
				let obj = jQuery.parseJSON(data);
				$.each(obj, function (i, value) {
					tipo = value["tipo"];
					sms = value["mensaje"];
				});

				swal({
					type: tipo,
					text: sms,
					allowOutsideClick: false
				}).then(result => {
					location.reload();
				});
			}
		});
	});

</script>
