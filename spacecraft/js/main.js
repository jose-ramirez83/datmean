$(function() 
{
	$('#submit').click(function(){
		$.ajax({
		    url: "http://localhost/datmean/api/public/api/v1/platform",
		    type: 'POST',
		    dataType: 'JSON',
		    data: {name: jQuery('input[name=name]').val(),pass:jQuery('input[name=pass]').val()},
		    success: function(result) {
		        console.log(result);
		        if (result.error==0){
		        	location.href="spaceships_manager.php?accion=enter";
		        }
		        else
		        	bootbox.alert("Acceso denegado");
		        
		    },
		    error: function(result) {
		        // Control de errores
		        console.log('Error');
		        console.log(result);
		        bootbox.alert("Acceso denegado");
		    }
		});
	});
});