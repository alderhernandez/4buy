
<div class="row">
	<div class='col-9 col-sm-9 col-md-9'>
		<h2 class="h2 mt-none mb-sm ">Reporte  de Ventas</h2>
	</div>	
</div>
<!-- start: page -->
<div class="row">
	<div class="col-12 col-sm-12 col-md-12">
		<section class="panel">
			<div class="panel-body">
				<div class="invoice">
					<div class="row">						
						<div class="col-sm-12 col-12 col-md-12 col-lg-12">
							<div class="pull-right">
								<button id="btnActualizar" class="mb-xs mt-xs mr-xs btn btn-primary">
									Actualizar <i class="fa fa-download"></i>
								</button>
							</div>
							<div class="form-group col-3 col-sm-3 col-md-3">								
								<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class=""></i></span>
                                </span>
									<select id="Ruta" placeholder="Ruta" data-plugin-selectTwo  class="form-control col12 col-md-12 col-sm-12 populate">
										<option selected></option>
										<?php
										if(!$rutas){
										}else{
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
							<div class="form-group col-3 col-sm-3 col-md-3 pull-left">
								<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-calendar"></i></span>
										</span>
									<input type="text" id="fechainicio" data-plugin-skin="primary"
										   data-plugin-datepicker="" class="form-control" placeholder="Fecha Inicio" autocomplete="off">
								</div>
							</div>
							<div class="form-group col-3 col-sm-3 col-md-3 pull-left">
								<div class="input-group input-group-icon">
									<span class="input-group-addon">
										<span class="icon"><i class="fa fa-calendar"></i></span>
									</span>
									<input type="text" id="fechafin" data-plugin-skin="primary"
										   data-plugin-datepicker="" class="form-control" placeholder="Fecha Fin" autocomplete="off">
								</div>
							</div>
						</div>
						</div>

						<br>

						<hr class="dotted">
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12">
								<table id="tblrptVentas" class="table table-bordered table-striped mb-none table-sm table-condensed">
									<thead>
									<tr>
										<th>CodVendedor</th>
										<th>Vendedor</th>
										<th>N° Fact</th>
										<th>Libras</th>
										<th>UVenCred</th>
										<th>UVenCont</th>
										<th>SubTotal Cred</th>
										<th>SubTotal Cont</th>
										<th>DescCred</th>
										<th>DescCont</th>
										<th>ISCCred</th>
										<th>ISCCont</th>
										<th>IVACred</th>										
										<th>IVACont</th>
										<th>Total</th>
									</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
		</section>
	</div>
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


<div class="modal" id="modalDetalles" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	 aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document" style="width: 1100px">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">
					<i class="fa fa-info-circle">
						<span class="text-semibold">
							Remision
							<span id="txtRubro">Rubro</span>
							<span id="txtTipo">(Tipo)</span>
						</span>
					</i>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-2 col-sm-2 col-md-2 col-lg-2 form-group">
						Fecha Entrega: <input type="text" class="form-control" readonly id="FechaEntDt">
					</div>
					<div class="col-2 col-sm-2 col-md-2 col-lg-2 form-group">
						Cantidad Total: <input type="text" class="form-control" readonly id="CantTotal">
					</div>
					<div class="col-2 col-sm-2 col-md-2 col-lg-2 form-group">
						CantidadLBS Total: <input type="text" class="form-control" readonly id="CantlbsTotal">
					</div>
					<div class="col-2 col-sm-2 col-md-2 col-lg-2">
						<a id="link" target="_blank">
						  <img src="<?php echo base_url()?>assets/img/pdf.png" alt="printExcel" />
						</a>
					</div>
				</div>
				<hr class="dotted">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12">
						<table class='table table-condensed table-striped table-bordered' id="tblDetalles">
							<thead>
							<tr>
								<th>Ruta</th>
								<th>Vendedor</th>
								<th>Cliente</th>
								<th>Cod. Producto</th>
								<th>Descripcion</th>
								<th>LBS</th>
								<th>Cantidad</th>
								<th>CantidadLBS</th>
							</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>