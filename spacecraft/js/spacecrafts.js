$(function() 
{
	$('#btnRegister').click(function(){
		var form = $('#spaceshipForm');
		$.ajax({
		    url: "http://localhost/api2/api/public/api/v1/add",
		    type: 'POST',
		    dataType: 'JSON',
		    data: {name: form.find("input[name=nameShip]").val(),type:form.find("select[name=typeShip]").val(),x:form.find("input[name=x]").val(),y:form.find("input[name=y]").val(),z:form.find("input[name=z]").val()},
		    success: function(result) {
		        console.log(result);
		        if (result.error==0){
		        	bootbox.alert("Nave registrada", function(){ location.href="spaceships_manager.php?accion=enter"; });
		        	
		        }
		        else
		        	bootbox.alert("No se ha podido registrar");
		        
		    },
		    error: function(result) {
		        // Control de errores
		        console.log('Error');
		        console.log(result);
		        bootbox.alert("Se ha producido un error en el sistema");
		    }
		});
	});
	
	$('#btnSearch').click(function(){
		var form = $('#spaceshipForm');
		$.ajax({
		    url: "http://localhost/api2/api/public/api/v1/ship/"+$('input[name=search]').val(),
		    type: 'GET',
		    dataType: 'JSON',
		    success: function(result) {
		        console.log(result);
		        if (result.error==0){
		        	let modal = $('#modalCoordenadas');
		        	modal.find('.modal-title').text("Nave espacial: " + result.name);
		        	modal.find('p#x').text("Coordenada x: " + result.x);
		        	modal.find('p#y').text("Coordenada y: " + result.y);
		        	modal.find('p#z').text("Coordenada z: " + result.z);
		        	$('#modalCoordenadas').modal();
		        }
		        else{
		        	bootbox.alert("No se encuentra en la flota rebelde");
		        }
		        
		    },
		    error: function(result) {
		        // Control de errores
		        console.log('Error');
		        console.log(result);
		        bootbox.alert("Se ha producido un error en el sistema");
		    }
		});
	});
});