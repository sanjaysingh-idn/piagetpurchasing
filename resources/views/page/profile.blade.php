@extends('layouts.main')
@section('content')
	<div class="container-xxl flex-grow-1 container-p-y">
		<h4 class="fw-bold py-3 mb-4">Pengaturan Akun</h4>
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-4">
					<h5 class="card-header">Detail Profil</h5>
					<form action="{{ route('profile.update') }}" method="POST">
						@csrf
						@method('PUT')
						<div class="card-body">
							<div class="row">
								<div class="mb-3 col-md-6">
									<label for="name" class="form-label">Nama Lengkap</label>
									<input class="form-control" type="text" id="name" name="name" value="{{ $user->name }}"
										autofocus />
								</div>
								<div class="mb-3 col-md-6">
									<label for="email" class="form-label">E-mail</label>
									<input class="form-control" type="email" id="email" name="email" value="{{ $user->email }}" />
								</div>
								<div class="mb-3 col-md-6">
									<label for="nip" class="form-label">NIP</label>
									<input class="form-control" type="text" id="nip" name="nip" value="{{ $user->nip }}" />
								</div>
								<div class="mb-3 col-md-6">
									<label for="kontak" class="form-label">Nomor HP</label>
									<input type="text" class="form-control" id="kontak" name="kontak" value="{{ $user->kontak }}" />
								</div>
								<div class="mb-3 col-md-6">
									<label class="form-label">Jabatan</label>
									<input type="text" class="form-control" value="{{ $user->jabatan }}" disabled />
									<small class="text-muted">Jabatan hanya bisa diubah oleh Admin.</small>
								</div>
								<div class="mb-3 col-md-6">
									<label class="form-label">Role</label>
									<span class="badge bg-label-primary d-block"
										style="text-align: left; padding: 10px;">{{ strtoupper($user->role) }}</span>
								</div>
							</div>
						</div>
						<hr class="my-0" />
						<div class="card-body">
							<h5 class="mb-4">Ganti Password (Opsional)</h5>
							<div class="row">
								<div class="mb-3 col-md-6">
									<label for="password" class="form-label">Password Baru (Kosongkan jika tidak ganti)</label>
									<input class="form-control" type="password" name="password" id="password" placeholder="············"
										autocomplete="new-password" />
								</div>

								<div class="mb-3 col-md-6">
									<label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
									<input class="form-control" type="password" id="password_confirmation" name="password_confirmation"
										placeholder="············" />
								</div>
							</div>
							<div class="mt-2">
								<button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
								<button type="reset" class="btn btn-outline-secondary">Batal</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
