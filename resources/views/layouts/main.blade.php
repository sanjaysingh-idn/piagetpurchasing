<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
	data-assets-path="{{ asset('template') }}/assets/" data-template="vertical-menu-template-free">

	<head>
		<meta charset="utf-8" />
		<meta name="viewport"
			content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

		<title>{{ $title }} | Piaget Purchasing</title>

		<meta name="description" content="" />
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

		<link rel="stylesheet" href="{{ asset('template') }}/assets/vendor/libs/apex-charts/apex-charts.css" />
		<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

		<!-- Page CSS -->

		<!-- Helpers -->
		<script src="{{ asset('template') }}/assets/vendor/js/helpers.js"></script>

		<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
		<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
		<script src="{{ asset('template') }}/assets/js/config.js"></script>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/css/multi-select-tag.css">

		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

		<style>
			.selected-user {
				display: inline-block;
				padding: 5px;
				margin: 5px;
			}

			.delete-button {
				margin-left: 10px;
				padding: 10px;
				cursor: pointer;
			}
		</style>

	</head>

	<body>
		<!-- Layout wrapper -->
		<div class="layout-wrapper layout-content-navbar">
			<div class="layout-container">
				@include('layouts.sidebar')

				<!-- Layout container -->
				<div class="layout-page">
					@include('layouts.topbar')

					<!-- Content wrapper -->
					<div class="content-wrapper">
						<!-- Content -->

						<div class="container-xxl flex-grow-1 container-p-y">
							@include('layouts.toast')
							@yield('content')
						</div>
						<!-- / Content -->

						@stack('modals')
						@include('layouts.footer')

						<div class="content-backdrop fade"></div>
					</div>
					<!-- Content wrapper -->
				</div>
				<!-- / Layout page -->
			</div>

			<!-- Overlay -->
			<div class="layout-overlay layout-menu-toggle"></div>
		</div>
		<!-- / Layout wrapper -->

		<!-- Core JS -->
		<!-- build:js assets/vendor/js/core.js -->
		<script src="{{ asset('template') }}/assets/vendor/libs/jquery/jquery.js"></script>
		<script src="{{ asset('template') }}/assets/vendor/libs/popper/popper.js"></script>
		<script src="{{ asset('template') }}/assets/vendor/js/bootstrap.js"></script>
		<script src="{{ asset('template') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

		<script src="{{ asset('template') }}/assets/vendor/js/menu.js"></script>
		<!-- endbuild -->

		<!-- Vendors JS -->
		<script src="{{ asset('template') }}/assets/vendor/libs/apex-charts/apexcharts.js"></script>

		<!-- Main JS -->
		<script src="{{ asset('template') }}/assets/js/main.js"></script>

		<!-- Page JS -->
		<script src="{{ asset('template') }}/assets/js/dashboards-analytics.js"></script>

		<!-- Place this tag in your head or just before your close body tag. -->
		<script async defer src="https://buttons.github.io/buttons.js"></script>

		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag/dist/js/multi-select-tag.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
		<script>
			$(document).ready(function() {
				$('#dtable').DataTable({});
			});
		</script>
		@stack('scripts')
	</body>

</html>
