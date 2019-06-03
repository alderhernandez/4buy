<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 1/3/2019 15:28 2019
 * FileName: Excel_liquidacion_unidades.php
 */
?>
<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 26/2/2019 11:46 2019
 * FileName: Excel_liquidacion.php
 */
$ruta = '';
if(!$det){
}else{
	foreach ($det as $item) {
		$ruta = $item["CODVENDEDOR"];
	}
}
$fecha1 = '';$fecha2 = '';
if(!$liq){
}
else {
	foreach ($liq as $key) {
		$fecha1 = date_format(new DateTime($key["FechaInicio"]), "Y-m-d");
		$fecha2 = date_format(new DateTime($key["FechaFinal"]), "Y-m-d");
	}
}

/*header("Content-type:application/charset='UTF-8'");
header("Content-Disposition: attachment; filename = Ruta ".$ruta.' '.$fecha1.' al '.$fecha2.".xls");
header("Pragma: no-cache");
header("Expires: 0");*/
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.css" />
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/theme.css" />
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/skins/default.css" />
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/theme-custom.css">
	<style>
		body{
			font-size: 11px;
		}
		.bold{font-weight: bolder}
	</style>
	<script type="text/javascript">
		window.print();
	</script>
</head>
<body>
<section class="panel" id="printHTML">
	<div class="panel-body">
		<div class="invoice">
			<header class="clearfix">
				<div class="row">
					<div class="col-sm-3 mt-md">
						<h2 style="font-size:12px;" class="h2 mt-none mb-sm text-dark text-bold">LIQUIDACION</h2>
						<?php
						$fecha1 = '';$fecha2 = '';
						if(!$liq){
						}
						else{
							foreach ($liq as $key)
							{
								echo "				
										   <p class='bold text-dark text-semibold'>
											 Desde : ".date_format(new DateTime($key["FechaInicio"]),"Y-m-d h:i:s")." 
										   </p>
										   <p class='bold text-dark text-semibold'>
											 Hasta: ".date_format(new DateTime($key["FechaFinal"]), "Y-m-d h:i:s")."
											</p>
										 ";
							}
						}
						?>
					</div>
					<div class="col-sm-3 mt-md">
						<?php
						$ruta = ''; $vendedor = '';
						if(!$det){
						}else{
							foreach ($det as $item) {
								$ruta = $item["CODVENDEDOR"];
								$vendedor = $item["NomVendedor"]." ".$item["Apellidos"];
							}
							echo '
											<p style="font-size:11px;" class="h5 mb-xs text-dark text-semibold">Datos vendedor</p>
											<address>
											<p class="mb-none">
												<span class="text-dark">Ruta:</span>
												<span class="value" id="ruta">'.$ruta.'</span>
											</p>
											<p class="mb-none">
												<span class="text-dark">Nombre:</span>
												<span class="value">'.$vendedor.'</span>
											</p>
											<p class="mb-none">
												<span class="text-dark">Tipo Venta:</span>
												<span class="value" id="tipo">Venta</span>
											</p>
											</address>
										';
						}
						?>
					</div>
					<div class="col-sm-2 mt-md">
						<p class="mb-none">
							<span class="text-dark text-semibold">Nota</span>
							<span class="value"></span>
						</p>
						<?php
						if(!$liq){
						}else{
							foreach($liq as $key){
								if($key["Liquidado"] == "N"){
									echo '
													<p class="mb-none">
														<span class="danger">Pendiente liquidar</span>
														<span class="value"></span>
													</p>
												';
								}else{
									echo '
													<p class="mb-none">
														<span class="info text-primary text-semibold">Liquidado</span>
														<span class="value"></span>
													</p>
												';
								}
							}
						}
						?>
					</div>
					<div class="col-sm-2 mt-md">
						<p class="mb-none">
							<span class="text-dark text-semibold">Liquidador</span>
							<span class="value"></span>
						</p>
						<?php
						echo $this->session->userdata('Name')." ".$this->session->userdata('Apelli');
						?>
					</div>
					<div class="col-sm-2 mt-md">
						<p class="mb-none">
							<span class="text-dark text-semibold">Impreso el</span>
							<span class="value"></span>
						</p>
						<?php
						date_default_timezone_set("America/Managua");
						echo date("d-m-Y h:i:s A");
						?>
					</div>
				</div>
			</header>

			<div class="" style="margin-top: -18px">
				<table id="tblDetFactLiq" class="table table-condensed table-striped table-bordered">
					<thead>
					<tr class="text-dark">
						<th class='text-center' style="width:6%;">CODIGO</th>
						<th class='text-center'>DESCRIPCION</th>
						<th class='text-center'>GRAMOS</th>
						<th class='text-center'>REMISION</th>
						<th class='text-center'>UNIDADES</th>
						<th class='text-center'>LIBRAS</th>
						<th class='text-center'>TOTAL</th>
					</tr>
					</thead>
					<tbody>
					<?php
						if(!$det1){
						}else{
							foreach ($det1 as $key) {
								echo "
									<tr style='font-size:9px;'>
										<td class='text-center' style='width: 10px'>".$key["CODIGO"]."</td>	
										<td class='text-left'>".$key["DESCRIPCION"]."</td>	
										<td class='text-center'>".number_format($key["GRAMOS"],2)."</td>
										<td class='text-center'>".number_format($key["REMISION"],2)."</td>
										<td class='text-center'>".number_format($key["UNIDADES"],2)."</td>	
										<td class='text-center'>".number_format($key["LIBRAS"],2)."</td>
										<td>".number_format($key["TOTAL"],2)."</td>	
									</tr> 	  
								";
							}
						}
					?>
					</tbody>
					<tfoot>
					<?php
					$total = 0; $unidades = 0;
					if(!$det1){
					}else{
						foreach ($det1 as $key) {
							$unidades += $key["UNIDADES"];
							$total += $key["LIBRAS"];
						}
						echo "
									<tr class='bg-primary'>
										<th class='text-center'>TOTAL</th>
										<th class='text-center'></th>
										<th class='text-center'></th>
										<th class='text-center'></th>
										<th class='text-center'></th>
										<th class='text-center'>".number_format($unidades,2)."</th>
										<th class='text-center'>".number_format($total,2)."</th>
									</tr>  
								";
					}
					?>
					</tfoot>
				</table>
			</div>
			<br>
			<br>
			<div class="row center" style="margin-top: -15px">
				<div class="col-4 col-sm-4 col-md-4">
					<p>----------------------------------------------------------</p>
					<p>Firma Vendedor</p>
				</div>
				<div class="col-4 col-sm-4 col-md-4">
					<p>----------------------------------------------------------</p>
					<p>Firma Liquidador</p>
				</div>
				<div class="col-4 col-sm-4 col-md-4">
					<p>----------------------------------------------------------</p>
					<p>Firma Responsable Caja</p>
				</div>
			</div>
			<!--<div class="invoice-summary">
					<div class="row">
						<div class="col-sm-8">
						</div>
						<div class="col-sm-4 col-sm-offset-0">
							<table class="table h5 text-dark">
								<tbody>
								<?php
			/*$sumsubtotal = 0; $total = 0; $isc = 0; $iva = 0;
                echo '
                        <tr class="b-top-none">
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
                            <td class="">C$ '.number_format($total,2).'</td>
                        </tr>
                    ';*/
			?>
								</tbody>
							</table>
						</div>
					</div>
				</div>-->
		</div>



</body>
</html>

