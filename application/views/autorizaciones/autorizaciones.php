<div class="row">
	<div class='col-12 col-sm-12 col-md-12'>
		<div class="pull-right">
			<button id="btnNewAuth" data-toggle="modal" class="mb-xs mt-xs mr-xs btn btn-primary" data-target="#newAuth">
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

				<h2 class="panel-title">Lista de Autorizaciones</h2>
			</header>
			<div class="panel-body">
				<table class="table compact table-bordered table-striped mb-none table-sm" id="tblNewAuth">
					<thead>
						<tr>
							<th>Cod Autorizacion</th>
							<th>Descripcion</th>
							<th>Modulo</th>
							<th>Categoria</th>
							<th>Fecha Creacion</th>
							<th>Fecha Actualizacion</th>
							<th>Fecha Baja</th>
							<th>Estado</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if (!$autlist) {

						} else {
							foreach ($autlist as $key){
								echo "
									<tr>
										<td>".$key["Id_Autorizacion"]."</td>
										<td>".$key["Descripcion"]."</td>
										<td>".$key["Modulo"]."</td>
										<td>".$key["Categoria"]."</td>
										<td>".$key["Fecha_Crea"]."</td>
										<td>".$key["Fecha_Actualiza"]."</td>
										<td>".$key["Fecha_Baja"]."</td>";
										if($key["Estado"] == 1) {
											echo "
												<td>Activo</td>
											";	
										}else{
											echo "
												<td>Inactivo</td>
											";	
										}																					
										if ($key["Estado"] == 1) {
											echo"
										<td class='center'>
											<a href='#' onclick='editar(".'"'.$key["Id_Autorizacion"].'","'.$key["Descripcion"].'","'.$key["Modulo"].'","'.$key["Id_Autorizacion_Categoria"].'","'.$key["Categoria"].'"'.")' class='btn btn-xs btn-primary'><i class='fa fa-edit'></i></a>
											<a href='#' onclick='Baja(".'"'.$key["Id_Autorizacion"].'","'.$key["Estado"].'"'.")' class='btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></a> 
										</td>";
										} else {
											echo"
										<td class='center'>
											<a href='#' onclick='Baja(".'"'.$key["Id_Autorizacion"].'","'.$key["Estado"].'"'.")' class='btn btn-xs btn-danger'><i class='fa fa-rotate-left'></i></a> 
										</td>";
										}
										
									echo "</tr>
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

<div class="row">

</div>

<div class="row">

</div>

<div class="modal fade" id="newAuth" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
				  <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title"><i class="fa fa-key"> <span id="tituloModal"></span></i></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-6 col-sm-6 col-md-6">
						<div class="form-group">
							<label class="col-md-6 control-label" for="modulo">Módulo</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-list-alt"></i></span>
                                </span>
                                <input autocomplete="off" type="text" id="modulo" class="form-control" placeholder="Nombre Modulo">
								<input type="hidden" id="idAuth" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-6 col-sm-6 col-md-6">
						<div class="form-group">
							<label class="col-md-6 control-label" for="CatAuth">Categoria</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><!--icono--></span>
                                </span>
                                <select id="CatAuth" data-plugin-selectTwo  class="form-control col-12 col-md-12 col-sm-12 populate">
                                	<option></option>
                                	<?php
                                		if (!$autcat) {		
                                		}else{
                                			foreach ($autcat as $key) {
                                				echo "
													<option value='".$key["IdCategoria"]."'>".$key["Descripcion"]."</option>
                                				";
                                			}
                                		}
                                	?>
                                </select>
							</div>
						</div>
					</div>
                </div>
				<br>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12">
						<div class="form-group">
							<label class="col-md-3 control-label" for="descripcion">Descripcion</label>
							<div class="col-12 col-sm-12 col-md-12">
                                <textarea class="form-control" rows="3" id="descripcion" autocomplete="off">
                                </textarea>
							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 pull-right">
                        <button type="button" id="btnSaveAuth" class="btn btn-primary">Guardar</button>
						<button type="button" id="btnUpdAuth" style="display:none;" class="btn btn-primary">Actualizar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
