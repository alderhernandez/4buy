<div class="row">
	<div class='col-12 col-sm-12 col-md-12'>
		<div class="pull-right">
			<button id="newUserbtn" data-toggle="modal" class="mb-xs mt-xs mr-xs btn btn-primary" data-target="#nuevoUser">
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

				<h2 class="panel-title">Lista de Usuarios</h2>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-striped mb-none table-sm table-condensed" id="datatable">
					<thead>
						<tr>
							<th>UserName</th>
							<th>Nombre completo</th>
							<th>Rol</th>
							<th>Rutas</th>
							<th>Teléfono 1</th>
							<th>Teléfono 2</th>
							<th>Correo</th>
							<th>Direccion</th>
							<th>Fecha Registro</th>
							<th>Estado</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						    if (!$users) {

							} else {
								foreach ($users as $key) {
									echo "
									   <tr>
									 		 <td>".$key["Nombre_Usuario"]."</td>
											 <td>".$key["Nombre"] ." ". $key["Apellidos"]."</td>
											 <td>".$key["Rol"]."</td>";
											 if($key["IdRuta"] != NULL){
												echo "<td>Ruta ".$key["IdRuta"]."</td>"; 
											 }else{
												echo "<td></td>";
											 }
											echo" 
											 <td>".$key["Telefono1"]."</td>
											 <td>".$key["Telefono2"]."</td>
											 <td>".$key["Correo"]."</td>
											 <td>".$key["Direccion"]."</td>
											 <td>".$key["Fecha_Registro"]."</td>";
											 if ($key["Estado"] == 1) {
												echo"<td class='text-success center'>Activo</td>";
											 }else{
												echo"<td class='text-danger center'>Inactivo</td>";
											 }
											 if ($key["IdRol"] == 1 && $this->session->userdata("IdRol") != 1) {
												 echo " <td></td>";
											 }else if($key["IdRol"] == 4 && $this->session->userdata("IdRol") == 2){
											 		if ($key["Estado"] == 1) {
													echo "
														<td class='left'>
															<a href='#' onclick='ActualizarEstado(".'"'.$key["IdUsuario"].'","'.$key["Estado"].'","0"'.")' 
															  class='btn btn-xs btn-danger col-md-offset-6'><i class='fa fa-trash-o'></i></a> 
														</td>";
												 } else {
													echo "
														<td class='left'>
															<a href='#' onclick='ActualizarEstado(".'"'.$key["IdUsuario"].'","'.$key["Estado"].'", "'.$key["IdRuta"].'"'.")' 
															  class='btn btn-xs btn-danger col-md-offset-6'><i class='fa fa-rotate-left'></i></a> 
														</td>";
												 }
											 } else {
												if ($key["Estado"] == 1) {
													echo "
													<td class='center'>
														<a href='#' class='btn btn-xs btn-primary'
														onclick='editar(".'"'.$key['IdUsuario'].'","'.$key['Nombre_Usuario'].'","'.$key['Nombre'].'",
														"'.$key['Apellidos'].'","'.$key['Telefono1'].'","'.$key['Telefono2'].'","'.$key["Correo"].'","'.$key["IdRol"].'","'.$key["Rol"].'","'.$key['Direccion'].'",'.$key["IdRuta"].',"'.$key["Ruta"].'",'.$key["Sexo"].',"'.$key['Reimprime'].'"'.")'>
														<i class='fa fa-edit'></i></a>
														<a href='#' onclick='ActualizarEstado(".'"'.$key["IdUsuario"].'","'.$key["Estado"].'","0"'.")' 
														  class='btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></a> 
													</td>";
												 } else {
													echo "
													<td class='center'>
														<a href='#' class='btn btn-xs btn-primary' disabled><i class='fa fa-edit'></i></a>
														<a href='#' onclick='ActualizarEstado(".'"'.$key["IdUsuario"].'","'.$key["Estado"].'","0"'.")' 
														  class='btn btn-xs btn-danger'><i class='fa fa-rotate-left'></i></a> 
													</td>";
												 }
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

<div class="modal fade" id="nuevoUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
				  <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title"><i class="fa fa-user"> <span id="tituloModal"></span></i></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-6 col-sm-6 col-md-6">
						<div class="form-group">
							<label class="col-md-6 control-label" for="username">UserName</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-user"></i></span>
                                </span>
                                <input autocomplete="off" type="text" id="username" class="form-control" placeholder="Nombre Usuario">
								<input type="hidden" id="iduser" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-6 col-sm-6 col-md-6">
						<div class="form-group">
							<label class="col-md-6 control-label" for="nombre">Nombres</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-pencil"></i></span>
                                </span>
                                <input autocomplete="off" type="text" id="nombre" class="form-control" placeholder="Nombres">
							</div>
						</div>
					</div>
                </div><br>

				<div class="row">
				  <div class="col-6 col-sm-6 col-md-6">
						<div class="form-group">
							<label class="col-md-6 control-label" for="apellido">Apellidos</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-pencil-square"></i></span>
                                </span>
                                <input autocomplete="off" type="text" id="apellido" class="form-control" placeholder="Apellidos">
							</div>
						</div>
					</div>
					<div class="col-6 col-sm-6 col-md-6">
						<div class="form-group">
							<label class="col-md-6 control-label" for="pass">Contraseña</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-unlock-alt"></i></span>
                                </span>
                                <input autocomplete="off" type="password" id="pass" class="form-control" placeholder="Contraseña">
							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
				  <div class="col-6 col-sm-6 col-md-6">
						<div class="form-group">
							<label class="col-md-6 control-label" for="tel1">Teléfono 1</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-phone"></i></span>
                                </span>
                                <input autocomplete="off" type="text" id="tel1" class="form-control" placeholder="Número telefónico">
							</div>
						</div>
					</div>
					<div class="col-6 col-sm-6 col-md-6">
						<div class="form-group">
							<label class="col-md-6 control-label" for="mail">Correo</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-envelope"></i></span>
                                </span>
                                <input autocomplete="off" type="mail" id="mail" class="form-control" placeholder="ejemplo@gmail.com">
							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-6 col-sm-6 col-md-6">
						<div class="form-group">
							<label class="col-md-6 control-label" for="tel2">Teléfono 2</label>
							<div class="input-group input-group-icon">
								<span class="input-group-addon">
									<span class="icon"><i class="fa fa-mobile"></i></span>
                                </span>
                                <input autocomplete="off" type="text" id="tel2" class="form-control" placeholder="Número telefónico">
							</div>
						</div>
					</div>
				  <div class="col-6 col-sm-6 col-md-6">
						<div class="form-group">
							<label class="col-md-6 control-label" for="idRol">Roles</label>
							<div class="input-group input-group-icon">
							  <span class="input-group-addon">
									<span class="icon"></span>
                                </span>
                                <select id="idRol" data-plugin-selectTwo  class="form-control col12 col-md-12 col-sm-12 populate">
								<option selected></option>
									<?php
										if (!$roles) {
										} else {
											foreach ($roles as $key){
												echo "
													<option value=".$key["IdRol"].">".$key["Nombre_Rol"]."</option>
												";
											}
										}
										
									?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6 col-sm-6 col-md-6" id='ddRutas' style='display:none'>
						<br>
						<div class="form-group">
							<label class="col-md-6 control-label" for="Rutas">Rutas</label>
							<div class="input-group input-group-icon">
							  <span class="input-group-addon">
									<span class="icon"></span>
                                </span>
								<select id="Rutas" data-plugin-selectTwo  class="form-control col12 col-md-12 col-sm-12 populate">
									<option selected></option>
									<?php
									if (!$rutas) {
									} else {
										foreach ($rutas as $ruta){
											echo '
													<option value='.$ruta["IdRuta"].'>'.$ruta["Ruta"].'</option>
												';
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
					<div class="col-6 col-sm-6 col-md-6">
						<fieldset>
						<p>Género:</p>
						<div class="col-12 col-sm-6 col-md-6">
						<div class="form-check form-check-inline radio-custom radio-primary">
							<input class="form-check-input chkSexo" type="radio" name="Sexo" id="chk1" value="">
							<label class="form-check-label" for="chk1">Hombre</label>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6">
						<div class="form-check form-check-inline radio-custom radio-primary">
							<input class="form-check-input chkSexo" type="radio" name="Sexo" id="chk2" value="">
							<label class="form-check-label" for="chk2">Mujer</label>
						</div>
					</div>
					</fieldset>
					</div>
				</div>	
				<br>
				<div class="row">
					<div class="col-6 col-sm-6 col-md-6">
						<div class="form-group">
							<div class="checkbox-custom checkbox-primary">
								<input type="checkbox" id="Reimprime">
								<label for="Reimprime">Reimprime Facturas?</label>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12">
						<div class="form-group">
							<label class="col-md-3 control-label" for="direccion">Direccion</label>
							<div class="col-12 col-sm-12 col-md-12">
                                <textarea class="form-control" rows="3" id="direccion" autocomplete="off"></textarea>
								<span class="help-block">
									Cuando proporcione una dirección asegurese que no lleva comas (,).
								</span>
							</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 pull-right">
                        <button type="button" id="btnSaveUser" class="btn btn-primary">Guardar</button>
						<button type="button" id="btnUpdUser" style='display:none;' class="btn btn-primary">Actualizar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
