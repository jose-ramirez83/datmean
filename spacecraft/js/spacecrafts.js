$(function() 
{
	/*
	 * Hacemos DataTable a la tabla para que se añadan funcionalidades automáticas de filtro, ordenación y agrupación.
	 */
	$('.table').DataTable(
	{
	    language:{
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ naves",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "No hay naves espaciales registradas.",
			"sInfo":           "Mostrando del _START_ al _END_ de un total de _TOTAL_ naves espaciales",
			"sInfoEmpty":      "Mostrando registos del 0 al 0 de un total de 0 naves espaciales",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ Naves espaciales)",
			"sInfoPostFix":    "",
			"sSearch":         "Filtrar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		},
	});
	
	/*
	 * Hace una llamada a la API para registrar una nave espacial.
	 * Realiza las comprobaciones si no tenemos todos los campos rellenados.
	 * 
	 */
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
			        if (result.error==0){
			        	bootbox.alert("Nave registrada", function(){ location.href="spaceships_manager.php?accion=enter"; });
			        }
			        else
			        	bootbox.alert("No se ha podido registrar");
			        
			    },
			    error: function(result) {
			        // Control de errores
			        console.log('Error');
			        bootbox.alert("Se ha producido un error en el sistema");
			    }
			});
		}
	});
	
	/*
	 * Hace una llamada a la API para buscar las coordenadas de una nave espacial concreta, o varias si coincide en el patrón de búsqueda
	 */
	$('#btnSearch').click(function(){
		var form = $('#spaceshipForm');
		var search = $('input[name=search]').val();
		if (search=='')
		{
			bootbox.alert("Debe introducir el nombre para buscar");
		}
		else{
			$.ajax({
			    url: "http://localhost/api2/api/public/api/v1/ship/"+$('input[name=search]').val(),
			    type: 'GET',
			    dataType: 'JSON',
			    success: function(result) {
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
			        bootbox.alert("Se ha producido un error en el sistema");
			    }
			});
		}
	});
	
	/*
	 * Solo permite que se introduzcan número y/o el signo negativo en las coordenadas
	 */
	$('input[name=x],input[name=y],input[name=z]').keydown(function(e){
		if (e.keyCode!=46&&e.keyCode!=8&&e.keyCode!=37&&e.keyCode!=39&&e.keyCode!=9&&e.keyCode!=109)
		{
			// Si el valor no es numérico, lo borramos
			let value = parseInt(e.key);
			if (!$.isNumeric(value)) return false;
		}
	});
	
	/*
	 * Resetea los valores del formulario
	 */
	$('#btnNew').click(function(){
		var form = $('#spaceshipForm');
		form.find("input[name=nameShip]").val('');
		form.find("input[name=x]").val('');
		form.find("input[name=y]").val('');
		form.find("input[name=z]").val('');
	});
	
	/*
	 * Para salir del sistema
	 */
	$('#btnExit').click(function(){
		bootbox.confirm("¿Desea salir del sistema?", 
			function(result){
				if (result)
					location.href="spaceships_manager.php?accion=exit"; 
			}
		);
	});
});