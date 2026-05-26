
//********MENÚ*********//
$(document).ready(function(){
	$("#pantalla_1").click(function(e){
  		$("#principal").fadeIn('400');
		$("#principal").load('_system/pantalla_1.php',function(){			
		});
	});

	$("#pantalla_2").click(function(e){
  		$("#principal").fadeIn('400');
		$("#principal").load('_system/pantalla_2.php',function(){			
		});
	});

	$("#pantalla_3").click(function(e){
  		$("#principal").fadeIn('400');
		$("#principal").load('_system/pantalla_3.php',function(){			
		});
	});
	
});

/*-------------------------C E R R A R     S E S I O N------------------------*/
	$("#cerrar_sesion").click(function() {
		$.ajax({
			url: '_actions/cerrar_sesion.php',
			type: 'POST',
			dataType: 'html',
			data: {sesion: 'close'}
		  })	
		.done(function(response) {	
			window.location.href = "./login.php";
		})
		.fail(function(xhr, desc, err) {
                  console.log(xhr);
                  console.log("Details: " + desc + "\nError:" + err);
		})
		.always(function() {
			console.log("complete");
		});	
		
	});

/*--------------------------------------------*/
