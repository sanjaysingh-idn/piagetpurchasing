@extends('layouts.main')
@section('content')
	<section class="section">
		<div class="row">
			<div class="col-lg-12">
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				<div class="card">
					<div class="card-header">
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd"><i
								class="bx bx-plus-circle"></i> Tambah Akun</button>
					</div>
					<div class="card-body">

						<table id="dtable" class="table table-hover datatable">
							<caption class="ms-4">

							</caption>
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Nip</th>
									<th>Jabatan</th>
									<th>Email</th>
									<th>Role</th>
									<th>Kontak</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@php
									$no = 1;
								@endphp
								@foreach ($users as $item)
									<tr>
										<td>{{ $no++ }}</td>
										<td>{{ $item->name }}</td>
										<td>{{ $item->nip }}</td>
										<td>{{ $item->jabatan }}</td>
										<td>{{ $item->email }}</td>
										<td>
											@if ($item->role == 'admin')
												<span class="badge bg-label-primary me-1">{{ $item->role }}</span>
											@elseif ($item->role == 'staff')
												<span class="badge bg-label-success me-1">{{ $item->role }}</span>
											@elseif ($item->role == 'pimpinan')
												<span class="badge bg-label-info me-1">{{ $item->role }}</span>
											@elseif ($item->role == 'bendahara')
												<span class="badge bg-label-danger me-1">{{ $item->role }}</span>
											@endif
										</td>
										<td>{{ $item->kontak }}</td>
										<td>
											<a class="btn btn-xs btn-warning" href="{{ route('user.edit', $item->id, '.edit') }}"><i
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
					<h5 class="modal-title" id="modalAddTitle">Tambah Akun</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="{{ route('user.store') }}" method="POST">
					@csrf
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-6 mb-3">
								<label for="name" class="form-label text-capitalize">Nama</label>
								<input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name"
									value="{{ old('name') }}" />
								@error('name')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="nip" class="form-label text-capitalize">Nip</label>
								<input class="form-control @error('nip') is-invalid @enderror" type="text" id="nip" name="nip"
									value="{{ old('nip') }}" />
								@error('nip')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="jabatan" class="form-label text-capitalize">Jabatan</label>
								<input class="form-control @error('jabatan') is-invalid @enderror" type="text" id="jabatan" name="jabatan"
									value="{{ old('jabatan') }}" />
								@error('jabatan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="email" class="form-label text-capitalize">Email</label>
								<input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email"
									value="{{ old('email') }}" />
								@error('email')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="kontak" class="form-label text-capitalize">No. HP</label>
								<input class="form-control @error('kontak') is-invalid @enderror" type="number" id="kontak" name="kontak"
									value="{{ old('kontak') }}" />
								@error('kontak')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="role" class="form-label text-capitalize">role</label>
								<select id="role" class="select2 form-select @error('role') is-invalid @enderror" name="role" required>
									<option value="" class="text-capitalize">--Pilih Role--</option>
									@foreach ($role as $r)
										<option value="{{ $r }}" class="text-capitalize">{{ $r }}</option>
									@endforeach
								</select>
								@error('role')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="password" class="form-label text-capitalize">Password</label>
								<input class="form-control @error('password') is-invalid @enderror" type="password" id="password"
									name="password" />
								@error('password')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-sm-6 mb-3">
								<label for="password_confirmation" class="form-label text-capitalize">Confirm Password</label>
								<input class="form-control" type="password" id="password_confirmation" name="password_confirmation" />
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

	@foreach ($users as $item)
		<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalDeleteTitle">Hapus Akun</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('user.destroy', $item->id) }}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									<p>Apakah anda yakin ingin menghapus data Akun <strong>{{ $item->name }}</strong> ?</p>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
								Close
							</button>
							<button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i> Hapus Akun</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endforeach
@endpush
