@extends('layouts.main')

@section('content')
	<div class="row">
		<div class="col-12 mb-4 order-0">
			<div class="card">
				<div class="card-header">
					<div class="text-start">
						<H3>Form Laporan Pembelian</H3>
						<hr>
						<p>Pilih rentang hari untuk mendapatkan rekap Daftar Pengajuan Pembelian</p>
					</div>
				</div>
				<div class="card-body">
					<div class="alert alert-primary" role="alert">
						Pilih <strong>Tanggal Mulai</strong> dan <strong>Tanggal Selesai</strong>
					</div>
					<form action="{{ route('datapembelian') }}" method="post" id="reportForm">
						@csrf
						<div class="row">
							<div class="col-sm-6 mb-3">
								<label for="start_date" class="form-label">Tanggal Mulai</label>
								<input class="form-control @error('start_date') is-invalid @enderror" type="date" id="start_date"
									name="start_date" value="{{ old('start_date') }}" max="{{ date('Y-m-d') }}" />
								@error('start_date')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="end_date" class="form-label">Tanggal Selesai</label>
								<input class="form-control @error('end_date') is-invalid @enderror" type="date" id="end_date" name="end_date"
									value="{{ old('end_date') }}" />
								@error('end_date')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="clearForm()">
						Clear Form
					</button>
					<button type="submit" class="btn btn-primary ms-2"><i class="bx bxs-report"></i> Submit</button>
				</div>
				</form>
			</div>
		</div>
	</div>
@endsection
