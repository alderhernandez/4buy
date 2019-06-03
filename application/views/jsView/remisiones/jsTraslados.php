<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 12/3/2019 15:24 2019
 * FileName: jsTraslados.php
 */
?>
<script type="text/javascript">
	$(document).ready(function(){
	});

	$("#btnFechaAjax").click(function(){
		if($("#fechaInicio").val() > $("#fechaFin").val()){
			swal({
				text: "La fecha de inicio no puede saer mayor a la fecha final",
				type: "error",
				allowOutsideClick: false
			});
		}else if($("#fechaInicio").val() == "" || $("#fechaFin").val() == ""){
			swal({
				text: "Debe ingresar ambas fechas",
				type: "error",
				allowOutsideClick: false
			});
		}else{
			$("#dtTrasladosAjax").DataTable({
				"ajax": {
					"url": "MostrarTraslados/"+$("#fechaInicio").val()+"/"+$("#fechaFin").val(),
					"type": "POST"
				},
				"processing": true,
				"responsive": false,
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
					{"data" : "DocNum"},
					{"data" : "CreateDate"},
					{"data" : "DocDate"},
					{"data" : "Hora"},
					{"data" : "U_NAME"},
					{"data" : "Filler"},
					{"data" : "WhsName"},
					{"data" : "ToWhsCode"},
					{"data" : "ToWhsName"},
					{"data" : "Detalles"}
				]
				/*,
                drawCallback: function () {
                    let api = this.api();
                    $( api.table().column(7).footer() ).html(
                        "C" + new Intl.NumberFormat("en",
                        {
                            style: "currency",
                            currency:"USD"
                        }).format(api.column( 7, {page:'current'} ).data().sum())
                    );
                    $( api.table().column(8).footer() ).html(
                        "C" + new Intl.NumberFormat("en",
                        {
                            style: "currency",
                            currency:"USD"
                        }).format(api.column( 8, {page:'current'} ).data().sum())
                    );
                    $( api.table().column(9).footer() ).html(
                        "C" + new Intl.NumberFormat("en",
                        {
                            style: "currency",
                            currency:"USD"
                        }).format(api.column( 9, {page:'current'} ).data().sum())
                    );
                    $( api.table().column(10).footer() ).html(
                        "C" + new Intl.NumberFormat("en",
                        {
                            style: "currency",
                            currency:"USD"
                        }).format(api.column( 10, {page:'current'} ).data().sum())
                    );
                    $( api.table().column(11).footer() ).html(
                        "C" + new Intl.NumberFormat("en",
                        {
                            style: "currency",
                            currency:"USD"
                        }).format(api.column( 11, {page:'current'} ).data().sum().toFixed(2))
                    );
                }*/
			});
		}
	});

	function detalles(docentry,hora,cod_bod_ori,cod_bod_des,numdoc,fecha,bod_ori,bod_des,user){
		$("#numdoc").val(numdoc);
		$("#Fechatras").val(fecha+" "+hora);
		$("#BodOrig").val(bod_ori+" (cod "+cod_bod_ori+")");
		$("#BodDes").val(bod_des+" (cod "+cod_bod_des+")");
		$("#usuario").val(user);
		$("#tablaDetalleTraslado").DataTable({
			"ajax": {
				"url": "DetalleTraslados/"+docentry,
				"type": "POST"
			},
			"processing": true,
			"responsive": false,
			"info": true,
			"sort": true,
			"destroy": true,
			"lengthMenu": [
				[10,20,50, -1],
				[10,20,50, "Todo"]
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
				{"data" : "LineNum"},
				{"data" : "ItemCode"},
				{"data" : "Dscription"},
				{"data" : "Quantity"},
				{"data" : "Price"},
				{"data" : "LineTotal"}
			]
			,
			drawCallback: function () {
				let api = this.api();
				$( api.table().column(3).footer() ).html(parseFloat(api.column( 3, {page:'current'} ).data().sum()).toFixed(2));
				$( api.table().column(5).footer() ).html(api.column( 5, {page:'current'} ).data().sum().toFixed(2));
				/*$( api.table().column(8).footer() ).html(
					"C" + new Intl.NumberFormat("en",
					{
						style: "currency",
						currency:"USD"
					}).format(api.column( 8, {page:'current'} ).data().sum())
				);
				$( api.table().column(9).footer() ).html(
					"C" + new Intl.NumberFormat("en",
					{
						style: "currency",
						currency:"USD"
					}).format(api.column( 9, {page:'current'} ).data().sum())
				);
				$( api.table().column(10).footer() ).html(
					"C" + new Intl.NumberFormat("en",
					{
						style: "currency",
						currency:"USD"
					}).format(api.column( 10, {page:'current'} ).data().sum())
				);
				$( api.table().column(11).footer() ).html(
					"C" + new Intl.NumberFormat("en",
					{
						style: "currency",
						currency:"USD"
					}).format(api.column( 11, {page:'current'} ).data().sum().toFixed(2))
				);*/
			}
		});
		$("#modalDetTraslados").modal("show");
	}
</script>
