<div class="row">
	<div class='col-9 col-sm-9 col-md-9'>
		<h2 class="h2 mt-none mb-sm ">Integrar facturas</h2>
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
						<div class="form-group col-3 col-sm-3 col-md-3">
							<label class="col-md-3 control-label" for="ddlRutas">Ruta</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class=""></i></span>
                                </span>
								<select id="ddlRutas" data-plugin-selectTwo  class="form-control col12 col-md-12 col-sm-12 populate">
									<option selected></option>
									<?php
									if (!$rutas) {
									} else {
										foreach ($rutas as $ruta) {
											echo "
												<option value=".$ruta["IdRuta"].">".$ruta["Ruta"]."</option>
											";
										}
									}

									?>

								</select>
							</div>
						</div>
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
						<div class="form-group col-2 col-sm-2 col-md-2">
							<label class="col-md-12 control-label" for="fechaInt">Fecha Integra</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-calendar"></i></span>
								</span>
								<input type="text" id="fechaInt" data-plugin-skin="primary" data-plugin-datepicker="" class="form-control" autocomplete="off">
							</div>
						</div>
						<div class="col-2 col-sm-2 col-md-2">
							<button id="btnFechaAjax" class="mb-xs mt-xs mr-xs btn btn-default pull-right" data-toggle="tooltip" data-placement="left" title="" data-original-title="">
								 <i class="fa fa-search"></i> Calcular
							</button>
						</div>

					</div>
					<div class="row">
						<div class="col-3 col-sm-3 col-md-3 pull-right">
							<button id="btnIntegrar" class="mb-xs mt-xs mr-xs btn btn-primary pull-left" data-toggle="tooltip" data-placement="left" title="" data-original-title="">
								<i class="fa fa-database"></i> Iniciar integracion
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
						<div class="col-12 col-sm-12 col-md-12 center">
							<h4 class="text-semibold">Facturas a integrar: <span class="badge bg-primary" id="numFact">0</span></h4>
						</div>
						<div class="col-12 col-sm-12 col-md-12">
							<table class="table table-bordered table-striped  table-sm table-condensed" id="dtFacturasAjax">
								<thead>
								<tr>
									<th>Fecha</th>
									<th>Tiempo</th>
									<th>Serie</th>
									<th>Consec.</th>
									<th>Cod Cliente</th>
									<th>Nombre Cliente</th>
									<th>Pago</th>
									<th>SubTotal</th>
									<th>Desc</th>
									<th>ISC</th>
									<th>IVA</th>
									<th>Total Credito</th>
									<th>Total Contado</th>
									<th>Detalles</th>
								</tr>
								</thead>
								<tbody style="font-size: 11.5px;">
								</tbody>
								<tfoot style="font-size: 11.5px; font-weight: bolder;">
								<tr class="bg-primary">
									<th>Totales</th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th id="SubTotal"></th>
									<th id="Desc"></th>
									<th id="ISC"></th>
									<th id="IVA"></th>
									<th id="Total1"></th>
									<th id="Total"></th>
									<th></th>
								</tr>
								</tfoot>
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


<div class="modal fade" id="modalDetFactura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title"><i class="fa fa-info-circle"> <span class="text-semibold">Detalle de Factura</span></i></h4>
			</div>
			   <div class="modal-body">
					<div class="row">
						<div class="col-3 col-sm-3 col-md-3 col-lg-3 form-group">
							# Factura: <input type="text" class="form-control" readonly id="DocumentoDet">
						</div>
						<div class="col-3 col-sm-3 col-md-3 col-lg-3 form-group">
							Fecha: <input type="text" class="form-control" readonly id="FechaDet">
						</div>
						<div class="col-3 col-sm-3 col-md-3 col-lg-3 form-group">
							Ruta: <input type="text" class="form-control" readonly id="RutaDet">
						</div>
						<div class="col-3 col-sm-3 col-md-3 col-lg-3 form-group">
							Pago: <input type="text" class="form-control" readonly id="PagoDet">
						</div>
					</div>
				   <div class="row">
					   <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
						   Cliente: <input type="text" class="form-control" readonly id="ClienteDet">
					   </div>
				   </div>
				   <hr class="dotted">

				   <div>
					   <table class='table table-condensed table-striped table-bordered'>
							<thead>
								<tr>
									<th class='center'>NUMLIN</th>
									<th class='center'>CODARTICULO</th>
									<th class='center'>DESCRIPCION</th>
									<th class='center'>CANT</th>
									<th class='center'>PRECIO</th>
									<th class='center'>SUBTOTAL</th>
									<th class='center'>IVA</th>
									<th class='center'>ISC</th>
									<th class='center'>TOTAL</th>
									<th class='center'>ALMACEN</th>
								</tr>
							</thead>
						   <tbody id="tabla">

						   </tbody>
					   </table>
				   </div>

				   <hr class="dotted">

				   <div class="row">
					  <div class="col-12 col-md-12 col-sm-12 col-lg-12">
						  <div class="col-6 col-sm-6 col-md-6 col-lg-6">
						  </div>
						  <div class="col-6 col-sm-6 col-md-6 col-lg-6 ">
							  <table class="table text-dark">
								  <tbody>
										<tr class="b-top-none">
											<td colspan="2">SUBTOTAL</td>
											<td class="text-left"><span id="subtotal"></span></td>
										</tr>
										<tr>
											<td colspan="2">ISC</td>
											<td class="text-left"><span id="isc"></span></td>
										</tr>
										<tr>
											<td colspan="2">IVA</td>
											<td class="text-left"><span id="iva"></span></td>
										</tr>
										<tr class="h4">
											<td colspan="2">Total</td>
											<td class=""><span id="total"></span></td>
										</tr>

								  </tbody>
							  </table>
						  </div>
					  </div>
				   </div>
				</div>
			</div>
		</div>
	</div>
</div>

