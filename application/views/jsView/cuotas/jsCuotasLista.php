<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 28/3/2019 14:23 2019
 * FileName: jsCuotasLista.php
 */
?>
<script type="text/javascript">
	$(document).ready(function () {
		$("#ddlRutas").select2({
			placeholder: "Seleccione una ruta",
			allowClear: true,
			language: "es"
		});

		$("#Mes").select2({
			placeholder: "Seleccione un mes",
			allowClear: true,
			language: "es"
		});
	});

	$("#btnActualizar").click(function () {
		cargarCuotas();
	});

	function cargarCuotas(){
		if($("#fechaFac1").val() == "" || $("#fechaFac2").val() == ""){
			swal({
				text: "Debe ingresar una fecha inicio y una fecha final",
				type: "error",
				allowOutsideClick: false
			});
		}else{
			let table = $("#dtCuotas").DataTable({
				"ajax": {
					"url": "ReporteCuotas",
					"type": "POST",
					"data": function ( d ) {
						d.fecha1 = $("#fechaFac1").val();
						d.fecha2 = $("#fechaFac2").val();
						d.ruta = $("#ddlRutas option:selected").text();
						d.mes = $("#Mes option:selected").val();
						// d.custom = $('#myInput').val();
						// etc
					}
				},
				"processing": true,
				"scrollX": true,
				"orderMulti": false,
				"info": true,
				"sort": true,
				"destroy": true,
				"lengthMenu": [
					[10,20,50,100, -1],
					[10,20,50,100, "Todo"]
				],
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
					"loadingRecords": "",
					"processing": "Procesando datos  <i class='fa fa-spin fa-refresh'></i>",
					"paginate": {
						"first": "Primera",
						"last": "Última ",
						"next": "Siguiente",
						"previous": "Anterior"
					}
				},
				"columns": [
					{"data" : "IdRuta"},
					{"data" : "Descripcion"},
					{"data" : "Nombre"},
					{"data" : "CUOTAMENSUAL"},
					{"data" : "LIBRAS_VENDIDAS"},
					{"data" : "CUOTA_A_LLEVAR"},
					{"data" : "GAP_LIBRAS"},
					{"data" : "FALTA_VENDER"},
					{"data" : "AVANCE_VENTAS"},
					{"data" : "CUMPLIMIENTO"},
					{"data" : "PROMEDIO_DIARIO"},
					{"data" : "DIAS_EFECTIVOS"},
					{"data" : "PRIMER_DIA"},
					{"data" : "DIAS_TRANSCURRIDOS"}
				],
				"columnDefs": [
					{
						"targets": [1],
						"visible": false,
						"orderable": false
					}
				]
			});
		}
		if($("#ddlRutas option:selected").val() == ""){
			$("#exportarMetas").attr('href','ExportarCuota/'+$("#fechaFac1").val()+"/"+$("#fechaFac2").val()+"/"+'null'+"/"+$("#Mes option:selected").val());
		}else{
			$("#exportarMetas").attr('href','ExportarCuota/'+$("#fechaFac1").val()+"/"+$("#fechaFac2").val()+"/"+$("#ddlRutas option:selected").text()+"/"+$("#Mes option:selected").val());
		}
	}
</script>
