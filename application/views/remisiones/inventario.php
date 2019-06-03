<div class="row">
	<div class='col-12 col-sm-12 col-md-12'>
		<div class="pull-right">
			<button id="btnActualizar" class="mb-xs mt-xs mr-xs btn btn-primary" data-toggle="tooltip" data-placement="left" title="" 		              data-original-title="Actualizar tabla de inventario">
				<i class="fa fa-refresh"></i>
			</button>
		</div>
	</div>
</div>
<!-- start: page -->
<div class="row">
	<div class="col-12 col-sm-12 col-md-12">
		<div class="tabs tabs-danger">
			<ul class="nav nav-tabs">
				<li class="active">
					<a class="text-muted" href="#popular" data-toggle="tab" aria-expanded="false"><i></i> Inventario de Productos</a>
				</li>
				<li class="">
					<a class="text-muted" href="#recent" data-toggle="tab" aria-expanded="true">Inventario por Rutas</a>
				</li>
			</ul>
			<div class="tab-content">
				<div id="popular" class="tab-pane active">
					<div class="form-group pull-right">
						<div class="checkbox-custom checkbox-primary">
							<input type="checkbox" id="chkSinStock">
							<label for="chkSinStock">Mostrar productos sin stock</label>
						</div>
					</div>
					<br>
					<table class="table table-responsive table-bordered table-striped mb-none table-sm" id="tblInventario">
						<thead>
							<tr>
								<th>Código</th>
								<th>Descripcion</th>
								<th>Unid. Medida</th>
								<th>En Stock</th>
								<th>Bodega</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div id="recent" class="tab-pane">
					<div class="form-group pull-right">
						<div class="checkbox-custom checkbox-primary">
							<input type="checkbox" id="chkRutasSInv">
							<label for="chkRutasSInv">Mostrar productos sin stock</label>
						</div>
					</div>
					<br>
					<table class="table compact table-responsive table-bordered table-striped mb-none table-sm" id="tblInventarioRutas">
						<thead>
							<tr>
								<th>Código</th>
								<th>Descripcion</th>
								<th>Ruta</th>
								<th>Unid. Medida</th>
								<th>En Stock</th>
								<th>Bodega</th>
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

<div class="row">

</div>

<div class="row">

</div>
