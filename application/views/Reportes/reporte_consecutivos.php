<div class="row">
	<div class='col-9 col-sm-9 col-md-9'>
		<h2 class="h2 mt-none mb-sm ">Reporte  de Consecutivos</h2>
	</div>
</div>
<!-- start: page -->
<div class="row">
	<div class="col-12 col-sm-12 col-md-12">
		<section class="panel">
			<div class="panel-body">
				<div class="invoice">
					<div class="tabs tabs-danger">
						<ul class="nav nav-tabs tabs-primary">
							<li class="active">
								<a class="text-muted" href="#minmax" data-toggle="tab" aria-expanded="true">Minimo y maximo</a>
							</li>
							<li class="">
								<a class="text-muted" href="#todos" data-toggle="tab" aria-expanded="true">Detallado</a>
							</li>
						</ul>
						<div class="tab-content">
							<div id="minmax" class="tab-pane active">
								<div class="row">
									<div class="col-sm-12 col-12 col-md-12 col-lg-12">
										<div class="pull-right">
											<button id="btnActualizarFacturas" class="mb-xs mt-xs mr-xs btn btn-primary">
											Generar <i class="fa fa-download"></i>
											</button>
										</div>
										<div class="form-group col-3 col-sm-3 col-md-3 pull-left">
											<div class="input-group input-group-icon">
												<span class="input-group-addon">
													<span class="icon"><i class="fa fa-calendar"></i></span>
												</span>
												<input type="text" id="fecha1" data-plugin-skin="primary"
												data-plugin-datepicker="" class="form-control" placeholder="Fecha Inicio" autocomplete="off">
											</div>
										</div>
										<div class="form-group col-3 col-sm-3 col-md-3 pull-left">
											<div class="input-group input-group-icon">
												<span class="input-group-addon">
													<span class="icon"><i class="fa fa-calendar"></i></span>
												</span>
												<input type="text" id="fecha2" data-plugin-skin="primary"
												data-plugin-datepicker="" class="form-control" placeholder="Fecha Fin" autocomplete="off">
											</div>
										</div>
									</div>
								</div>
								<br>
								<hr class="dotted">
								<div class="row">
									<div class="col-12 col-sm-12 col-md-12">
										<table id="tblConsecutivos" class="table table-condensed table-bordered table-responsive table-striped mb-none table-sm">
											<thead>
												<tr>
													<th>SERIE</th>
													<th>MINIMO</th>
													<th>MAXIMO</th>
													<th>No FACTURAS</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="text-right mr-lg">
										<?php
											echo '
												<div class="text-right mr-lg">
												   <a href="#" id="enlaceExcel">
														<img id="printConsecutivosExcel" src="'.base_url().'assets/img/excel.png" alt="printExcel" />
													</a>
													<a href="#">
														<img id="printConsecutivos" src="'.base_url().'assets/img/pdf.png" alt="printPDF" />
													</a>
											</div>
											';
										?>
									</div>
								</div>
							</div>
							<div id="todos" class="tab-pane">
								<div class="row">
									<div class="col-sm-12 col-12 col-md-12 col-lg-12">
										<div class="pull-right">
											<button id="btnMostrarConsTodos" class="mb-xs mt-xs mr-xs btn btn-primary">
											Generar <i class="fa fa-download"></i>
											</button>
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
										<table id="tblConsecutivosTodos" class="table table-condensed table-bordered table-responsive table-striped mb-none table-sm">
											<thead>
												<tr>
													<th>SERIE</th>
													<th>CONSECUTIVO</th>
													<th>RUTA</th>
													<th>NOMBRE VENDEDOR</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="text-right mr-lg">
										<?php
											echo '
												<div class="text-right mr-lg">
												   <a href="#" id="enlaceExcelTodos">
														<img id="printConsecutivosTodosExcel" src="'.base_url().'assets/img/excel.png" alt="printExcel" />
													</a>
													<a href="#">
															<img id="printConsecutivosTodos" src="'.base_url().'assets/img/pdf.png" alt="printExcel" />
													</a>
											</div>
											';
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</section>
	</div>
</div>