<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="/dashboard" class="app-brand-link">
			<span class="app-brand-logo demo">
				<div class="logo">
					<img src="{{ asset('img') }}/logo.png" alt="Logo Piaget" class="img-thumbnail" width="120">
				</div>
			</span>
		</a>

		<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
			<i class="bx bx-chevron-left bx-sm align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>

	<ul class="menu-inner py-1 mt-4">
		<!-- Dashboard -->
		<li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
			<a href="/dashboard" class="menu-link">
				<i class="menu-icon tf-icons bx bx-home-circle"></i>
				<div>Dashboard</div>
			</a>
		</li>

		<li class="menu-header small text-uppercase">
			<span class="menu-header-text">MASTER</span>
		</li>
		<li class="menu-item {{ request()->is('purchasing', 'purchasing/create', 'history') ? 'active open' : '' }}">
			<a href="javascript:void(0);" class="menu-link menu-toggle">
				<i class='menu-icon tf-icons bx bxs-purchase-tag'></i>
				<div>Purchase Order</div>
			</a>
			<ul class="menu-sub">
				<li class="menu-item {{ request()->is('purchasing/create') ? 'active' : '' }}">
					<a href="/purchasing/create" class="menu-link">
						<div>Form PO</div>
					</a>
				</li>
				<li class="menu-item {{ request()->is('purchasing') ? 'active' : '' }}">
					<a href="/purchasing" class="menu-link">
						<div>Daftar Pengajuan</div>
					</a>
				</li>
			</ul>
		</li>

		<li class="menu-item {{ request()->is('supplier', 'supplier/create', 'history') ? 'active open' : '' }}">
			<a href="javascript:void(0);" class="menu-link menu-toggle">
				<i class='menu-icon tf-icons bx bxs-building-house'></i>
				<div>Supplier</div>
			</a>
			<ul class="menu-sub">
				<li class="menu-item {{ request()->is('supplier', 'supplier/create') ? 'active' : '' }}">
					<a href="/supplier" class="menu-link">
						<div>Daftar Supplier</div>
					</a>
				</li>
			</ul>
		</li>

		<li class="menu-item {{ request()->is('laporanpembelian', 'datapembelian') ? 'active open' : '' }}">
			<a href="javascript:void(0);" class="menu-link menu-toggle">
				<i class='menu-icon tf-icons bx bxs-report'></i>
				<div>Laporan</div>
			</a>
			<ul class="menu-sub ">
				<li class="menu-item {{ request()->is('laporanpembelian', 'datapembelian') ? 'active' : '' }}">
					<a href="/laporanpembelian" class="menu-link">
						<div>Laporan Pembelian</div>
					</a>
				</li>
			</ul>
		</li>

		@if (Auth::user()->role == 'admin')
			<li class="menu-item {{ request()->is('user') ? 'active open' : '' }}">
				<a href="javascript:void(0);" class="menu-link menu-toggle">
					<i class='menu-icon tf-icons bx bxs-user-circle'></i>
					<div>Account</div>
				</a>
				<ul class="menu-sub">
					<li class="menu-item {{ request()->is('user') ? 'active' : '' }}">
						<a href="/user" class="menu-link">
							<div>Account List</div>
						</a>
					</li>
				</ul>
			</li>
		@endif
		@if (Auth::user()->role !== 'admin')
			<li class="menu-item {{ request()->is('profile') ? 'active open' : '' }}">
				<a href="javascript:void(0);" class="menu-link menu-toggle">
					<i class='menu-icon tf-icons bx bxs-user-circle'></i>
					<div>Akun</div>
				</a>
				<ul class="menu-sub">
					<li class="menu-item {{ request()->is('profile') ? 'active' : '' }}">
						<a href="/profile" class="menu-link">
							<div>Profile</div>
						</a>
					</li>
					<li class="menu-item {{ request()->is('jabatan') ? 'active' : '' }}">
						<form action="{{ route('logout') }}" method="POST">
							@csrf
							<button type="submit" class="dropdown-item">
								<i class="bx bx-power-off me-2"></i>
								<span class="align-middle">Log Out</span>
							</button>
						</form>
					</li>
				</ul>
			</li>
		@endif
	</ul>
</aside>
<!-- / Menu -->
