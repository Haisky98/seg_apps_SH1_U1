<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
<base href="../../../" />
		<title>Inicia Sesión</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Metronic - The World's #1 Selling Bootstrap Admin Template by KeenThemes" />
		<meta property="og:url" content="https://keenthemes.com/metronic" />
		<meta property="og:site_name" content="Metronic by Keenthemes" />
		<link rel="canonical" href="http://preview.keenthemes.comauthentication/layouts/corporate/sign-in.html" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="auth-bg">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
					<!--begin::Form-->
					<div class="d-flex flex-center flex-column flex-lg-row-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-500px p-10">
							<!--begin::Form-->
							<form class="form w-100" id="kt_sign_in_form">
                                <div class="text-center mb-11">
                                    <h1 class="text-gray-900 fw-bolder mb-3">Inicio de Sesion</h1>
                                    <select id="auth_mode" class="form-select form-select-solid mb-5">
                                        <option value="seguro">Modo Seguro (password_verify)</option>
                                        <option value="inseguro">Modo Inseguro (SHA256)</option>
                                    </select>
                                </div>

                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Usuario" name="username" class="form-control bg-transparent" required />
                                </div>
                                
                                <div class="fv-row mb-3">
                                    <input type="password" placeholder="Password" name="password" class="form-control bg-transparent" required />
                                </div>

                                <div class="d-grid mb-10 pt-5">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                        <span class="indicator-label">Ingresar</span>
                                        <span class="indicator-progress">Validando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
								<div class="text-gray-500 text-center fw-semibold fs-6">
									¿No tienes una cuenta aún?
									<a href="crear_cuenta.php" class="link-primary fw-bold">Regístrate aquí</a>
								</div>
                            </form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Form-->
				</div>
				<!--end::Body-->
				<!--begin::Aside-->
				<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url(assets/media/misc/auth-bg.png)">
					<!--begin::Content-->
					<div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
						<!--begin::Logo-->
						<a href="#" class="mb-0 mb-lg-12">
							<img alt="Logo" src="assets/media/logos/custom-1.png" class="h-60px h-lg-75px" />
						</a>
						<!--end::Logo-->
						<!--begin::Title-->
						<h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">SABER HACER 1</h1>
						<!--end::Title-->
						<!--begin::Text-->
						<div class="d-none d-lg-block text-white fs-base text-center">Unidad 1
						<a href="#" class="opacity-75-hover text-warning fw-bold me-1">Principios de codificación segura</a>
                        <br>
                        <a href="#" class="opacity-75-hover text-warning fw-bold me-1">Ingenieria en Desarollo y gestión de software</a>
                        <br>
                        <a href="#" class="opacity-75-hover text-warning fw-bold me-1">Daniel Eduardo Ortiz Ortega 23040104</a>
                        <br>
                        <a href="#" class="opacity-75-hover text-warning fw-bold me-1">ALAN DE JESUS DIAZ FLORES</a></div>
						<!--end::Text-->
					</div>
					<!--end::Content-->
				</div>
				<!--end::Aside-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
        <script src="assets/plugins/global/plugins.bundle.js"></script>
        <script src="assets/js/scripts.bundle.js"></script>
        <script>
            $('#kt_sign_in_form').submit(function(e) {

                e.preventDefault();

                const btn = $('#kt_sign_in_submit');

                btn.attr('data-kt-indicator', 'on')
                .prop('disabled', true);

                const mode = $('#auth_mode').val();

                const url = mode === 'seguro'
                    ? 'actions/auth_seguro.php'
                    : 'actions/auth_inseguro.php';

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',

                    success: function(json) {

                        btn.removeAttr('data-kt-indicator')
                        .prop('disabled', false);

                        if (json.bool) {

                            Swal.fire({
                                text: "¡Éxito! " + json.mensaje,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Entendido",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(() => {

                                window.location.href = 'index.php';

                            });

                        } else {

                            Swal.fire({
                                text: "Error: " + json.mensaje,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Intentar de nuevo",
                                customClass: {
                                    confirmButton: "btn btn-danger"
                                }
                            });

                        }
                    },

                    error: function(xhr) {

                        btn.removeAttr('data-kt-indicator')
                        .prop('disabled', false);

                        console.log(xhr.responseText);

                        Swal.fire({
                            text: "Error en el servidor",
                            icon: "error"
                        });
                    }
                });

            });
        </script>
	</body>
	<!--end::Body-->
</html>