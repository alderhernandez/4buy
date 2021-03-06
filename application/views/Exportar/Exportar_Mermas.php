
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
			font-size: 9px;
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
						<h2 style="font-size:12px;" class="h2 mt-none mb-sm text-dark text-bold">Reporte de Mermas</h2>
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
							<span class="text-dark text-semibold">MES</span>
							<span class="value"></span>
						</p>
                        <?php
                        $mes = '';
						  if(!$mermas){
                        }else {							
                            foreach ($mermas as $key) {
                               $mes = $key["NombreMes"];     
                            }         
                            echo $mes;
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
				<table class="table table-striped table-condensed table-bordered">
					<thead>
						<tr>
							<th class="text-center text-bold">Codigo</th>
				            <th class="text-center text-bold">Descripcion</th>
                            <th class="text-center text-bold">Total</th>
							<?php 
                               if(!$enc){
								}else{
									foreach ($enc as $key) {
										for($i = 1; $i <= count($key); $i++){
											echo "<th>".$key["Dias"]."</th>";
										}
									}
								}
                            ?>
						</tr>	
					</thead>
				<tbody>
				<?php
				if(!$mermas){
				}else {							
						foreach ($mermas as $key) {		
							if($key["Total"] >= 0){
								echo '
									<tr>
                                        <td width="20" class="text-right">'.$key["Codigo"].'</td>
                                        <td class="text-right">'.$key["Descripcion"].'</td>
										<td class="text-right">'.number_format($key["Total"],2).'</td>';
										if(!$enc){
										}else{
											foreach ($enc as $key1) {
												for($i = 1; $i <= count($key1); $i++){
													if($key["DIA".$key1["Dias"].""] != NULL){
														echo "<td class='text-right'>".number_format($key["DIA".$key1["Dias"].""],2)."</td>";
													}else{
														echo "<td class='text-right'>0.00</td>";
													}
												}
											}
										}
							 echo' </tr>';		
						}				
					}
				}
				?>
				</tbody>
				<tfoot>
				   <tr>
				   		<th colspan="2" class="text-bold text-center">TOTAL</th>
						<?php
						    $array = array();
							$total = 0; $dias = 0;
							if(!$mermas){
							}else {							
								foreach ($mermas as $key) {
									$total += $key["Total"];		
								}
								echo '<th class="text-right">'.number_format($total,2).'</th>';

							}
						?>

						<?php 
                               if(!$enc){
								}else{
									foreach ($enc2 as $key) {
										for($i = 1; $i <= count($key); $i++){											
											$pinky = 0;	
											foreach ($mermas as $key2) {												
													$pinky += $key2[$key["Dias"]];												
											}										
											echo '<td class="text-right">'.number_format($pinky,2).'</td>';
											$pinky = 0;

										}
									}
								}
							?>
				   </tr>
				</tfoot>
				</table>
			</div>
			<br>
			<br>			
		</div>
</body>
</html>

