<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 22/3/2019 16:50 2019
 * FileName: cuotas.php
 */
?>

<div class="row">
	<div class='col-12 col-sm-12 col-md-12'>
		<div class="pull-right">
			<button id="newUserbtn" data-toggle="modal" class="mb-xs mt-xs mr-xs btn btn-primary" data-target="">
				Agregar <i class="fa fa-plus"></i>
			</button>
		</div>
	</div>
</div>
<!-- start: page -->
<div class="row">
	<div class="col-12 col-sm-12 col-md-12">
		<section class="panel col-12 col-sm-12 col-md-12">
			<header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="fa fa-caret-down"></a>
				</div>

				<h2 class="panel-title">Cuotas</h2>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-striped mb-none table-sm table-condensed" id="datatable">
					<thead>
					<tr>
						<th>Mes Cuota</th>
						<th>Cod Ruta</th>
						<th>Num Ruta</th>
						<th>Cuota mensual</th>
						<th>Días hábiles</th>
						<th>Fecha Crea</th>
						<th>Fecha Edita</th>
						<th>Estado</th>
						<th>Acciones</th>
					</tr>
					</thead>
					<tbody>
					 <?php
					 $estado = '';
					  if(!$cuotas){
					  }else{
						  foreach ($cuotas as $cuota) {
						  	if($cuota["ESTADO"] == 1){
								$estado = "<p class='text-success'>Activo</p>";
							}
							  echo "<tr>
							  		<td>".$cuota["MES"].'/'.$cuota["ANIO"]."</td>
							  		<td>".$cuota["IDRUTA"]."</td>
							  		<td>".$cuota["NUMRUTA"]."</td>
							  		<td>".number_format($cuota["CUOTAMENSUAL"],2)."</td>
							  		<td>".$cuota["DIAS_EFECTIVOS"]."</td>
							  		<td>".$cuota["FECHACREA"]."</td>
							  		<td>".$cuota["FECHAEDITA"]."</td>
							  		<td>".$estado."</td>
							  		<td class='center'>
											  <a href='javascript:void(0)' onclick='editar(".'"'.$cuota["IDCUOTA"].'",
											  "'.$cuota["CUOTAMENSUAL"].'",
											  "'.$cuota["DIAS_EFECTIVOS"].'",
											  "'.$cuota["IDRUTA"].'",
											  "'.$cuota["NUMRUTA"].'"'.")'
											   class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></a>
										
							  		</td>
							  </tr>";
					  	}
					  }
					 ?>
					</tbody>
				</table>
			</div>
		</section>
	</div>
</div>

<div class="row">

</div>

<div class="row">

</div>

<div class="modal fade" id="nuevoUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title"><i class="fa fa-flag-checkered"> <span id="tituloModal"></span></i></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<input type="hidden" id="idCuota">
					<div class="col-4 col-sm-4 col-md-4">
						<div class="form-group">
							<label class="col-md-4 control-label" for="CuotaMensual">Cuota</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-dollar"></i></span>
                                </span>
								<input autocomplete="off" type="text" id="CuotaMensual" placeholder="Cuota Mensual" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-3 col-sm-3 col-md-3">
						<div class="form-group">
							<label class="col-md-3 control-label" for="Diashabiles">Dias</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-clock-o"></i></span>
                                </span>
								<input autocomplete="off" type="text" id="Diashabiles" placeholder="Dias hábiles"
									   class="form-control">
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-6 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label class="col-md-6 control-label" for="Rutas">Rutas</label>
							<div class="input-group input-group-icon">
							  <span class="input-group-addon">
									<span class="icon"></span>
                                </span>
								<select id="Rutas" data-plugin-selectTwo  class="form-control col12 col-md-12 col-sm-12 populate">
									<option selected></option>
									<?php
									if (!$rutas) {
									} else {
										foreach ($rutas as $ruta){
											echo '
														<option value='.$ruta["IdRuta"].'>'.$ruta["Ruta"].'</option>
													';
										}
									}

									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-3 col-sm-3 col-md-3">
						<div class="form-group">
							<label class="col-md-3 control-label" for="Mes">Meses</label>
							<div class="input-group input-group-icon">
							  <span class="input-group-addon">
									<span class="icon"></span>
                                </span>
								<select id="Mes" data-plugin-selectTwo  class="form-control col12 col-md-12 col-sm-12 populate">
									<?php
									$Meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
										'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

									for ($i=1; $i<=12; $i++) {
										if ($i == date('m'))
											echo '<option value="'.$i.'"selected>'.$Meses[($i)-1].'</option>';
										else
											echo '<option value="'.$i.'">'.$Meses[($i)-1].'</option>';
									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-3 col-sm-3 col-md-3">
						<div class="form-group">
							<label class="col-md-3 control-label" for="year">Año</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-calendar"></i></span>
                                </span>
								<input readonly value="<?php echo date("Y")?>" autocomplete="off" type="text" id="year"
									   class="form-control">
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 pull-right">
						<button type="button" id="btnSaveCuota" class="btn btn-primary">Guardar</button>
						<button type="button" id="btnUpdCuota" style='display:none;' class="btn btn-primary">Actualizar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

