<div class="row">
	<div class="inner-toolbar clearfix">
		<ul>
			<li class="right">
				<ul class="nav nav-pills nav-pills-primary">
					<!--<li>
						<label>Tipo</label>
					</li>-->
					<li class="">
						<a href="#access-log" data-toggle="tab">Historial Log</a>
					</li>
					<!--<li>
						<a href="#error-log" data-toggle="tab">Error Log</a>
					</li>
					<li>
						<a href="#custom-log" data-toggle="tab">Custom Log</a>
					</li>-->
				</ul>
			</li>
		</ul>
	</div>
</div>
<br><br><br>
<div class="row">
	<div class="col-12 col-sm-12 col-md-12">
		<section class="col-12 col-sm-12 col-md-12 panel">
			<div class="panel-body tab-content">
				<div id="access-log" class="tab-pane active">
					<table class="table table-striped table-no-more table-bordered mb-none compact" id="tblLogs">
						<thead>
							  <tr>
								<th style="width: 15%">Tipo</th>
								<th style="width: 20%">Fecha</th>
								<th>Modulo</th>
								<th>Mensaje</th>
								<th style="width: 15%">Ref1</th>
								<th style="width: 15%">Ref2</th>
							  </tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div id="error-log" class="tab-pane">
					<table class="table table-striped table-no-more table-bordered  mb-none">
						<thead>
							<tr>
								<th style="width: 10%"><span class="text-normal text-sm">Type</span></th>
								<th style="width: 15%"><span class="text-normal text-sm">Date</span></th>
								<th><span class="text-normal text-sm">Message</span></th>
							</tr>
						</thead>
						<tbody class="log-viewer">
							<tr>
								<td data-title="Type" class="pt-md pb-md">
									<i class="fa fa-bug fa-fw text-muted text-md va-middle"></i> Debug
								</td>
								<td data-title="Date" class="pt-md pb-md">
									13/04/2014 18:25:59
								</td>
								<td data-title="Message" class="pt-md pb-md">
									my.host - oh snap! another exception
								</td>
							</tr>
							<tr>
								<td data-title="Type" class="pt-md pb-md">
									<i class="fa fa-info fa-fw text-info text-md va-middle"></i> Info
								</td>
								<td data-title="Date" class="pt-md pb-md">
									13/04/2014 21:50:17
								</td>
								<td data-title="Message" class="pt-md pb-md">
									"GET / HTTP/1.1" 200 1225
								</td>
							</tr>
							<tr>
								<td data-title="Type" class="pt-md pb-md">
									<i class="fa fa-warning fa-fw text-warning text-md va-middle"></i> Warning
								</td>
								<td data-title="Date" class="pt-md pb-md">
									13/04/2014 17:44:21
								</td>
								<td data-title="Message" class="pt-md pb-md">
									DocumentRoot [/var/www/porto-admin/] does not exist
								</td>
							</tr>
							<tr>
								<td data-title="Type" class="pt-md pb-md">
									<i class="fa fa-times-circle fa-fw text-danger text-md va-middle"></i> Error
								</td>
								<td data-title="Date" class="pt-md pb-md">
									13/04/2014 21:55:18
								</td>
								<td data-title="Message" class="pt-md pb-md">
									File does not exist: /var/www/porto-admin/favicon.ico
								</td>
							</tr>
							<tr>
								<td data-title="Type" class="pt-md pb-md">
									<i class="fa fa-ban fa-fw text-danger text-md va-middle"></i> Fatal
								</td>
								<td data-title="Date" class="pt-md pb-md">
									13/04/2014 22:13:39
								</td>
								<td data-title="Message" class="pt-md pb-md">
									not a tree object
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div id="custom-log" class="tab-pane">
					
				</div>
			</div>
		</section>
	</div>
</div>