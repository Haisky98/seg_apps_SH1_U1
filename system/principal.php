<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        
        <div class="row g-5 g-xl-8">
            <div class="col-xl-12">
                <div class="card card-xl-stretch mb-5 mb-xl-8">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Panel de Control de Autenticación</span>
                            <span class="text-muted fw-bold fs-7">Comparativa de algoritmos de seguridad: SHA256 vs Bcrypt</span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-5">
                            <div class="col-md-6">
                                <a id="boton_registro" href="javascript:;" class="card card-stretch bg-primary hover-elevate-up shadow-sm p-5 text-white">
                                    <span class="fs-4 fw-bold">Registrar Usuario</span>
                                    <span class="opacity-75">Insertar nuevas credenciales al sistema.</span>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a id="boton_lista" href="javascript:;" class="card card-stretch bg-success hover-elevate-up shadow-sm p-5 text-white">
                                    <span class="fs-4 fw-bold">Gestión de Usuarios</span>
                                    <span class="opacity-75">Ver, editar y eliminar usuarios registrados.</span>
                                </a>
                            </div>
                        </div>

                        <div class="mt-10 p-10 bg-light-info rounded border-dashed border-info">
                            <h4 class="text-info">¿Qué es esta práctica?</h4>
                            <p class="text-gray-700">
                                Este sistema demuestra la vulnerabilidad del hashing estático (SHA256) frente a algoritmos de hashing 
                                con salt dinámico (Bcrypt) mediante la persistencia en base de datos.
                            </p>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
        </div>
</div>

<div class="row g-5 g-xl-10 mb-5 mb-xl-10">
    <div class="col-xl-6">
        <div class="card card-flush h-md-100">
            <div class="card-header pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder text-gray-800">Modo Inseguro (SHA256)</span>
                </h3>
            </div>
            <div class="card-body">
                <p>El sistema aplica SHA256 directamente a la contraseña. Es extremadamente rápido, lo que facilita ataques de fuerza bruta.</p>
                <ul class="list-unstyled">
                    <li><i class="fas fa-times text-danger me-2"></i> Sin "Salt": hashes predecibles.</li>
                    <li><i class="fas fa-times text-danger me-2"></i> Vulnerable a Tablas Rainbow.</li>
                    <li><i class="fas fa-times text-danger me-2"></i> Velocidad alta (fácil de crackear).</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card card-flush h-md-100">
            <div class="card-header pt-7">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder text-success">Modo Seguro (password_verify)</span>
                </h3>
            </div>
            <div class="card-body">
                <p>Utiliza Bcrypt/Argon2 con "Salt" automático. Es el estándar profesional para proteger credenciales.</p>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check text-success me-2"></i> Hashing adaptativo (lento por diseño).</li>
                    <li><i class="fas fa-check text-success me-2"></i> Salt único por usuario.</li>
                    <li><i class="fas fa-check text-success me-2"></i> Resistencia alta a fuerza bruta.</li>
                </ul>
            </div>
        </div>
    </div>
    </div>

<div class="card card-flush mt-5">
    <div class="card-header pt-7">
        <h3 class="card-title">Comparativa Técnica</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-row-bordered table-striped align-middle">
                <thead>
                    <tr class="fw-bolder text-gray-600">
                        <th>Característica</th>
                        <th>Modo Inseguro (SHA256)</th>
                        <th>Modo Seguro (password_verify)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Algoritmo</td>
                        <td>SHA256 (rápido)</td>
                        <td>Bcrypt/Argon2 (lento)</td>
                    </tr>
                    <tr>
                        <td>Protección Salt</td>
                        <td>No (predecible)</td>
                        <td>Sí (único)</td>
                    </tr>
                    <tr>
                        <td>Resistencia Rainbow</td>
                        <td>Nula</td>
                        <td>Muy alta</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>