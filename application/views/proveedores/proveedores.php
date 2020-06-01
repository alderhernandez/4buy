<div class="row">
	<div class='col-12 col-sm-12 col-md-12'>
		<!--<div class="pull-right">
			<button id="btnActualizarFacturas" class="mb-xs mt-xs mr-xs btn btn-primary">
				Actualizar <i class="fa fa-download"></i>
			</button>
		</div> -->
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

				<h2 class="panel-title">Listado de Facturas</h2>
			</header>
			<div class="panel-body">
				<div class="col-sm-12 col-12 col-md-12 col-lg-12">
					<div class="pull-right">
						<button id="btnActualizarFacturas" class="mb-xs mt-xs mr-xs btn btn-primary">
							Actualizar <i class="fa fa-download"></i>
						</button>
					</div>
					<select  name="ruta_regex" id="searchSelect_regex" class="">
						<option></option>
						<?php
						if(!$rutas){
						}else{
							foreach ($rutas as $ruta) {
								echo "<option value=".$ruta["CODVENDEDOR"].">".$ruta["CODVENDEDOR"]."</option>";
							}
						}
						?>
					</select>

					<div class="form-group col-3 col-sm-3 col-md-3 pull-left">
						<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-calendar"></i></span>
								</span>
							<input type="text" id="fechaFac1" data-plugin-skin="primary"
								   data-plugin-datepicker="" class="form-control" placeholder="Fecha Inicio" autocomplete="off">
						</div>
					</div>

					<div class="form-group col-3 col-sm-3 col-md-3 pull-left">
						<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-calendar"></i></span>
								</span>
							<input type="text" id="fechaFac2" data-plugin-skin="primary"
								   data-plugin-datepicker="" class="form-control" placeholder="Fecha Fin" autocomplete="off">
						</div>
					</div>
				</div>
				<div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-12">
						<table class="table table-bordered table-stripedtable-condensed" id="dtFacturas">
							<thead>
							<tr>
								<th>DocNum</th>
								<th>NumAtCard</th>
								<th>CardCode</th>
								<th>CardName</th>							
								<th>LicTradNum</th>
								<th>DocStatus</th>
								<th>ImpRetencion</th>
								<th>TIPO</th>
								<th>VatSum</th>
								<th>DocTotal</th>
								<th>Comments</th>
								<th>Fecha_Factura</th>
								<th>Vencimiento</th>
								<th>Dias</th>
								<th>Corriente</th>
								<th>1-30</th>
								<th>31-60</th>
								<th>61-90</th>
								<th>91-120</th>
								<th>121-+</th>
								<th>CheckNum</th>
								<th>BankCode</th>
								<th>AcctNum</th>
								<th>TASA</th>
							</tr>
							</thead>
							<tbody style="font-size: 11.5px;">


							</tbody>							
						</table>
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

