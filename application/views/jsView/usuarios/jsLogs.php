<script type="text/javascript">
$(document).ready(function(){
var tabla = $("#tblLogs").DataTable({
	  	"ajax": "ShowLogs",
	  	"sort": false,
	  	"paging": false,
        "info": false,
        "destroy": true,
        "searching": true,
        "responsive": false,
	  	"columns":[
	  	  { "data": "Tipo"},
	  	  { "data": "Fecha"},
	  	  { "data": "Modulo"},
	  	  { "data": "Descripcion"},
	  	  { "data": "Ref1"},
	  	  { "data": "Ref2"}
	  	],
	  	/*"order": [
				[1, "desc"]
			],*/
	    "language": {
	        "info": "Registro _START_ a _END_ de _TOTAL_ entradas",
	        "infoEmpty": "Registro 0 a 0 de 0 entradas",
            "zeroRecords": "No se encontro coincidencia",
            "infoFiltered": "(filtrado de _MAX_ registros en total)",
            "emptyTable": "NO HAY DATOS DISPONIBLES",
            "lengthMenu": '_MENU_ ',
            "search": '<i class="fa fa-search"></i>',
            "paginate": {
                "first": "Primera",
                "last": "Última ",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
	});	

	setInterval(function(){
		tabla.ajax.reload();
	},30000);
});
</script>
