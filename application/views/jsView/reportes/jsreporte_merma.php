<script type="text/javascript">
 $(document).ready(function(){
    
 });

 $("#btnGenerarRpt").click(function(){
    if($("#fechaRang1").val() > $("#fechaRang2").val()){
		swal({
			text: "La fecha de inicio no puede ser mayor a la fecha final",
			type: "error",
			allowOutsideClick: false
		});
	}else if($("#fechaRang1").val() == "" || $("#fechaRang2").val() == ""){
		swal({
			text: "Debe ingresar ambas fechas",
			type: "error",
			allowOutsideClick: false
		});
	}else{
        $('[data-toggle="tooltip"]').tooltip();
        let html = '', obj = ''; 
        $("#tblMermas thead tr").html("");
        $("#loading").modal("show");
        let form_data = {
            rango1: $("#fechaRang1").val(),
            rango2: $("#fechaRang2").val()
        };

         $.ajax({
             url: "encabezadoMerma",
             type: "POST",
             data: form_data,
             success: function(data){
                 html += '<th>Codigo</th>';
                 html += '<th>Total</th>';
                 obj = jQuery.parseJSON(data);
                $.each(obj, function(i, index){
                    html += '<th>'+index["Dias"]+'</th>';
                });
                $("#tblMermas thead tr").append(html);
             }
         }).then(function(){
            $("#tblMermas tbody").html("");
            let html1 = '';
            let form_data1 = {
                rango1: $("#fechaRang1").val(),
                rango2: $("#fechaRang2").val()
            };
            $.ajax({
             url: "ReporteMerma",
             type: "POST",
             data: form_data1,
             success: function(data){
                let obj1 = jQuery.parseJSON(data);
                $.each(obj1, function(i, index){
                    html1 += '<tr><td data-toggle="tooltip" data-placement="top" title="'+index["Descripcion"]+'">'+index["codigo"]+'</td>'+
                    '<td>'+index["Total"]+'</td>';
                    $.each(obj, function(l, item){
                        html1 += '<td>'+index["DIA"+item["Dias"]+""] +'</td>';  
                    });
                    html += '</tr>';
                });
                $("#tblMermas tbody").append(html1);
                $("#loading").modal("hide");
             }
           });
           //$("#tblMermas").DataTable();
        });       
    }
 });

 $("#printMermas").click(function(){
	if($("#fechaRang1").val() > $("#fechaRang2").val()){
		swal({
			text: "La fecha de inicio no puede ser mayor a la fecha final",
			type: "error",
			allowOutsideClick: false
		});
	}else if($("#fechaRang1").val() == "" || $("#fechaRang2").val() == ""){
		swal({
			text: "Debe ingresar ambas fechas",
			type: "error",
			allowOutsideClick: false
		});
	}else{
		let win = window.open('printReporteMermas/'+$("#fechaRang1").val()+"/"+$("#fechaRang2").val(), '_blank');
	}
});
</script>