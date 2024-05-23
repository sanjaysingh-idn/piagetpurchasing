<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style customizer-hide" dir="ltr"
	data-theme="theme-default" data-assets-path="{{ asset('template') }}/assets/" data-template="vertical-menu-template-free">

	<head>
		<meta charset="utf-8" />
		<meta name="viewport"
			content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

		<title>Login Page | PIAGET PURCHASING</title>

		<meta name="description" content="" />
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="theme-color" content="#ffffff">

		<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon') }}/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon') }}/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon') }}/favicon-16x16.png">
		<link rel="manifest" href="{{ asset('img/favicon') }}/site.webmanifest">

		<!-- Fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
			href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
			rel="stylesheet" />

		<!-- Icons. Uncomment required icon fonts -->
		<link rel="stylesheet" href="{{ asset('template') }}/assets/vendor/fonts/boxicons.css" />

		<!-- Core CSS -->
		<link rel="stylesheet" href="{{ asset('template') }}/assets/vendor/css/core.css"
			class="template-customizer-core-css" />
		<link rel="stylesheet" href="{{ asset('template') }}/assets/vendor/css/theme-default.css"
			class="template-customizer-theme-css" />
		<link rel="stylesheet" href="{{ asset('template') }}/assets/css/demo.css" />

		<!-- Vendors CSS -->
		<link rel="stylesheet" href="{{ asset('template') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

		<!-- Page CSS -->
		<!-- Page -->
		<link rel="stylesheet" href="{{ asset('template') }}/assets/vendor/css/pages/page-auth.css" />
		<!-- Helpers -->
		<script src="{{ asset('template') }}/assets/vendor/js/helpers.js"></script>

		<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
		<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
		<script src="{{ asset('template') }}/assets/js/config.js"></script>
	</head>

	<body>
		<!-- Content -->

		@if (session()->has('loginError'))
			<div class="bs-toast toast toast-placement-ex m-2 fade bg-danger top-0 start-50 translate-middle-x show"
				role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
				<div class="toast-header">
					<i class='bx bx-error-circle me-2'></i>
					<div class="me-auto fw-semibold">{{ session('loginError') }}</div>
					<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
				</div>
			</div>
		@endif

		<div class="container-xxl">
			<div class="authentication-wrapper authentication-basic container-p-y">
				<div class="authentication-inner">
					<!-- Register -->
					<div class="card">
						<div class="card-body">
							<!-- Logo -->
							<div class="text-center">
								<div class="logo">
									<img src="{{ asset('img') }}/logo.png" style="width: 200px;" alt="Logo Piaget">
									<div class="line border-bottom border-3 border-primary rounded-pill my-2"></div>
								</div>
								{{-- <div class="fs-6 fw-bold">
									( SIPERJADIN )
								</div> --}}
								<div class="fs-4 fw-bold my-3">
									Sistem Informasi Pengajuan Pembelian Barang
								</div>
							</div>
							<!-- /Logo -->

							<form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
								@csrf
								<div class="mb-3">
									<label for="email" class="form-label">Email</label>
									<input type="text" placeholder="Email" id="email" name="email"
										class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autofocus>
									@error('email')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="mb-3 form-password-toggle">
									<div class="d-flex justify-content-between">
										<label class="form-label" for="password">Password</label>
									</div>
									<div class="input-group input-group-merge">
										<input type="password" id="password" class="form-control" name="password"
											placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
											aria-describedby="password" />
										<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
									</div>
								</div>
								<div class="mb-3">
									<div class="form-check">
										<input class="form-check-input" name="remember" type="checkbox" id="remember-me" />
										<label class="form-check-label" for="remember-me"> Remember Me </label>
									</div>
								</div>
								<div class="mb-3">
									<button class="btn btn-primary w-100" type="submit"><i class='bx bx-log-in'></i> Login</button>
								</div>
							</form>

						</div>
					</div>
					<!-- /Register -->
				</div>
			</div>
		</div>

		<!-- / Content -->

		<!-- Core JS -->
		<!-- build:js assets/vendor/js/core.js -->
		<script src="{{ asset('template') }}/assets/vendor/libs/jquery/jquery.js"></script>
		<script src="{{ asset('template') }}/assets/vendor/libs/popper/popper.js"></script>
		<script src="{{ asset('template') }}/assets/vendor/js/bootstrap.js"></script>
		<script src="{{ asset('template') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

		<script src="{{ asset('template') }}/assets/vendor/js/menu.js"></script>
		<!-- endbuild -->

		<!-- Vendors JS -->

		<!-- Main JS -->
		<script src="{{ asset('template') }}/assets/js/main.js"></script>

		<!-- Page JS -->
		<script src="{{ asset('template') }}/assets/js/ui-toasts.js"></script>

		<!-- Place this tag in your head or just before your close body tag. -->
		<script async defer src="https://buttons.github.io/buttons.js"></script>
	</body>

</html>
