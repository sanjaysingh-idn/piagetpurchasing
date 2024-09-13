@extends('layouts.main')

@section('content')
	<div class="row">
		<div class="col-12 mb-4 order-0">
			<div class="card">
				<div class="card-header">
					<!-- Back Button -->
					<a href="{{ url()->previous() }}" class="btn btn-secondary">
						&larr; Back
					</a>
					<div class="text-start">
						<H3>{{ $title }}</H3>
						<hr>
						<p>{{ $startDate->format('d F Y') }} - {{ $endDate->format('d F Y') }}</p>
					</div>
				</div>
				<div class="card-body">
					<table class="table table-hover">
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
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>

			<hr>
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-6">
							<table class="table table-borderless">
								<thead>
									<tr>
										<th scope="col"></th>
										<th scope="col"></th>
										<th scope="col"></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Total Pengajuan</td>
										<td>{{ $totalPurchases }}</td>
									</tr>
									<tr>
										<td>Total Pengajuan Diterima</td>
										<td>{{ $totalAcceptedPurchases }}</td>
									</tr>
									<tr>
										<td>Jumlah Pengajuan Diterima</td>
										<td>Rp {{ number_format($totalAcceptedPrice) }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
