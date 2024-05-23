@extends('layouts.main')
@section('content')
	<section class="section">
		<div class="row">
			<div class="col-lg-12">

				<div class="card">
					<div class="card-header">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
								class="bx bx-plus-circle"></i> Tambah Supplier</button>
					</div>
					<div class="card-body">

						<table id="dtable" class="table table-hover">
							<caption class="ms-4">

							</caption>
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Supplier</th>
									<th>Alamat</th>
									<th>Kontak</th>
									<th>Keterangan</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@php
									$no = 1;
								@endphp
								@foreach ($suppliers as $item)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $item->nama }}</td>
										<td>{{ $item->alamat }}</td>
										<td>{{ $item->kontak }}</td>
										<td>{{ $item->keterangan }}</td>
										<td>
											<a class="btn btn-xs btn-warning" href="{{ route('supplier.edit', $item->id, '.edit') }}"><i
													class="bx bx-edit-alt me-1"></i> Edit</a>
											<button class="btn btn-xs btn-danger" data-bs-toggle="modal"
												data-bs-target="#modalDelete{{ $item->id }}"><i class="bx bx-trash me-1"></i> Delete</button>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>

					</div>
				</div>

			</div>
	</section>
@endsection
@push('modals')
	{{-- Modal Tambah --}}
	<div class="modal fade" id="modalAdd" tabindex="-1" aria-modal="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalAddTitle">Tambah Supplier</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('supplier.store') }}" method="POST">
					@csrf
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-6 mb-3">
								<label for="nama" class="form-label text-capitalize">Nama</label>
								<input class="form-control @error('nama') is-invalid @enderror" type="text" id="nama" name="nama"
									value="{{ old('nama') }}" />
								@error('nama')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="alamat" class="form-label text-capitalize">alamat</label>
								<input class="form-control @error('alamat') is-invalid @enderror" type="text" id="alamat" name="alamat"
									value="{{ old('alamat') }}" />
								@error('alamat')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="kontak" class="form-label text-capitalize">kontak</label>
								<input class="form-control @error('kontak') is-invalid @enderror" type="text" id="kontak" name="kontak"
									value="{{ old('kontak') }}" />
								@error('kontak')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="keterangan" class="form-label text-capitalize">keterangan</label>
								<input class="form-control @error('keterangan') is-invalid @enderror" type="text" id="keterangan"
									name="keterangan" value="{{ old('keterangan') }}" />
								@error('keterangan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
							Close
						</button>
						<button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Tambah Akun</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	@foreach ($suppliers as $item)
		<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalDeleteTitle">Hapus Suppliers</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('supplier.destroy', $item->id) }}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									<p>Apakah anda yakin ingin menghapus data Supplier <strong>{{ $item->nama }}</strong> ?</p>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
								Close
							</button>
							<button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i> Hapus Supplier</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endforeach
@endpush
