<html>
<head>
	<link rel="shortcut icon" href="<?PHP echo base_url();?>assets/img/LOGOS_DELMOR1.png">
	<title>4BUY</title>
	<!-- Basic -->
	<meta charset="UTF-8">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Vendor CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.css" />

	<!-- Invoice Print Style -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/factura_print.css" />

	<style>
		#footer {
			position: fixed;
			left: 0;
			bottom: 0;
			width: 100%;
			text-align: left;
		}
	</style>
</head>
<body>
<div class="invoice">
	<header class="clearfix">
		<div class="row">
			<div class="col-sm-6 mt-md">
				<h2 class="h2 mt-none mb-sm text-dark text-bold">FACTURA</h2>
				<?php
				$consecutivo = ''; $estadofact = ''; $condpago = "";
				if(!$detalles){
				}else{
					foreach ($detalles as $key){
						$consecutivo = $key["IDFACTURA"];
						$estadofact = $key["ESTADOFACT"];
						if($key["CODCONDPAGO"] == "-1"){
							$condpago = 'Contado';
						}else{
							$condpago = 'Credito';
						}
					}
					echo "
										<h4 class='h4 m-none text-dark text-bold'># <span id='consecutivo'>".$consecutivo."</span></h4>
										<p>Estado : ".$estadofact."</p>
										<p>Tipo:".$condpago."</p>
									";
				}
				?>
				<p>Documento no válido como factura oficial.</p>
			</div>
			<div class="col-sm-6 text-right mt-md mb-md">
				<address class="ib mr-xlg">
					<?php
					$codvend =''; $vendedor = ''; $tel1 = ''; $tel2 = '';
					if(!$detalles){
					}else{
						foreach ($detalles as $key) {
							$codvend = $key["CODVENDEDOR"];
							$vendedor = $key["NOMBREVENDEDOR"];
							$tel1 = $key["Telefono1"];
							$tel2 = $key["Telefono2"];
						}
						echo '
									'.$vendedor.'
									<br/>
									 CODIGO '.$codvend.'
									<br/>
									Telefono1: (+505) '.$tel1.'
									<br/>
									Telefono2: (+505) '.$tel2.'';
					}
					?>
				</address>
				<div class="ib">
					<img width="80px" src="<?php echo base_url()?>assets/img/LOGO.png" alt="dd" />
				</div>
			</div>
		</div>
	</header>
	<div class="bill-info">
		<div class="row">
			<div class="col-md-6">
				<div class="bill-to">
					<?php
					$cliente = ''; $codcli = ''; $nomcomerc = ''; $ruc= ''; $listprecio = '';
					if(!$detalles){
					}else{
						foreach ($detalles as $key) {
							$cliente = $key["NOMBRE"];
							$codcli = $key["CODCLIENTE"];
							$nomcomerc = $key["NOMBRECOMERCIAL"];
							$ruc = $key["RUC"];
							$listprecio = $key["LISTAPRECIO"];
						}
						echo '
										<p class="h5 mb-xs text-dark text-semibold">Cliente: '.$cliente.'</p>
										<address>
											Codigo: '.$codcli.'
											<br/>
											Nombre Comercial: '.$nomcomerc.'
											<br/>
											RUC: '.$ruc.'
											<br/>
											Lista de precios: '.$listprecio.'
										</address>
									';
					}
					?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="bill-data text-right">
					<?php
					$fechafact = ''; $fechavence = ''; $tiempo = '00:00:00';
					if(!$detalles){
					}else{
						foreach ($detalles as $key){
							$fechafact = $key["FECHA"];
							$fechavence = $key["FECHAVENCE"];
							$tiempo = $key["TIEMPO"];
						}
						echo '
										<p class="mb-none">
											<span class="text-dark text-semibold">Fecha Factura:</span>
											<span class="value ">'.date_format (new DateTime($fechafact), 'd-m-Y').'</span>
										</p>
										<p class="mb-none">
											<span class="text-dark">Fecha Vence:</span>
											<span class="value">'.date_format(new DateTime($fechavence), "d-m-Y").'</span>
										</p>
										<p class="mb-none">
											<span class="text-dark">Duracion Facturacion:</span>
											<span class="value">'.$tiempo.'</span>
										</p>
									';
					}
					?>
				</div>
			</div>
		</div>
	</div>

	<div class=>
		<table class="table invoice-items" id="tblDetFact">
			<thead>
			<tr class="h4 text-dark">
				<th id="cell-id"     class="text-semibold">codigo</th>
				<th id="cell-desc"   class="text-semibold">producto</th>
				<th id="cell-item"   class="text-semibold">Precio</th>
				<th id="cell-price"  class="text-center text-semibold">Cantidad</th>
				<th id="cell-qty"    class="text-center text-semibold">Descuento</th>
				<th id="cell-qty"    class="text-center text-semibold">Subtotal</th>
				<th id="cell-qty"  class="text-center text-semibold">ISC</th>
				<th id="cell-qty"  class="text-center text-semibold">IVA</th>
				<th id="cell-total"  class="text-center text-semibold">Total</th>
			</tr>
			</thead>
			<tbody>
			<?php
			if(!$detalles){
			}else{
				foreach ($detalles as $key) {
					$subtotal = $key["TOTALDET"]- $key["IVADET"] - $key["ISCDET"];
					echo '
									<tr>
										<td>'.$key["CODIGO"].'</td>
										<td>'.$key["DESCRIPCION"].'</td>
										<td>'.number_format($key["PRECIO"],2).'</td>
										<td class="text-center text-dark">'.number_format($key["CANTIDAD"],2).'</td>
										<td class="text-center">'.number_format($key["DESCUENTO"],2).'</td>
										<td class="text-center">'.number_format($subtotal,2).'</td>
										<td class="text-center">'.number_format($key["ISCDET"],2).'</td>
										<td class="text-center">'.number_format($key["IVADET"],2).'</td>
										<td class="text-center">'.number_format($key["TOTALDET"],2).'</td>
									</tr>
								';
				}
			}
			?>
			</tbody>
		</table>
	</div>
	<br>
	<div class="invoice-summary">
		<div class="row">
			<div class="col-sm-8">
				<p class="align-left">Comentario</p>
				<div class="col-sm-8">

					<?php
					$comentario = '';
					if(!$detalles){
						$comentario = '';
					}else{
						foreach ($detalles as $key){
							if($key["COMENTARIO"] != ""){
								$comentario = $key["COMENTARIO"];
							}else{
								$comentario = 'Sin comentarios';
							}
						}
						echo '<textarea class="form-control" style="resize: none; width: 50%; text-align:start" name="Text1" cols="" rows="3">'.ltrim($comentario).'</textarea>';
					}
					?>
					<br>
					<p class="align-left">Comentario anulación</p>
					<div class="form-group has-error">
						<?php
						$comentario = '';
						if(!$detalles){
							$comentario = '';
						}else{
							foreach ($detalles as $key){
								if($key["COMENTARIOANULACION"] != ""){
									$comentario = $key["COMENTARIOANULACION"];
								}else{
									$comentario = 'Sin comentarios';
								}
							}
							echo '<textarea class="form-control" style="resize: none; width: 50%; text-align: left;" name="Text2" col="" rows="3">'.ltrim($comentario).'</textarea>';
						}
						?>
					</div>
			</div>
			<div class="col-sm-4 col-sm-offset-8">
				<table class="table h5 text-dark" id="tblTotales">
					<tbody>
					<?php
					$sumsubtotal = 0; $total = 0; $isc = 0; $iva = 0; $desc = 0;
					if(!$detalles){
					}else{
						foreach ($detalles as $key){
							$subtotal = $key["TOTALDET"]- $key["IVADET"] - $key["ISCDET"];
							$desc += $key["DESCUENTO"];
							$sumsubtotal += $subtotal;
							$isc += $key["ISCDET"];
							$iva += $key["IVADET"];
							$total += $key["TOTALDET"];
						}
						echo '
									<tr class="b-top-none">
											<td colspan="1">DESCUENTO</td>
											<td class="text-left">C$ '.number_format($desc,2).'</td>
										</tr>
										<tr class="">
											<td colspan="1">SUBTOTAL</td>
											<td class="text-left">C$ '.number_format($sumsubtotal,2).'</td>
										</tr>
										<tr>
											<td colspan="1">ISC</td>
											<td class="text-left">C$ '.number_format($isc,2).'</td>
										</tr>
										<tr>
											<td colspan="1">IVA</td>
											<td class="text-left">C$ '.number_format($iva,2).'</td>
										</tr>
										<tr class="h4">
											<td colspan="1">Total</td>
											<td class="">C$ '.number_format($total-$desc,2).'</td>
										</tr>
									';
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div id="footer">
		<?php
		  date_default_timezone_set("America/Managua");
		  echo "Impreso el: ".date("d-m-Y H:i:s")
		?>
	</div>
</div>
<script>
	window.print();
</script>
</body>
</html>
