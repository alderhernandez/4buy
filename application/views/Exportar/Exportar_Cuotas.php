<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 29/3/2019 11:45 2019
 * FileName: Exportar_Cuotas.php
 */
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
					<div class="col-sm-2 mt-md">
						<h2 style="font-size:12px;" class="h2 mt-none mb-sm text-dark text-bold">Reporte metas por vendedor</h2>
					</div>
					<div class="col-sm-2 mt-md">
						<p class="mb-none">
							<span class="text-dark text-semibold">Desde</span>
							<span class="value"></span>
						</p>
						<?php
						  echo $this->uri->segment(2)
						?>
					</div>
					<div class="col-sm-2 mt-md">
						<p class="mb-none">
							<span class="text-dark text-semibold">Hasta</span>
							<span class="value"></span>
						</p>
						<?php
						   echo $this->uri->segment(3)
						?>
					</div>
					<div class="col-sm-2 mt-md">
						<p class="mb-none">
							<span class="text-dark text-semibold">Ruta</span>
							<span class="value"></span>
						</p>
						<?php
						  if($this->uri->segment(4) == "null"){
								echo "Todas";
						  }else{
							  echo str_replace("%20"," ",$this->uri->segment(4));
						  }
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
				<?php
				if(!$rubros){
				}else {
					foreach ($rubros as $key){
						echo '
							<table class="table table-striped table-condensed table-bordered">
								<thead>
									<tr>
										<th class="text-center" style="width: 45px">IdRuta</th>
										<th class="text-center">Descripcion</th>
										<th class="text-center" style="width: 150px">Nombre</th>
										<th class="text-center">Cuota <br> mensual</brt></th>
										<th class="text-center">libras <br> vendidas</th>
										<th class="text-center">Cuota a <br> llevar</th>
										<th class="text-center">GAP <br> libras</th>
										<th class="text-center">falta <br> vender</th>
										<th class="text-center">avance <br> ventas</th>
										<th class="text-center">cumplimiento</th>
										<th class="text-center">promedio <br> diario</th>
										<th class="text-center">dias <br> efectivos</th>
										<th class="text-center">primer <br> dia</th>
										<th class="text-center">dias <br> transcurridos</th>
										<th class="text-center">Proyectando Vender</th>
									</tr>	
								</thead>
								<tbody>';
						if(!$cuotas){
						}else{
							foreach ($cuotas as $cuota) {
								if($key["DESCRIPCION"] == $cuota["Descripcion"]){
									echo '
										<tr>
											<td class="text-right">'.$cuota["IdRuta"].'</td>
											<td class="text-right">'.$cuota["Descripcion"].'</td>
											<td class="text-right">'.$cuota["Nombre"].'</td>
											<td class="text-right">'.number_format($cuota["CUOTAMENSUAL"],2).'</td>
											<td class="text-right">'.number_format($cuota["LIBRAS_VENDIDAS"],2).'</td>
											<td class="text-right">'.number_format($cuota["CUOTA_A_LLEVAR"],2).'</td>
											<td class="text-right">'.number_format($cuota["GAP_LIBRAS"],2).'</td>
											<td class="text-right">'.number_format($cuota["FALTA_VENDER"],2).'</td>
											<td class="text-right">'.number_format($cuota["AVANCE_VENTAS"],2).'%</td>
											<td class="text-right">'.number_format($cuota["CUMPLIMIENTO"],2).'%</td>
											<td class="text-right">'.number_format($cuota["PROMEDIO_DIARIO"],2).'</td>
											<td class="text-right">'.$cuota["DIAS_EFECTIVOS"].'</td>
											<td class="text-right">'.$cuota["PRIMER_DIA"].'</td>
											<td class="text-right">'.$cuota["DIAS_TRANSCURRIDOS"].'</td>
											<td class="text-right">'.number_format($cuota["PROMEDIO_DIARIO"]*$cuota["DIAS_EFECTIVOS"],2).'</td>
										</tr>';

								}
							}
						}
						echo '</tbody>
						<tfoot>';
						if(!$cuotas){
						}else{
							$cm=0; $lv=0; $cal=0;$gap=0;$fv=0; @$av=0; $cump =0;$promedio=0;$pv =0;
							foreach ($cuotas as $cuota) {
								if($key["DESCRIPCION"] == $cuota["Descripcion"]){
									$cm += $cuota["CUOTAMENSUAL"];
									$lv += $cuota["LIBRAS_VENDIDAS"];
									$cal += $cuota["CUOTA_A_LLEVAR"];
									$gap += $cuota["GAP_LIBRAS"];
									$fv += $cuota["FALTA_VENDER"];
									$cump = $lv/(($cm/$cuota["DIAS_EFECTIVOS"])*$cuota["DIAS_TRANSCURRIDOS"])*100;
									$promedio = $lv/$cuota["DIAS_TRANSCURRIDOS"];
									$pv += ($cuota["PROMEDIO_DIARIO"]*$cuota["DIAS_EFECTIVOS"]);
								}
							}
							@$av = ($lv/$cm)*100;
							echo '
										<tr style="font-weight:bold;">
											<td class="text-center" colspan="3">Total por canal</td>
											<td class="text-right">'.number_format($cm,2).'</td>
											<td class="text-right">'.number_format($lv,2).'</td>
											<td class="text-right">'.number_format($cal,2).'</td>
											<td class="text-right">'.number_format($gap,2).'</td>
											<td class="text-right">'.number_format($fv,2).'</td>
											<td class="text-right">'.number_format($av,2).'%</td>
											<td class="text-right">'.number_format($cump,2).'%</td>
											<td class="text-right">'.number_format($promedio,2).'</td>
											<td class="text-right"></td>
											<td class="text-right"></td>
											<td class="text-right"></td>
											<td class="text-right">'.number_format($pv,2).'</td>
										</tr>
								';
						}
						echo'</tfoot>
						 </table>	
						     ';
					}
				}
					if(!$cuotas){
						}else{
							$cm=0; $lv=0; $cal=0;$gap=0;$fv=0; @$av=0; $cump =0;$promedio=0;$pv =0;
							foreach ($cuotas as $cuota) {
									$cm += $cuota["CUOTAMENSUAL"];
									$lv += $cuota["LIBRAS_VENDIDAS"];
									$cal += $cuota["CUOTA_A_LLEVAR"];
									$gap += $cuota["GAP_LIBRAS"];
									$fv += $cuota["FALTA_VENDER"];
									$cump = $lv/(($cm/$cuota["DIAS_EFECTIVOS"])*$cuota["DIAS_TRANSCURRIDOS"])*100;
									$promedio = $lv/$cuota["DIAS_TRANSCURRIDOS"];
									$pv += ($cuota["PROMEDIO_DIARIO"]*$cuota["DIAS_EFECTIVOS"]);
							}
							@$av = ($lv/$cm)*100;
							echo '
							<table class="table table-striped table-condensed table-bordered">
								<thead>
 									<tr style="font-weight:bold;">
											<th width="281px" class="text-center" colspan="3">TOTAL VENTA NACIONAL</td>
											<th class="text-right">'.number_format($cm,2).'</td>
											<th class="text-right">'.number_format($lv,2).'</td>
											<th class="text-right">'.number_format($cal,2).'</td>
											<th class="text-right">'.number_format($gap,2).'</td>
											<th class="text-right">'.number_format($fv,2).'</td>
											<th class="text-right">'.number_format($av,2).'%</td>
											<th class="text-right">'.number_format($cump,2).'%</td>
											<th class="text-right">'.number_format($promedio,2).'</td>
											<th class="text-right"></td>
											<th class="text-right"></td>
											<th class="text-right"></td>
											<th class="text-right">'.number_format($pv,2).'</td>
										</tr>
								</thead>		
								<tbody></tbody>
							</table>
								';
						}

				?>
			</div>
			<br>
			<br>
			<!--<div class="row center" style="margin-top: -15px">
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
			<div class="invoice-summary">
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

