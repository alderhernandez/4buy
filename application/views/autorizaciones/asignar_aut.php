<div class="row">
	<div class="col-9 col-md-9 col-sm-9">
		<select id="ddlUsuarios" data-plugin-selectTwo class="form-control populate">
			<option selected disabled></option>
			<?php
				if (!$users) {
				} else {
					foreach ($users as $key) {
						echo "
							<option value='".$key["IdUsuario"]."'>".$key["Nombre"]." ".$key["Apellidos"]." (".$key["Nombre_Usuario"].")"."</option>
						";
					}
				}
					
			?>
		</select>
	</div>
	<div class="col-3 col-md-3 col-sm-3">
		  <button  id="btnSetAuth" type="button" class="btn btn-primary">Guardar Cambios</button>
	</div>
</div>
<div class="row">
	<div class="col-12 col-sm-12 col-md-12">
		<section class="panel" style="overflow-x: auto; height: 550px; transform: translate(0px, 0px);">
			<header class="panel-heading">
				<div class="panel-actions">
				</div>
				<h2 class="panel-title">Asignar Permisos</h2>
				<p class="panel-subtitle"></p>
			</header>
			<div class="panel-body">
				<div id="treeCheckbox">
				  <ul class="recorrer">
				     <?php 
				     	if (!$list) {
				     	}else{
				     		foreach ($list as $key => $value) {
				     			if ($list[$key]["Id_Autorizacion_Categoria"] != $list[$key-1]["Id_Autorizacion_Categoria"]) {
					     			echo "
										<li class='jstree-open' >".$list[$key]["Categoria"]."";
											foreach ($list as $key2 => $value) {
											  if ($list[$key]["Id_Autorizacion_Categoria"] == $list[$key2]["Id_Autorizacion_Categoria"]) {
											  	 echo "
													<ul>
														<li id='".$list[$key2]["Id_Autorizacion"]."'>
														   ".$list[$key2]["Descripcion"]."
														</li>
													</ul>
											   ";
											  }
											}
									echo" </li>";
				     			}
				     		}
				     	}
					  ?>
					</ul>
				</div>
			</div>
		</section>
	</div>
</div>