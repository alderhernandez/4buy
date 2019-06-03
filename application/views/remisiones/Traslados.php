<?php
/**
 * Created by Cesar Mejía.
 * User: Sistemas
 * Date: 12/3/2019 14:37 2019
 * FileName: Traslados.php
 */
?>

<div class="row">
	<div class='col-9 col-sm-9 col-md-9'>
		<h2 class="h2 mt-none mb-sm ">Traslados</h2>
	</div>
</div>
<!-- start: page -->
<div class="row">
	<div class="col-12 col-sm-12 col-md-12">
		<section class="panel">
			<div class="panel-body">
				<div class="invoice">
					<div class="row">
					</div>
					<br>
					<div class="row">
						<!--<div class="form-group col-3 col-sm-3 col-md-3">
							<label class="col-md-3 control-label" for="ddlRutas">Ruta</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class=""></i></span>
                                </span>
								<select id="ddlRutas" data-plugin-selectTwo  class="form-control col12 col-md-12 col-sm-12 populate">
									<option selected></option>
									<?php
										/*if (!$rutas) {
										} else {
											foreach ($rutas as $ruta) {
												echo "
													<option value=".$ruta["IdRuta"].">".$ruta["Ruta"]."</option>
												";
											}
										}
											*/
										?>

								</select>
							</div>
						</div> -->
						<div class="form-group col-2 col-sm-2 col-md-2">
							<label class="col-md-6 control-label" for="fechaInicio">Desde</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-calendar"></i></span>
								</span>
								<input type="text" id="fechaInicio" data-plugin-skin="primary" data-plugin-datepicker="" class="form-control" autocomplete="off">
							</div>
						</div>
						<div class="form-group col-2 col-sm-2 col-md-2">
							<label class="col-md-12 control-label" for="fechaFin">Hasta</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-calendar"></i></span>
								</span>
								<input type="text" id="fechaFin" data-plugin-skin="primary" data-plugin-datepicker="" class="form-control" autocomplete="off">
							</div>
						</div>
						<br>
						<div class="col-2 col-sm-2 col-md-2">
							<button id="btnFechaAjax" class="btn btn-default" data-toggle="tooltip" data-placement="left" title="" data-original-title="">
								<i class="fa fa-search"></i>
							</button>
						</div>

					</div>
					<div class="row">
						<!--<div class="form-group col-5 col-sm-5 col-md-5">
							<label class="col-md-3 control-label" for="ddlClientes">Cliente</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class=""></i></span>
                                </span>
                                <input type="hidden" id=""  class="form-control col12 col-md-12 col-sm-12" />
							</div>
						</div>-->
					</div>

					<hr class="dotted">

					<div class="row">
						<!--<div class="col-12 col-sm-12 col-md-12 center">
							<h4 class="text-semibold">Facturas a integrar: <span class="badge bg-primary" id="numFact">0</span></h4>
						</div> -->
						<div class="col-12 col-sm-12 col-md-12">
							<table class="table table-bordered table-striped  table-sm table-condensed" id="dtTrasladosAjax">
								<thead>
								<tr>
									<th>Num <br> Doc</th>
									<th>Fecha <br> Creacion</th>
									<th>Fecha <br> Traslado</th>
									<th>Hora</th>
									<th>Usuario</th>
									<th>Bod. <br> Origen</th>
									<th>Nom. <br> Bod.</th>
									<th>Bod. <br> Destino</th>
									<th>Nom. <br> Bod.</th>
									<th>Detalles</th>
								</tr>
								</thead>
								<tbody style="font-size: 11.5px;">
								</tbody>

							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>

<div class="row">

</div>

<div class="row">

</div>

<div class="modal" id="loading" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content" style="background-color:transparent;box-shadow: none; border: none;">
			<div class="text-center">
				<img width="130px" src="<?php echo base_url()?>assets/img/loading.gif">
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modalDetTraslados" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title"><i class="fa fa-info-circle"> <span class="text-semibold">Detalle de Traslado</span></i></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-3 col-sm-2 col-md-2 col-lg-2 form-group">
						Num Doc <input type="text" class="form-control" readonly id="numdoc">
					</div>
					<div class="col-3 col-sm-3 col-md-3 col-lg-3 form-group">
						Fecha Traslado <input type="text" class="form-control" readonly id="Fechatras">
					</div>
					<div class="col-3 col-sm-4 col-md-4 col-lg-4 form-group">
						Bodega Origen <input type="text" class="form-control" readonly id="BodOrig">
					</div>
					<div class="col-3 col-sm-3 col-md-3 col-lg-3 form-group">
						Bodega Destino <input type="text" class="form-control" readonly id="BodDes">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-6 col-sm-6 col-md-6 col-lg-6">
						Realizado por <input type="text" class="form-control" readonly id="usuario">
					</div>
				</div>
				<hr class="dotted">

				<div>
					<table id="tablaDetalleTraslado" class='table table-condensed table-striped table-bordered'>
						<thead>
						<tr>
							<th class='center'>NÚMERO</th>
							<th class='center'>CODIGO</th>
							<th class='center'>DESCRIPCION</th>
							<th class='center'>CANTIDAD</th>
							<th class='center'>PRECIO</th>
							<th class='center'>TOTAL</th>
						</tr>
						</thead>
						<tbody>

						</tbody>
						<tfoot>
							<tr>
								<th class=''>Total</th>
								<th class=''></th>
								<th class=''></th>
								<th class=''></th>
								<th class=''></th>
								<th class=''></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>


