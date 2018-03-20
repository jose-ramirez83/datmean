$(function() 
{
	$('#btnRegister').click(function(){
		var form = $('#spaceshipForm');
		var name = form.find("input[name=nameShip]").val();
		var type = form.find("select[name=typeShip]").val();
		var x = form.find("input[name=x]").val();
		var y = form.find("input[name=y]").val();
		var z = form.find("input[name=z]").val();
		if (name ==''|| type==''|| x=='' || y== '' || z == '')
		{
			bootbox.alert("Debe rellenar todos los campos");
		}
		else{
			$.ajax({
			    url: "http://localhost/api2/api/public/api/v1/add",
			    type: 'POST',
			    dataType: 'JSON',
			    data: {name: name, type:type, x:x, y:y, z:z},
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
		}
	});
	
	$('#btnSearch').click(function(){
		var form = $('#spaceshipForm');
		$.ajax({
		    url: "http://localhost/api2/api/public/api/v1/ship/"+$('input[name=search]').val(),
		    type: 'GET',
		    dataType: 'JSON',
		    success: function(result) {
		        console.log(result);
		        if (result.length>0){
		        	let modal = $('#modalCoordenadas');
		        	let naves = result.length;
		        	let texto;
		        	let body = modal.find(".modal-body");
		        	body.empty();
		        	for (i=0;i<naves;i++){
		        		texto = '';
		        		texto+="<h4>Nave espacial: " + result[i].name + "</h4>";
		        		texto+="<p>Coordenada x: " + result[i].x + "<p>";
		        		texto+="<p>Coordenada y: " + result[i].y + "<p>";
		        		texto+="<p>Coordenada z: " + result[i].z + "<p>";
		        		body.append(texto);
		        	}
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
	
	
	$('input[name=x],input[name=y],input[name=z]').keydown(function(e){
		console.log(e.keyCode);
		if (e.keyCode!=46&&e.keyCode!=8&&e.keyCode!=37&&e.keyCode!=39&&e.keyCode!=9&&e.keyCode!=109)
		{
			// Si el valor no es numérico, lo borramos
			let value = parseInt(e.key);
			if (!$.isNumeric(value)) return false;
		}
	});
	
	$('#btnNew').click(function(){
		var form = $('#spaceshipForm');
		form.find("input[name=nameShip]").val('');
		form.find("input[name=x]").val('');
		form.find("input[name=y]").val('');
		form.find("input[name=z]").val('');
	});
});