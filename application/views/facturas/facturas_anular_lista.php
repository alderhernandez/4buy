<div class="row">
	<div class='col-9 col-sm-9 col-md-9'>
		<h2 class="h2 mt-none mb-sm ">Solicitud anular facturas</h2>
	</div>
</div>
<div class="row">
	<div class="col-12 col-sm-12 col-md-12">
		<section class="panel col-12 col-sm-12 col-md-12">
			<header class="panel-heading">
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-striped mb-none table-sm table-condensed" id="datatableFact">
					<thead>
					<tr>
						<th>Factura</th>
						<th>Comentario</th>
						<th>Fecha Solicitud</th>
						<th>Usuario Solicita</th>
						<th>Acciones</th>
					</tr>
					</thead>
					<tbody>
						<?php
						if(!$lista){
						}else{
							foreach ($lista as $item) {
								echo "
									<tr>
										<td>".$item["IDFACTURA"]."</td>
										<td>".$item["COMENTARIO"]."</td>
										<td>".date_format(new DateTime($item["FECHASOLICITUD"]), "m-d-Y H:i:s")."</td>
										<td>".$item["NOMBREUSUARIOSOLICITA"]."</td>	
										<td><a href='DetalleFacturas/".$item["IDENCABEZADO"]."'style='text-align:center !important;' 
			class='btn btn-sm btn-link btn-block center'><i class='fa fa-expand left'></i></a></td>	
									</tr>		
								";
							}
						}
						?>
					</tbody>
				</table>
			</div>
		</section>
	</div>
	</div>
</div>
<div class="row">

</div>
<div class="row">

</div>
