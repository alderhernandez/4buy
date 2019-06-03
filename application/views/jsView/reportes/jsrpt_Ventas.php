<script type="text/javascript">
	$(document).ready(function() {
$('#Ruta').select2({
		placeholder: "Seleccione una Ruta",
		allowClear: true,
		language: "es"
	});
	});

	$("#btnActualizar").click(function () {
		let table = $("#tblrptVentas").DataTable({
			"ajax": {
				"url": "RptVentas",
				"type": "POST",
				"data": function ( d ) {
					d.fechainicio = $("#fechainicio").val();
					d.fechafinal = $("#fechafin").val();
					d.ruta = $("#Ruta option:selected").val();
				}
			},
			"processing": true,
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
				{"data" : "CODVENDEDOR"},
				{"data" : "NOMBREVENDEDOR"},
				{"data" : "NOFACTURA"},
				{"data" : "LIBRAS"},
				{"data" : "UVENCREDITO"},
				{"data" : "UVENCONTADO"},
				{"data" : "SUBTOTALCREDITO"},
				{"data" : "SUBTOTALCONTADO"},
				{"data" : "DESCCREDITO"},
				{"data" : "DESCCONTADO"},
				{"data" : "ISCCREDITO"},
				{"data" : "ISCCONTADO"},
				{"data" : "IVACREDITO"},
				{"data" : "IVACONTADO"},
				{"data" : "TOTAL"}
			]
		});
	});
</script>