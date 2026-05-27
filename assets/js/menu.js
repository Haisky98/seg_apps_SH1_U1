$(document).ready(function(){

    function cargarPagina(url) {
        $("#principal").fadeOut(400, function() {
            $(this).load(url, function() {
                $(this).fadeIn(400);
            });
        });
    }
    
    $(document).on('click', '#index, #btn_cancelar_registro', function(){
        cargarPagina('system/principal.php');
    });

    $(document).on('click', '#registro, #boton_registro', function(){
        cargarPagina('system/registro.php');
    });

    $(document).on('click', '#lista_usuarios, #boton_lista', function(){
        cargarPagina('system/lista_usuarios.php');
    });
    
});