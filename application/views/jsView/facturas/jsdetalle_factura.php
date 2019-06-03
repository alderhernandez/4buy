<script type="text/javascript">

	function modalComent() {
		$("#modalComment").modal("show");
		$("#btnAnulFactModal").hide();
	}

	$("#txtcomentAnul").on("keyup", function(){
		if($(this).val() == ""){
			$("#btnAnulFactModal").hide();
		}else{
			$("#btnAnulFactModal").show();
		}
	});

	function anular(){
		swal({
			text: "¿Estas seguro que deseas anular esta factura? Este proceso no se podra revertir",
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Aceptar',
			cancelButtonText: "Cancelar",
			allowOutsideClick: false
		}).then(result => {
			if(result.value){
				$("#loading").modal("show");
				let cons = $("#consecutivo").html();
				let sms = '', sms1 = '', tipo ='', autoriza = '';
				let form_data = {
					comentarioAnula: $("#txtcomentAnul").val()
				};
				$.ajax({
					url: "<?php echo base_url("index.php/AnularFactura")?>"+"/"+cons,
					type: "POST",
					async: true,
					data: form_data,
					success: function (data) {
						if(data){
							let obj = jQuery.parseJSON(data);
							$.each(obj, function(key, value){
								sms = value["mensaje"];
								sms1 = value["mensaje1"];
								tipo = value["tipo"];
							});
							if(sms != ''){
								$("#loading").modal("hide");
								swal({
									title: sms1,
									text: sms,
									type: tipo,
									allowOutsideClick: false
								});
							}else{
								$("#loading").modal("hide");
								swal({
									type: "success",
									text: "Factura #"+cons+" anulada ",
									allowOutsideClick: false
								}).then(result => {
									location.reload();
								});
							}
						}else{
							$("#loading").modal("hide");
							swal({
								text: "No tienes permiso para realizar esta operación",
								type: "error",
								allowOutsideClick: false
							});
						}
					}
				});
			}
		});
	}

	function Editar(id,codigo,descripcion,Precio,txtCantidad,Subtotal,ISC,IVA,Total) {
		$("#IdEnc").val(id);
		$("#codigo").val(codigo);
		$("#descripcion").val(descripcion);
		$("#Precio").val(Precio);
		$("#txtCantidad").val(txtCantidad);
		$("#Subtotal").val(Subtotal);
		$("#ISC").val(ISC);
		$("#IVA").val(IVA);
		$("#Total").val(Total);
		$("#modalEditar").modal("show");
	}


	$("#txtCantidad").on("keyup", function () {
		let subtotal = 0, total = 0;
		subtotal = $(this).val() * $("#Precio").val();
		total = subtotal + (Number($("#ISC").val()) + Number($("#IVA").val()));
		$("#Subtotal").val(subtotal.toFixed(2));
		$("#Total").val(total.toFixed(2));
	});

$("#btnUpdItem").click(function(){
	swal({
		text: "¿Estas seguro que deseas actualizar este item?, Este proceso afectará el total de la factura",
		type: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Aceptar',
		cancelButtonText: "Cancelar",
		allowOutsideClick: false
	}).then(result=>{
		if(result.value){
			let sms = '', tipo = '';
			let form_data = {
				iddetalle: $("#IdEnc").val(),
				cant: $("#txtCantidad").val(),
				total: $("#Total").val()
			};
			$.ajax({
				url: "<?php echo base_url("index.php/ActualizarItemFactura")?>",
				type: "POST",
				data: form_data,
				beforeSend: function(){
					if($("#txtCantidad").val() == "" || $("#txtCantidad").val() == 0){
						$.ajax().abort();
					}
				},
				success: function (data) {
					let obj = jQuery.parseJSON(data);
					$.each(obj, function (item,value) {
						sms = value["mensaje"];
						tipo = value["tipo"];
					});
					swal({
						text: sms,
						type: tipo,
						allowOutsideClick: false
					}).then(result=>{
						location.reload();
					});
				}
			});
		}
	});
});
</script>
