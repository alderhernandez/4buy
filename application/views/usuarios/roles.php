<div class="row">
	<div class='col-12 col-sm-12 col-md-12'>
		<div class="pull-right">
			<button id='newRol' data-toggle="modal" class="mb-xs mt-xs mr-xs btn btn-primary" data-target="#nuevoRol">
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

				<h2 class="panel-title">Roles</h2>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-striped table-sm" id="tblRoles" role="grid">
					<thead>
						<tr>
							<th>Nombre Rol</th>
							<th>Descripcion</th>
                            <th>Fecha Creacion</th>
                            <th>Estado</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
                        <?php
                            if (!$roles) {
                            } else {
                                foreach ($roles as $key) {
                                    echo "
                                        <tr>
                                            <td>".$key["Nombre_Rol"]."</td>
                                            <td>".$key["Descripcion"]."</td>
                                            <td>".$key["Fecha_Creacion"]."</td>";
                                            if($key["Estado"] === 1)
                                            {
                                                echo "<td>Activo</td>";
                                            }else{
                                                echo "<td>Inactivo</td>";
                                            }
                                            if ($key["Estado"] === 1) {
                                                echo" <td class='center'>
                                                    <a href='#' class='btn btn-xs btn-primary' 
                                                    onclick='editar(".'"'.$key["IdRol"].'","'.$key["Nombre_Rol"].'","'.$key["Descripcion"].'"'.")'>
                                                    <i class='fa fa-edit'></i></a>
                                                    <a href='#' onclick='ActualizarEstado(".'"'.$key["IdRol"].'","'.$key["Estado"].'"'.")' 
                                                    class='btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></a>
                                                </td>";
                                            } else {
                                                echo" <td class='center'>
                                                    <a href='#' class='btn btn-xs btn-primary btn-disabled' disabled><i class='fa fa-edit'></i></a>
                                                    <a href='#' onclick='ActualizarEstado(".'"'.$key["IdRol"].'","'.$key["Estado"].'"'.")' 
                                                    class='btn btn-xs btn-danger'><i class='fa fa-rotate-left'></i></a>
                                                </td>";
                                            }
                                       echo"</tr>
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

<div class="modal fade" id="nuevoRol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title"><i class="fa fa-users"> <span id="tituloModal"></span></i></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-6 col-sm-6 col-md-6">
						<div class="form-group">
							<label class="col-md-6 control-label" for="Rol">Nombre del rol</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-users"></i></span>
                                </span>
                                <input type="text" id="Rol" class="form-control" placeholder="Nombre Rol">
							</div>
						</div>
					</div>
                </div><br>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12">
						<div class="form-group">
							<label class="col-md-3 control-label" for="tadescripcion">Descripción</label>
							<div class="col-12 col-sm-12 col-md-12">
                                <textarea class="form-control" rows="3" id="tadescripcion" height: 74px;">
                                </textarea>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 pull-right">
                        <button type="button" id="btnSaveRol" class="btn btn-primary">Guardar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editRol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title"><i class="fa fa-users"> <span id="tituloModaledit"></span></i></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-6 col-sm-6 col-md-6">
						<div class="form-group">
							<label class="col-md-6 control-label" for="Rol">Nombre del rol</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-users"></i></span>
                                </span>
                                <input type="text" id="Roledit" class="form-control" placeholder="Nombre Rol">
                                <input type="hidden" id="IdRol" class="form-control">
							</div>
						</div>
					</div>
                </div><br>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12">
						<div class="form-group">
							<label class="col-md-3 control-label" for="tadescripcion">Descripción</label>
							<div class="col-12 col-sm-12 col-md-12">
                                <textarea class="form-control" rows="3" id="tadescripcionedit" height: 74px;">
                                </textarea>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 pull-right">
                        <button type="button" id="btnUpdateRol" class="btn btn-primary">Actualizar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>