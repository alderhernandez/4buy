<script type="text/javascript">
 $(document).ready(function(){
    $("#tblMermas").DataTable({
			"scrollX": true,
			"destroy": true,
			"lengthMenu": [
			[10,20,50,100, -1],
			[10,20,50,100, "Todo"]
		],
		fixedColumns:   {
            leftColumns: 3
        },
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
		}
		});	
 });

 $("#btnGenerarRpt").click(function(){
    if($("#fechaRang1").val() > $("#fechaRang2").val()){
		swal({
			text: "La fecha de inicio no puede ser mayor a la fecha final",
			type: "error",
			allowOutsideClick: false
		});
	}else if($("#fechaRang1").val() == "" || $("#fechaRang2").val() == ""){
		swal({
			text: "Debe ingresar ambas fechas",
			type: "error",
			allowOutsideClick: false
		});
	}else{
            $("#tblMermas").DataTable({
                "ajax":{
                    "url": "ReporteMerma",
                    "type": "POST",
                    "data": function (d){
                        d.rango1 = $("#fechaRang1").val();
                        d.rango2 = $("#fechaRang2").val();	
                    }
                },
                "scrollX": true,
                "destroy": true,
                "processing": true,
                "lengthMenu": [
                [10,20,50,100, -1],
                [10,20,50,100, "Todo"]
            ],
            fixedColumns:   {
                leftColumns: 3
            },
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
            {"data" : "codigo", className: "text-bold"},
            {"data" : "Descripcion", className: "text-bold"},
            {"data" : "Total", className: "text-bold" },
            {"data" : "1"},
            {"data" : "2"},
            {"data" : "3"},
            {"data" : "4"},
            {"data" : "5"},
            {"data" : "6"},
            {"data" : "7"},
            {"data" : "8"},
            {"data" : "9"},
            {"data" : "10"},
            {"data" : "11"},
            {"data" : "12"},
            {"data" : "13"},
            {"data" : "14"},
            {"data" : "15"},
            {"data" : "16"},
            {"data" : "17"},
            {"data" : "18"},
            {"data" : "19"},
            {"data" : "20"},
            {"data" : "21"},
            {"data" : "22"},
            {"data" : "23"},
            {"data" : "24"},
            {"data" : "25"},
            {"data" : "26"},
            {"data" : "27"},
            {"data" : "28"},
            {"data" : "29"},
            {"data" : "30"},
            {"data" : "31"}]
      });	
    }
 });

 $("#printMermas").click(function(){
	if($("#fechaRang1").val() > $("#fechaRang2").val()){
		swal({
			text: "La fecha de inicio no puede ser mayor a la fecha final",
			type: "error",
			allowOutsideClick: false
		});
	}else if($("#fechaRang1").val() == "" || $("#fechaRang2").val() == ""){
		swal({
			text: "Debe ingresar ambas fechas",
			type: "error",
			allowOutsideClick: false
		});
	}else{
		let win = window.open('printReporteMermas/'+$("#fechaRang1").val()+"/"+$("#fechaRang2").val(), '_blank');
	}
});
</script>