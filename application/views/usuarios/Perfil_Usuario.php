<div class="row">
	<div class="col-md-4 col-lg-3">
		<section class="panel">
			<div class="panel-body">
				<div class="thumb-info mb-md">
					<?php
						$img = '';
						if(!$users){
						}else{
							foreach ($users as $user) {
								if ($user["Sexo"] == 1) {
									$img = 'user2.png';
								}else{
									$img = 'female.jpg';
								}
								echo "<img width='cover' src='".base_url()."/assets/img/".$img."'
					       class='img-responsive img-fluid img-thumbnail mx-auto d-block' alt='".$this->session->userdata('User')."'>";
							}
						}
					?>
					<div class="thumb-info-title">
						<?php
							if(!$users){
							}else{
								foreach ($users as $user) {
									echo '
									  <span class="thumb-info-inner">'.$user["Nombre_Usuario"].'</span>
									  <span class="thumb-info-type">'.$user["Rol"].'</span>
									';
								}
							}
						?>
					</div>
				</div>
				<div class="widget-toggle-expand mb-md">
					<div class="widget-header">
						<h6>Información</h6>
						<!--<div class="widget-toggle">+</div> toggle-->
					</div>
					<div class="widget-content-expanded">
						<ul class="simple-todo-list">
							<?php
							if(!$users){
							}else{
								foreach ($users as $user) {
									echo '
									 <li style="padding-bottom: 5px" class="">
										<i class="fa fa-male"></i> '.$user["Nombre"].'
									</li>
									<li style="padding-bottom: 5px" class="">
										<i class="fa fa-bookmark"></i> '.$user["Apellidos"].'</li>
									<li style="padding-bottom: 5px" class="">
										<i class="fa fa-phone"></i> '.$user["Telefono1"].'
									</li>
									<li class="">
										<i class="fa fa-mobile"></i> '.$user["Telefono2"].'
									</li>
									';
								}
							}
							?>
						</ul>
					</div>
				</div>
				<hr class="dotted short">
				<h6 class="text-muted">Información adicional</h6>
					<ul class="simple-todo-list">
					<?php
						if(!$users){
						}else{
							foreach ($users as $user) {
								if ($this->session->userdata('IdRol') == 4) {
									echo "<li  style='padding-bottom: 5px' class=''>
										  <i class='fa fa-map-marker'></i> " . $user['Ruta'] . "
									  </li>
									  <li  style='padding-bottom: 5px' class=''>
										  <i class='fa fa-home'></i> " . $user['Direccion'] . "
									  </li>
									  <li class=''><i class='fa fa-envelope'>
										  </i> " . $user['Correo'] . "
									  </li>
								";
								}else{
									echo "
									  <li  style='padding-bottom: 5px' class=''>
										  <i class='fa fa-home'></i> " . $user['Direccion'] . "
									  </li>
									  <li class=''><i class='fa fa-envelope'>
										  </i> " . $user['Correo'] . "
									  </li>
								";
								}
							}
						}
					?>
					</ul>
				<!--<div class="clearfix">
					<a class="text-uppercase text-muted pull-right" href="#">(View All)</a>
				</div> -->
			</div>
		</section>
	</div>
	<div class="col-md-8 col-lg-6">
		<div class="tabs tabs-danger">
			<ul class="nav nav-tabs tabs-primary">
				<li class="active">
					<a class="text-muted" href="#edit" data-toggle="tab" aria-expanded="true">Información Personal</a>
				</li>
				<li class="">
					<a class="text-muted" href="#editPass" data-toggle="tab" aria-expanded="true">Cambiar Password</a>
				</li>
			</ul>
			<div class="tab-content">
				<div id="edit" class="tab-pane active">
						<h4 class="mb-xlg"></h4>
						<fieldset>
							<div class="form-group">
								<label class="col-md-3 control-label" for="user">Usuario</label>
								<div class="col-md-8">
									<?php
										if(!$users){
										}else{
											foreach ($users as $user){
												echo '
													<input type="text" class="form-control" id="user" 
													value="'.$user["Nombre_Usuario"].'" autocomplete="off">
													<input type="hidden" class="form-control" id="profileId"
													value="'.$user["IdUsuario"].'">
												';
											}
										}
									?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label" for="nombre">Nombre</label>
								<div class="col-md-8">
									<?php
									  $readonly = '';
										if(!$users){
										}else {
											foreach ($users as $user) {
												if ($user['IdRol'] == 4 || $user['IdRol'] == 3) {
													$readonly = "readonly";
												}
												echo '<input type="text" class="form-control" '.$readonly.' id="nombre" 
									            value="'.$user["Nombre"].'" autocomplete="off">';
											}
										}
									?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label" for="apellidos">Apellido</label>
								<div class="col-md-8">
									<?php
									$readonly = '';
									if(!$users){
									}else {
										foreach ($users as $user) {
											if ($user['IdRol'] == 4 || $user['IdRol'] == 3) {
												$readonly = "readonly";
											}
											echo '<input type="text" class="form-control" '.$readonly.' id="apellidos" 
									            value="'.$user["Apellidos"].'" autocomplete="off">';
										}
									}
									?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label" for="tel1">Teléfono1</label>
								<div class="col-md-8">
									<?php
									$readonly = '';
									if(!$users){
									}else {
										foreach ($users as $user) {
											if ($user['IdRol'] == 4 || $user['IdRol'] == 3) {
												$readonly = "readonly";
											}
											echo '<input type="text" class="form-control" '.$readonly.' id="tel1" 
									            value="'.$user["Telefono1"].'" autocomplete="off">';
										}
									}
									?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label" for="tel2">Teléfono2</label>
								<div class="col-md-8">
									<?php
										if(!$users){
										}else {
											foreach ($users as $user) {
											  echo '<input type="text" class="form-control" id="tel2"
									      value="'.$user["Telefono2"].'" autocomplete="off">';
											}
										}
									?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label" for="correo">Correo</label>
								<div class="col-md-8">
									<?php
									if(!$users){
									}else {
										foreach ($users as $user) {
											echo '<input type="text" class="form-control" id="correo"
									      value="'.$user["Correo"].'" autocomplete="off">';
										}
									}
									?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label" for="direccion">Direccion</label>
								<div class="col-md-8">
									<?php
										if(!$users){
										}else {
											foreach ($users as $user) {
											echo '
											<textarea class="form-control" rows="3" id="direccion">'.$user["Direccion"].'</textarea>';
											}
										}
									?>
								</div>
							</div>
							<div class="form-group">
								<?php 
									$attr = ''; 
									$attr1 = '';
									if(!$users){
									}else{
										foreach ($users as $user) {
											if ($user["Sexo"] == 1) {
												$attr = "checked";
											}else{
												$attr1 = "checked";
											}
											echo'
										<fieldset>
											<p>Género:</p>
											<div class="col-2 col-sm-2 col-md-2">
											<div class="form-check form-check-inline radio-custom radio-primary">
													<input class="form-check-input chkSexo" '.$attr.' type="radio" name="Sexo" id="chk1" value="">
													<label class="form-check-label" for="chk1">Hombre</label>
												</div>
											</div>
											<div class="col-2 col-sm-2 col-md-2">
												<div class="form-check form-check-inline radio-custom radio-primary">
													<input class="form-check-input chkSexo" '.$attr1.' type="radio" name="Sexo" id="chk2" value="">
													<label class="form-check-label" for="chk2">Mujer</label>
												</div>
											</div>
										</fieldset>
									';
										}
									}
								?>
							</div>
						</fieldset>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-9">
									<button type="button" id="UpdUserinfo" class="btn btn-primary">Actualizar</button>
								</div>
							</div>
						</div>
				</div>
				<div id="editPass" class="tab-pane">
					<h4 class="mb-xlg"></h4>
						<fieldset class="mb-xl">
							<div class="form-group">
								<label class="col-md-4 control-label" for="oldPass">Contraseña Actual</label>
								<div class="col-md-8">
									<input type="password" class="form-control" id="oldPass">
								</div>
							</div>
							<div class="form-group validar">
								<label class="col-md-4 control-label" for="NewPass">Nueva Contraseña</label>
								<div class="col-md-8">
									<input type="password" class="form-control" id="NewPass">
								</div>
							</div>
							<div class="form-group validar">
								<label class="col-md-4 control-label" for="NewPassRepeat">Repetir Contraseña</label>
								<div class="col-md-8">
									<input type="password" class="form-control" id="NewPassRepeat">
								</div>
							</div>
						</fieldset>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-9">
									<button type="button" id="btnUpdPass" class="btn btn-primary">Actualizar</button>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12 col-lg-3">
		<?php
			if ($this->session->userdata('IdRol') == 4) {
				if(!$facts){
					echo '
							<h4 class="mb-md">Estado de Ventas</h4>
							<ul class="simple-card-list mb-xlg">
								<li class="primary">
									<h3>0</h3>
									<p>Cantidad de facturas</p>
								</li>
								<li class="primary">
									<h3>C$ 0.00</h3>
									<p>Total efectivo facturas</p>
								</li>
							</ul>
							
							<h4 class="mb-md">Estado de facturas</h4>
							<ul class="simple-bullet-list mb-xlg">
								<li class="blue">
									<span class="title">Pendientes <span class="badge">0</span></span>
									<span class="description truncate"></span>
								</li>
								<li class="green">
									<span class="title">Integradas <span class="badge">0</span></span>
									<span class="description truncate"></span>
								</li>
								<li class="red">
									<span class="title">Anuladas <span class="badge">0</span></span>
									<span class="description truncate"></span>
								</li>
							</ul> 
						';
				}else{
					foreach ($facts as $key){
						echo '
							<h4 class="mb-md">Estado de Ventas</h4>
							<ul class="simple-card-list mb-xlg">
								<li class="primary">
									<h3>'.$key["CANTIDAD"].'</h3>
									<p>Cantidad de facturas</p>
								</li>
								<li class="primary">
									<h3>C$ '.number_format($key["TOTAL"],2).'</h3>
									<p>Total efectivo facturas</p>
								</li>
							</ul>
							
							<h4 class="mb-md">Estado de facturas</h4>
							<ul class="simple-bullet-list mb-xlg">
							<li class="green">
									<span class="title">Integradas <span class="badge">'.$key["INTEGRADAS"].'</span></span>
									<span class="description truncate"></span>
								</li>
								<li class="blue">
									<span class="title">Pendientes <span class="badge">'.$key["PENDIENTES"].'</span></span>
									<span class="description truncate"></span>
								</li>
								<li class="red">
									<span class="title">Anuladas <span class="badge">'.$key["ANULADAS"].'</span></span>
									<span class="description truncate"></span>
								</li>
							</ul> 
						';
					}
				}
			} 
		?>
		<?php
		    $count = 0;
			if ($this->session->userdata("IdRol") == 3) {
					if (!$datos) {
					} else {
						foreach ($datos as $key) {
							$count = count($datos);
					   }
					}
				echo '
					<section class="panel">
						<header class="panel-heading">
							<!--<div class="panel-actions">
								<a href="#" class="fa fa-caret-down"></a>
							</div> 
							<br>-->
							<h2 class="panel-title">
								<p><span class="label label-danger label-sm text-normal va-middle mr-sm">'.$count.'</span> 
								   vendedores asignados
								 </p>
							</h2>
						</header>
						<div class="panel-body">
							<div class="content">
								<ul class="simple-user-list">';
									if (!$datos) {
									} else {
										foreach ($datos as $key) {
											echo '
												<li>';
													$img = '';
													if ($key["Sexo"] == 1) {
														$img = 'user2.png';
													}else{
														$img = 'female.jpg';	
													}
												echo'<figure class="image rounded">
														<img src="'.base_url()."/assets/img/".$img.'" alt="" class="img-circle" width="30px">
													</figure>
													<span class="title">'.$key["Nombre"]." ".$key["Apellidos"].'</span>
													<span class="message truncate">'.$key["Ruta"].'</span>
												</li>
											';
										}
									}
											
								echo'</ul>
								<!--<hr class="dotted short">
								<div class="text-right">
									<a class="text-uppercase text-muted" href="#">(ver todos)</a>
								</div>-->
							</div>
						</div>
					</section>
				';
			}			
		  ?>
		<br>
		<!--<h4 class="mb-md">Mensajes</h4>
		<ul class="simple-user-list mb-xlg">
			<li>
				<figure class="image rounded">
					<img width="30px" src="<?php echo base_url() ?>assets/img/user2.png" alt="Joseph Doe Junior" class="img-circle">
				</figure>
				<span class="title">Joseph Doe Junior</span>
				<span class="message">Lorem ipsum dolor sit.</span>
			</li>
			<li>
				<figure class="image rounded">
					<img width="30px" src="<?php echo base_url() ?>assets/img/user2.png" alt="Joseph Doe Junior" class="img-circle">
				</figure>
				<span class="title">Joseph Junior</span>
				<span class="message">Lorem ipsum dolor sit.lore</span>
			</li>
			<li>
				<figure class="image rounded">
					<img width="30px" src="<?php echo base_url() ?>assets/img/user2.png" alt="Joseph Doe Junior" class="img-circle">
				</figure>
				<span class="title">Joe Junior</span>
				<span class="message">Lorem ipsum dolor sit.lore</span>
			</li>
			<li>
				<figure class="image rounded">
					<img width="30px" src="<?php echo base_url() ?>assets/img/user2.png" alt="Joseph Doe Junior" class="img-circle">
				</figure>
				<span class="title">Joseph Doe Junior</span>
				<span class="message">Lorem ipsum dolor sit. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span>
			</li>
		</ul>-->
	</div>
</div>
