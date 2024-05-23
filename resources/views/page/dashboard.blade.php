@extends('layouts.main')

@section('content')
	<div class="row">
		<div class="col-12 mb-4 order-0">
			<div class="card">
				<div class="d-flex align-items-end row">
					<div class="col-sm-7">
						<div class="card-body">
							<h5 class="card-title text-primary">Selamat Datang</h5>
							<p>
								<small><i class="bx bx-user"></i> {{ Auth::user()->name }} -- {{ Auth::user()->jabatan }}</small>
							</p>
							<p>
								<small class="text-capitalize"><strong>{{ Auth::user()->role }}</strong></small>
							</p>
							<p class="mb-4">
								Ini adalah halaman dashboard <strong>Sistem Informasi Pengajuan Pembelian Barang</strong> Singapore Piaget
								Academy
							</p>
						</div>
					</div>
					<div class="col-sm-5 text-center text-sm-left">
						<div class="card-body pb-0 px-0 px-md-4">
							<img src="{{ asset('template') }}/assets/img/illustrations/man-with-laptop-light.png" height="140"
								alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
								data-app-light-img="illustrations/man-with-laptop-light.png" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<h3 style="letter-spacing: 3px"><strong>TOTAL PENGAJUAN PEMBELIAN BARANG</strong></h3>
			<div class="row">
				<div class="col-sm-6 mb-4">
					<div class="card rounded">
						<div class="card-body bg-primary text-white">
							<span class="fw-semibold d-block mb-1">TOTAL TAHUNAN - {{ date('Y') }}</span>
							<h2 class="card-title mb-2 fw-bold text-white my-4">Rp. {{ number_format($tahunan) }}</h2>
						</div>
					</div>
				</div>
				<div class="col-sm-6 mb-4">
					<div class="card">
						<div class="card-body bg-dark text-white">
							<span class="fw-semibold d-block mb-1">TOTAL BULANAN - {{ date('F') }}</span>
							<h2 class="card-title mb-2 fw-bold text-white my-4">Rp. Rp. {{ number_format($bulanan) }}</h2>
							{{-- @if (Auth::user()->role !== 'pegawai')
								<small class="text-primary fw-semibold">
									<a href="/user" class="btn btn-light btn-sm text-decoration-none text-primary mt-4"><i
											class="bx bx-subdirectory-right"></i> Laporan</a>
								</small>
							@endif --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	</div>
@endsection
