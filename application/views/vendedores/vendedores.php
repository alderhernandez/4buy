<div class="row">
	<div class="col-9 col-md-9 col-sm-9">
		<select id="ddlSupervisores" data-plugin-selectTwo class="form-control populate">
			<option selected disabled></option>
			<?php 
				if (!$sup) {
				} else {
					foreach ($sup as $key) {
						echo '
							<option value="'.$key['IdUsuario'].'">'.$key['Nombre'].'</option>
						';
					}
				}
			?>
		</select>
	</div>
	<div class="col-3 col-md-3 col-sm-3">
		<p>
		<!--<button id="portletRefresh" type="button" class="mb-xs mt-xs mr-xs btn btn-default"><i class="fa fa-refresh"></i> Refresh</button>
		<button id="portletReset" type="button" class="mb-xs mt-xs mr-xs btn btn-default"><i class="fa fa-undo"></i> Reset</button> -->
		<button  id="btnAsignar" type="button" class="mb-xs mt-xs mr-xs btn btn-primary disabled">Guardar Cambios</button>
	</p>
	</div>
</div>
<div class="row">
	<div class="col-md-5" data-plugin-portlet id="portlet-1">
		<h4>Rutas Disponibles</h4>
		<div id="contenidoRutaNoAsig"  style="overflow-y:scroll;">
		</div>
	</div>
	<div class="col-md-2">
	</div>
	<div class="col-md-5" data-plugin-portlet id="portlet-3">
		<h4>Rutas asignadas</h4>
		<div id="contenidoRutaAsig"  style="overflow-y:scroll;">
		</div>
	</div>
</div>