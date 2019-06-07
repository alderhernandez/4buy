<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 23/2/2019 11:36 2019
 * FileName: jsliquidacion.php
 */
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#txtMerma").numeric();
		$("#thisid").select2({
			placeholder: '--- Seleccione un Producto ---',
			allowClear: true,
			ajax: {
				url: '<?php echo base_url("index.php/ProductosListMerma")?>',
				dataType: 'json',
				type: "POST",
				quietMillis: 100,
				data: function (term) {
					return {
						q: term
					};
				},
				results: function (data) {
					$("#campo").empty();
					let res = [];
					for(let i  = 0 ; i < data.length; i++) {
						res.push({id:data[i].ItemCode, text:data[i].ItemName});
						/*$("#campo").append('<input type="hidden" name="" id="'+data[i].ItemCode+'txtpeso" class="form-control" value="'+data[i].SWeight1+'">');*/
					}
					return {
						results: res
					}
				},
				cache: true
			}
		}
	).trigger('change.select2');


		$("#tblDetFactLiq").DataTable({
			//"scrollX": true,
			"searching": false,
			"info": false,
			"sort": true,
			"order": [0, "asc"],
			"bFilter" : false,
			"bLengthChange": false,
			"paginate": false,
			"columnDefs": [
				{
					"targets": [ 10,12,14,16 ],
					"visible": false,
					"orderable": false
				}
			],
			drawCallback: function () {
				let api = this.api();
				$( api.table().column(17).footer() ).html(
					api.column( 17, {page:'current'} ).data().sum().toFixed(2)
				);
				$( api.table().column(18).footer() ).html(
					api.column( 18, {page:'current'} ).data().sum().toFixed(2)
				);
				$( api.table().column(19).footer() ).html(
					api.column( 19, {page:'current'} ).data().sum().toFixed(2)
				);

			}
		});

		$("#Unidades").DataTable({
			"searching": false,
			"info": false,
			"sort": true,
			"ordering":false,
			"bFilter" : false,
			"bLengthChange": false,
			"paginate": false,
			drawCallback: function () {
			let api = this.api();
			$( api.table().column(6).footer() ).html(
				api.column( 6, {page:'current'} ).data().sum().toFixed(2)
			);

		}
		});
	});


	$("#Unidades tbody").on("click", "tr", function(){
		$(this).toggleClass("primary");
		if($(this).hasClass("primary")){
			$("#btnSaveRem").hide();
		}else{
			$("#btnSaveRem").show();
		}
	});


	$("#btnLiquidar").on("click", function () {
		swal({
			title: '<img src="<?php echo base_url()?>assets/img/error.png" alt="4BUY" />',
			text: "¿Estas seguro que deseas proceder con esta liquidación?"+
			" Se cerrará el periodo de liquidacion y las facturas pendientes relacionadas" +
				" a este periodo ya no podran ser liquidadas." +
				"Verifica que todos los datos de las facturas estén completos antes de proceder.",
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Liquidar',
			cancelButtonText: "Cancelar",
			allowOutsideClick: false,
			width: 600,
		}).then(result => {
			if(result.value){
				$("#loading").modal("show");
				let unid = 0, sub = 0, isc = 0, iva= 0, total = 0, lbstotal = 0;
				let table = $("#tblDetFactLiq").DataTable();
				let array = new Array(), i = 0;
				let sms = '', tipo = '';
				table.rows().eq(0).each(function (index) {
					let row = table.row(index);
					let datos = row.data();
					unid += (Number(datos[6].replace(",","")) + Number(datos[7].replace(",","")));
					sub += (Number(datos[9].replace(",","")) + Number(datos[10].replace(",","")));
					isc += (Number(datos[13].replace(",","")) + Number(datos[14].replace(",","")));
					iva += (Number(datos[15].replace(",","")) + Number(datos[16].replace(",","")));
					total += (Number(datos[17].replace(",","")) + Number(datos[18].replace(",","")));
					lbstotal += (Number(datos[19].replace(",","")));

					array[i] = datos[0]+","+datos[1]+","+datos[2]+","+datos[3].replace(",","")+","+datos[4].replace(",","")+","+datos[5].replace(",","")+","+datos[6].replace(",","")+","+datos[7].replace(",","")+","+datos[8].replace(",","")+","+datos[9].replace(",","")+","+datos[10].replace(",","")+","+datos[11].replace(",","")+","+datos[12].replace(",","")+","+datos[13].replace(",","")+","+datos[14].replace(",","")+","+datos[15].replace(",","")+","+datos[16].replace(",","")+","+datos[17].replace(",","")+","+datos[18].replace(",","")+","+datos[19].replace(",","")+","+datos[20].replace(",","");
					i++;
				});

				let form_data = {
					datos: array,
					top: [
						$("#idperiodo").html(),
						$("#tipo").html(),
						$("#ruta").html(),
						unid,
						sub,
						isc,
						iva,
						total,
						lbstotal
					]
				};

				$.ajax({
					url: "<?php echo base_url("index.php/GuardarLiquidacion")?>",
					type: "POST",
					data: form_data,
					beforeSend: function (){
						if(!$("#idperiodo")){
							$.ajax().abort();
							swal({
								text: "No hay datos disponibles para llevar a cabo la liquidación",
								type: "error",
								allowOutsideClick: false
							});
						}
					},
					success: function(data){
						let obj = jQuery.parseJSON(data);
						$.each(obj, function (index, value) {
							sms = value["mensaje"];
							tipo = value["tipo"];
						});

						$("#loading").modal("hide");
						swal({
							type: tipo,
							text: sms,
							allowOutsideClick: false
						}).then(result => {
							location.reload();
						});
					},
					error: function(){
						swal({
							type: "error",
							text: "Ocurrio un error inesperado al intentar liquidar el vendedor," +
								" Contáctece con el administrador"
						});
					}
				});
			}
		});
	});

	$("#btnExport").click(function() {
		window.open();
	});

	$("#btnAddMerma").click(function(){
		let codigo = $("#thisid").val(),
		merma = $("#txtMerma").val(),
		i = 0;
		let table = $("#tblDetFactLiq").DataTable();
		let table2 = $("#Unidades").DataTable();
		let bandera = true;
		let band = true;
		$("#txtMerma").val("");
		table.rows().eq(0).each(function(index){
			let row = table.row(index);
			let data = row.data();
			if (!bandera) {
				return false;
			}
			if( data[0] == codigo){
				let num1 = (Number(data[4])) * 0.05;
				if(Number(merma) > Number(num1)){
					swal({
						html: "La cantidad de merma sobrepasa la cantidad permitida." 
						+" la merma permitida para el prod <b>"+data[0]+"</b> es de <b>("+Number(num1)+")</b>",
						type: "warning",
						allowOutsideClick: false
					});
				}else{
					let oTable = $("#tblDetFactLiq").dataTable();
					oTable.fnUpdate( [data[0],data[1],data[2],data[3],data[4],data[5],data[6],data[7]
					,data[8],data[9],data[10],data[11],data[12],data[13],data[14],data[15],data[16],
					data[17],data[18],data[19],merma],index );
					bandera = false;					
					//$("#thisid").select2().trigger("change");
					$("#select2-drop-mask").select2("val", []).trigger("change");

					//$exampleMulti.val(["CA", "AL"]).trigger("change");
					return false; 
				}
			}
			i++;
		});

		table2.rows().eq(0).each(function(index){
			let row = table2.row(index);
			let data = row.data();
			if (!band) {
				return false;
			}
			if( data[0] == codigo){
				let num = (Number(data[3]))*0.05;
				if(Number(merma) > Number(num)){
					console.log("falso");
				}else{
					let oTable1 = $("#Unidades").dataTable();
					oTable1.fnUpdate( [data[0],data[1],data[2],data[3],data[4],data[5],data[6],data[7],merma],index );
					band = false;
					return false;
				}
			}
			i++;
		});
	});
</script>
