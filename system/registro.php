<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        
        <div class="card">
            <div class="card-header">
                <h3 class="card-title fw-bolder text-dark">Formulario de Registro</h3>
            </div>
            
            <form action="actions/create_usuario.php" method="POST" class="form" id="form_registro">
                <div class="card-body">
                    
                    <div class="mb-10">
                        <label class="form-label fw-bold fs-6 text-gray-700">Nombre de Usuario</label>
                        <input type="text" name="username" class="form-control form-control-lg form-control-solid" placeholder="Ingrese nombre de usuario" required />
                    </div>

                    <div class="mb-10">
                        <label class="form-label fw-bold fs-6 text-gray-700">Contraseña</label>
                        <input type="password" name="password" class="form-control form-control-lg form-control-solid" placeholder="Ingrese contraseña" required />
                    </div>

                </div>
                
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a id="btn_cancelar_registro" href="javascript:;" class="btn btn-light btn-active-light-primary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Registrar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$('#form_registro').submit(function(e) {
    e.preventDefault();
    const btn = $('#btn_guardar');
    btn.prop('disabled', true).text('Registrando...');

    $.ajax({
        url: 'actions/create_usuario.php',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json', 
        success: function(res) {
            btn.prop('disabled', false).text('Registrar Usuario');
            if(res.bool) {
                Swal.fire({
                    text: res.mensaje,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    customClass: { confirmButton: "btn btn-primary" }
                }).then(() => { $('#form_registro')[0].reset(); });
            } else {
                Swal.fire({
                    text: res.mensaje,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    customClass: { confirmButton: "btn btn-danger" }
                });
            }
        }
    });
});
</script>