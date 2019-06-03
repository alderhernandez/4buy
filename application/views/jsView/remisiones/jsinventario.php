<script type="text/javascript">
	$(document).ready(function(){
		CargarInventario();
		InvRutas();
		setInterval(function(){
			if ($("#chkSinStock").prop("checked") == false) {
			CargarInventario();
			}else{
				invSinStock();
			}

			if ($("#chkRutasSInv").prop("checked") == false) {
			    InvRutas();
			}else{
				InvRutasNoStock();
			}
		},1000000);
	});

	$("#chkSinStock").change(function(){
		if ($(this).prop("checked") == true) {
			invSinStock();
		}else{
			CargarInventario();
		}
	});


	$("#btnActualizar").click(function(){
		if ($("#chkSinStock").prop("checked") == false) {
			CargarInventario();
		}else{
			invSinStock();
		}

		if ($("#chkRutasSInv").prop("checked") == false) {
			InvRutas();
		}else{
			InvRutasNoStock();
		}
	});

	function CargarInventario(){
	  var table = $("#tblInventario").DataTable({
			"ajax": {
				"url": "InventarioList",
				"type": "POST"
			},
			"stateSave": false,
			"processing": true,
			"serverSide": true,
			"info": true,
			"sort":true,
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
				{"data" : "ItemCode"},
				{"data" : "ItemName"},
				{"data" : "SalUnitMsr"},
				{"data" : "OnHand"},
				{"data" : "WhsCode"}
			]
		});
	}

	function invSinStock(){
	  var table = $("#tblInventario").DataTable({
	  	"ajax": {
				"url": "InventarioSinStock",
				"type": "POST"
			},
			"stateSave": false,
			"serverSide": true,
			"processing": true,
			"info": true,
			"sort":true,
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
				{"data" : "ItemCode"},
				{"data" : "ItemName"},
				{"data" : "SalUnitMsr"},
				{"data" : "OnHand"},
				{"data" : "WhsCode"}
			]
		});	
	}


	$("#chkRutasSInv").change(function(){
		if ($(this).prop("checked") == true) {
			InvRutasNoStock();
		}else{
			InvRutas();
		}
	});

	function InvRutas(){
	  var table = $("#tblInventarioRutas").DataTable({
			"ajax": {
				"url": "InventarioRutas",
				"type": "POST"
			},
			"processing": true,
			"serverSide": true,
			"info": true,
			"sort":true,
			"destroy": true,
			"lengthMenu": [
				[10,20,50,100, -1],
				[10,20,50,100, "Todo"]
			],
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
				{"data" : "ItemCode"},
				{"data" : "ItemName"},
				{"data" : "SlpName"},
				{"data" : "SalUnitMsr"},
				{"data" : "OnHand"},
				{"data" : "WhsCode"}
			]
		});	
	}

	function InvRutasNoStock(){
	  var table = $("#tblInventarioRutas").DataTable({
			"ajax": {
				"url": "inventarioRutasSinStock",
				"type": "POST"
			},
			"processing": true,
			"serverSide": true,
			"info": true,
			"sort":true,
			"destroy": true,
			"lengthMenu": [
				[10,20,50,100, -1],
				[10,20,50,100, "Todo"]
			],
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
				{"data" : "ItemCode"},
				{"data" : "ItemName"},
				{"data" : "SlpName"},
				{"data" : "SalUnitMsr"},
				{"data" : "OnHand"},
				{"data" : "WhsCode"}
			]
		});	
	}
</script>
