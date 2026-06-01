<div class="card card-flush">
    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
        <h3 class="card-title">Listado de Usuarios</h3>
    </div>
    <div class="card-body pt-0">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="tabla_usuarios">
            <thead>
                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Password Inseguro</th>
                    <th>Password Seguro</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
                </tbody>
        </table>
    </div>
</div>

 


<script>
$(document).ready(function() {
    // Inicializar DataTable
    var tabla = $('#tabla_usuarios').DataTable({
            "ajax": "actions/read_usuarios.php",
            "columns": [
                { "data": "id" },
                { "data": "username" },
                { "data": "password_insegura"},
                { "data": "password_segura"},
                { 
                    "data": null,
                    "className": "text-end",
                    "render": function(data, type, row) {
                        return `
                            <button class="btn btn-primary btn-sm editar" data-id="${row.id}">Editar</button>
                            <button class="btn btn-danger btn-sm borrar" data-id="${row.id}">Borrar</button>`;
                    }
                }
            ]
        });

        $('#modal_editar_usuario').on('hidden.bs.modal', function () {
            $('#form_editar_usuario')[0].reset();
            $('#edit_id').val('');          
        });

        // Envío del formulario de edición
        $('#form_editar_usuario').submit(function(e) {
            e.preventDefault();
            
            $.post('actions/update_usuario.php', $(this).serialize(), function(res) {
                let json = typeof res === 'string' ? JSON.parse(res) : res;
                
                if(json.bool) {
                    $('#modal_editar_usuario').modal('hide');
                    tabla.ajax.reload(); 
                    
                 
                    Swal.fire({
                        text: "Usuario actualizado correctamente",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Entendido",
                        customClass: { confirmButton: "btn btn-primary" }
                    });
                } else {
                    Swal.fire({
                        text: "Error al actualizar: " + (json.error || "Intente de nuevo"),
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Entendido",
                        customClass: { confirmButton: "btn btn-danger" }
                    });
                }
            });
        });

    $(document).on('click', '.borrar', function() {
        let id = $(this).data('id');
        if(confirm("¿Estás seguro de borrar este usuario?")) {
            $.post('actions/delete_usuario.php', {id: id}, function(res) {
                tabla.ajax.reload(); 
            });
        }
    });
});

$(document).on('click', '.editar', function() {
    let id = $(this).data('id');
    let username = $(this).closest('tr').find('td:eq(1)').text(); 

    $('#edit_id').val(id);
    $('#edit_username').val(username);
  
    new bootstrap.Modal('#modal_editar_usuario').show();
});

$('#form_editar_usuario').submit(function(e) {
    e.preventDefault();
    $.post('actions/update_usuario.php', $(this).serialize(), function(res) {
        let json = JSON.parse(res);
        if(json.bool) {
            $('#modal_editar_usuario').modal('hide');
            $('#tabla_usuarios').DataTable().ajax.reload();
        } else {
            alert("Error al actualizar: " + json.error);
        }
    });
});
</script>