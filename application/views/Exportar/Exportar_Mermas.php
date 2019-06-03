
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
				            <th width="71" class="text-center text-bold">Descripcion</th>
                            <th width="46" class="text-center text-bold">Total</th>
                            <?php 
                                for ($i=1; $i <=31 ; $i++) { 
                                   echo '
                                           <th>'.$i.'</th>
                                      ';
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
                                        <td class="text-center">'.$key["codigo"].'</td>
                                        <td style="font-size:8px;" class="text-center" wid>'.$key["Descripcion"].'</td>
                                        <td class="text-center">'.$key["Total"].'</td>
                                        ';
                                        for ($i=1; $i <= 31 ; $i++) { 
                                            echo '
                                              <td class="text-center">'.$key["".$i.""].'</td>
                                            ';
                                        }
								echo '</tr>';		
							}				
					}

				}
				?>
				</tbody></table>
			</div>
			<br>
			<br>			
		</div>
</body>
</html>

