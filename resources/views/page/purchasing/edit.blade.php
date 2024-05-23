@extends('layouts.main')
@section('content')
	<section class="section">
		<div class="row">
			<div class="col-lg-9">

				<div class="card">
					<div class="card-header">
						<h3>Edit Formulir Pengajuan Pembelian Barang <strong>{{ $purchasing->nomor_po }}</strong></h3>
						<hr>
						<a href="/purchasing" class="btn btn-secondary">
							< Kembali </a>
								@if (session('message'))
									<div class="alert alert-warning alert-dismissible fade show" role="alert">
										<strong>Sukses!</strong> {{ session('message') }}
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
									</div>
								@endif
					</div>
					<div class="card-body">
						<form action="{{ route('purchasing.update', $purchasing->id) }}" method="POST">
							@csrf
							@method('PUT') <!-- Method Spoofing for PUT -->
							<div class="row">
								<div class="col-sm-6 mb-1">
									<label for="nomor_po" class="form-label text-capitalize">Nomor PO</label>
									<input class="form-control @error('nomor_po') is-invalid @enderror" type="text" id="nomor_po"
										name="nomor_po" value="{{ old('nomor_po', $purchasing->nomor_po) }}" required />
									@error('nomor_po')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-6 mb-1">
									<label for="input_by" class="form-label text-capitalize">Diajukan Oleh</label>
									<input class="form-control @error('input_by') is-invalid @enderror" type="text" id="input_by"
										name="input_by" value="{{ old('input_by', Auth()->user()->name) }}" readonly />
									@error('input_by')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-6 mb-1">
									<label for="nama_barang" class="form-label text-capitalize">Nama Barang</label>
									<input class="form-control @error('nama_barang') is-invalid @enderror" type="text" id="nama_barang"
										name="nama_barang" value="{{ old('nama_barang', $purchasing->nama_barang) }}" required />
									@error('nama_barang')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-6 mb-1">
									<label for="supplier" class="form-label text-capitalize">Supplier</label>
									<select class="form-select @error('supplier') is-invalid @enderror" id="supplier" name="supplier" required>
										<option value="">Pilih Supplier</option>
										@foreach ($suppliers as $supplier)
											<option value="{{ $supplier->nama }}"
												{{ old('supplier', $purchasing->supplier) == $supplier->nama ? 'selected' : '' }}>
												{{ $supplier->nama }}
											</option>
										@endforeach
									</select>
									@error('supplier')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-3 mb-1">
									<label for="qty" class="form-label text-capitalize">Quantity</label>
									<input class="form-control @error('qty') is-invalid @enderror" type="number" id="qty" name="qty"
										value="{{ old('qty', $purchasing->qty) }}" required />
									@error('qty')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="col-sm-9 mb-1">
									<label for="harga" class="form-label text-capitalize">Harga</label>
									<div class="input-group input-group-merge">
										<span class="input-group-text">Rp</span>
										<input type="number" min="0" class="form-control @error('harga') is-invalid @enderror" name="harga"
											id="harga" value="{{ old('harga', $purchasing->harga) }}" required>
										@error('harga')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
								</div>
								<div class="col-sm-12 mb-1">
									<label for="total_harga" class="form-label text-capitalize">Total Harga</label>
									<div class="input-group input-group-merge">
										<span class="input-group-text">Rp</span>
										<input type="number" min="0" class="form-control @error('total_harga') is-invalid @enderror"
											name="total_harga" id="total_harga" value="{{ old('total_harga', $purchasing->total_harga) }}" required
											readonly>
										@error('total_harga')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-12">
									<button type="submit" class="btn btn-primary btn-lg"><i class="bx bx-upload"></i> Submit Pengajuan Purchase
										Order</button>
								</div>
							</div>
						</form>
					</div>

				</div>

			</div>
	</section>
@endsection
@push('scripts')
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const qtyInput = document.getElementById('qty');
			const hargaInput = document.getElementById('harga');
			const totalHargaInput = document.getElementById('total_harga');

			function calculateTotal() {
				const qty = parseFloat(qtyInput.value) || 0;
				const harga = parseFloat(hargaInput.value) || 0;
				const total = qty * harga;
				totalHargaInput.value = total;
			}

			qtyInput.addEventListener('input', calculateTotal);
			hargaInput.addEventListener('input', calculateTotal);
		});
	</script>
@endpush
