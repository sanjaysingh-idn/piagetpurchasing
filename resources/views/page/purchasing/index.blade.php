@extends('layouts.main')
@section('content')
	<section class="section">
		<div class="row">
			<div class="col-lg-12">

				<div class="card mb-3">
					<div class="card-header">
						<h3>Daftar Pengajuan Pembelian Barang</h3>
						<hr>
					</div>
					<div class="card-body">

						<table id="dtable" class="table table-hover">
							<caption class="ms-4">

							</caption>
							<thead>
								<tr>
									<th>Nomor Po</th>
									<th>Nama Barang</th>
									<th>Quantity</th>
									<th>Harga</th>
									<th>Supplier</th>
									<th>Total Harga</th>
									<th>Status</th>
									<th>Diajukan</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($purchasing as $item)
									<tr>
										<td>{{ $item->nomor_po }}</td>
										<td class="fw-bold">{{ $item->nama_barang }}</td>
										<td>{{ $item->qty }}</td>
										<td>Rp. {{ number_format($item->harga) }}</td>
										<td>{{ $item->supplier }}</td>
										<td class="fw-bold">Rp. {{ number_format($item->total_harga) }}</td>
										<td class="text-uppercase">
											@if ($item->status == 'pengajuan')
												<span class="badge bg-label-primary me-1">{{ $item->status }}</span>
											@elseif ($item->status == 'verifikasi')
												<span class="badge bg-label-warning me-1">{{ $item->status }}</span>
											@elseif ($item->status == 'setuju')
												<span class="badge bg-label-success me-1">{{ $item->status }}</span>
											@elseif ($item->status == 'tolak')
												<span class="badge bg-label-danger me-1">{{ $item->status }}</span>
											@endif
										</td>
										<td>
											{{ $item->input_by }}
											<br>
											<small>{{ $item->created_at->format('d F Y H:i') }}</small>
										</td>
										<td>
											<button class="btn btn-primary btn-xs" data-bs-toggle="modal"
												data-bs-target="#modalStatus{{ $item->id }}"><i class="bx bx-pen me-1"></i> Ubah Status</button>
											<a class="btn btn-xs btn-warning" href="{{ route('purchasing.edit', $item->id, '.edit') }}"><i
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

	@foreach ($purchasing as $item)
		<div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" aria-modal="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalDeleteTitle">Hapus Pengajuan Purchasing</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{ route('purchasing.destroy', $item->id) }}" method="POST">
						@csrf
						@method('delete')
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									<p>Apakah anda yakin ingin menghapus data Pengajuan Purchasing <strong>{{ $item->nama_barang }}</strong> ?</p>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
								Close
							</button>
							<button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i> Hapus Pengajuan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endforeach

	@if (isset($purchasing))
		{{-- Modal Verifikasi --}}
		@foreach ($purchasing as $item)
			{{-- @if ($item->status == 'usulan') --}}
			<div class="modal fade" id="modalStatus{{ $item->id }}" tabindex="-1" aria-modal="true">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
						<div class="modal-header bg-primary pb-3">
							<h5 class="modal-title text-white" id="modalStatusTitle">Verifikasi Status Purchase Order</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-12">
									<h4>Apakah anda yakin akan memberikan verifikasi kepada Purchasing Order dibawah ini :</h4>
									<ul class="mt-2">
										<li>
											<p>Nomor PO : <b>{{ $item->nomor_po }}</b></p>
										</li>
										<li>
											<p>Nama Barang : <b>{{ $item->nama_barang }}</b></p>
										</li>
										<li>
											<p>Qty * Harga : <b>{{ $item->qty }} * Rp. {{ number_format($item->harga) }}</b></p>
										</li>
										<li>
											<p>Total Harga : <b>Rp. {{ number_format($item->total_harga) }}</b></p>
										</li>
										<li>
											<p>Keterangan : <b>{{ $item->keterangan }}</b></p>
										</li>
										<li>
											<p>Diajukan oleh : <b>{{ $item->input_by }}</b></p>
										</li>
									</ul>
								</div>
								<hr>
								<div class="col-12">
									<div class="mb-3">
										<form action="{{ route('purchasingStatus', $item->id) }}" method="post">
											@csrf
											<label for="status" class="form-label"><b>Pilih Status</b></label>
											<select class="form-select form-select-lg" name="status" id="status" required>
												<option value="" disabled selected>--Pilih Status--</option>
												@foreach ($status as $st)
													<option value="{{ $st }}">{{ $st }}</option>
												@endforeach
											</select>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
								Close
							</button>
							<button type="submit" class="btn btn-primary"><i class="bx bx-pen"></i> Ubah Status Purchase Order</button>
						</div>
						</form>
					</div>
				</div>
			</div>
			{{-- @endif --}}
		@endforeach
	@endif
@endpush
