<script type="text/javascript">
$("#printConsecutivos").click(function(){
	if($("#fecha1").val() > $("#fecha2").val()){
		swal({
			text: "La fecha de inicio no puede ser mayor a la fecha final",
			type: "error",
			allowOutsideClick: false
		});
	}else if($("#fecha1").val() == "" || $("#fecha2").val() == ""){
		swal({
			text: "Debe ingresar ambas fechas",
			type: "error",
			allowOutsideClick: false
		});
	}else{
		var win = window.open('printConsecutivos/'+$("#fecha1").val()+"/"+$("#fecha2").val(), '_blank');
		win.print();
	}	
});

$("#btnActualizarFacturas").click(function () {
	let array = new Array();
	
	if($("#fecha1").val() > $("#fecha2").val()){
		swal({
			text: "La fecha de inicio no puede ser mayor a la fecha final",
			type: "error",
			allowOutsideClick: false
		});
	}else if($("#fecha1").val() == "" || $("#fecha2").val() == ""){
		swal({
			text: "Debe ingresar ambas fechas",
			type: "error",
			allowOutsideClick: false
		});
	}else{
		let table = $("#tblConsecutivos").DataTable({
			"ajax": {
				"url": "reportesConsecutivos",
				"type": "POST",
				"data": function ( d ) {
					d.fecha1 = $("#fecha1").val();
					d.fecha2 = $("#fecha2").val();					
				}
			},
			"processing": true,
			"info": true,
			"sort": true,
			"destroy": true,
			"responsive": true,
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
				{"data" : "SERIE", className: "text-bold"},
				{"data" : "MINIMO"},
				{"data" : "MAXIMO"},
				{"data" : "NUMERO"}		
			]
		});
	}
});
/*******************************************************************************************/

$("#printConsecutivosTodos").click(function(){
	if($("#fechainicio").val() > $("#fechafin").val()){
		swal({
			text: "La fecha de inicio no puede ser mayor a la fecha final",
			type: "error",
			allowOutsideClick: false
		});
	}else if($("#fechainicio").val() == "" || $("#fechafin").val() == ""){
		swal({
			text: "Debe ingresar ambas fechas",
			type: "error",
			allowOutsideClick: false
		});
	}else{
		var win = window.open('printConsecutivosDetallado/'+$("#fechainicio").val()+"/"+$("#fechafin").val(), '_blank');
		win.print();
	}	
});

$("#btnMostrarConsTodos").click(function () {
	let array = new Array();
	
	if($("#fechainicio").val() > $("#fechafin").val()){
		swal({
			text: "La fecha de inicio no puede ser mayor a la fecha final",
			type: "error",
			allowOutsideClick: false
		});
	}else if($("#fechainicio").val() == "" || $("#fechafin").val() == ""){
		swal({
			text: "Debe ingresar ambas fechas",
			type: "error",
			allowOutsideClick: false
		});
	}else{
		let table = $("#tblConsecutivosTodos").DataTable({
			"ajax": {
				"url": "reporteConsecutivosDetallado",
				"type": "POST",
				"data": function ( d ) {
					d.fecha1 = $("#fechainicio").val();
					d.fecha2 = $("#fechafin").val();					
				}
			},
			"processing": true,
			"info": true,
			"sort": true,
			"destroy": true,
			"responsive": true,
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
				{"data" : "SERIE", className: "text-bold"},
				{"data" : "Consecutivo"},
				{"data" : "CODVENDEDOR"},
				{"data" : "Nombre"}		
			]
		});
	}
});

$("#printConsecutivosExcel").click(function(){
	if($("#fecha1").val() > $("#fecha2").val()){
		swal({
			text: "La fecha de inicio no puede ser mayor a la fecha final",
			type: "error",
			allowOutsideClick: false
		});
	}else if($("#fecha1").val() == "" || $("#fecha2").val() == ""){
		swal({
			text: "Debe ingresar ambas fechas",
			type: "error",
			allowOutsideClick: false
		});
	}else{
		let url = "createXLS/"+$("#fecha1").val()+"/"+$("#fecha2").val(); 
		$("#enlaceExcel").attr('href',url);
	}	
});

$("#printConsecutivosTodosExcel").click(function(){
	if($("#fechainicio").val() > $("#fechafin").val()){
		swal({
			text: "La fecha de inicio no puede ser mayor a la fecha final",
			type: "error",
			allowOutsideClick: false
		});
	}else if($("#fechainicio").val() == "" || $("#fechafin").val() == ""){
		swal({
			text: "Debe ingresar ambas fechas",
			type: "error",
			allowOutsideClick: false
		});
	}else{
		let url = "createXLSDetallado/"+$("#fechainicio").val()+"/"+$("#fechafin").val(); 
		$("#enlaceExcelTodos").attr('href',url);
	}	
});
</script>
