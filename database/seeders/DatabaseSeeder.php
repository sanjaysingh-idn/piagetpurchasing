<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Supplier;
use App\Models\Purchasing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'          => 'Rado Aditya Sejati',
            'nip'           => '202422887',
            'jabatan'       => 'Admin',
            'email'         => 'admin@gmail.com',
            'role'          => 'admin',
            'kontak'        => '08123456789',
            'password'      => bcrypt('password'),
        ]);

        Supplier::create([
            'nama'          => 'CV. Maju Jaya',
            'alamat'        => 'Jl. A. Yani, no. 44 Laweyan, Surakarta, Jawa Tengah',
            'kontak'        => '08213345563',
            'keterangan'    => 'Supplier Alat2 ATK',
        ]);

        Supplier::create([
            'nama'          => 'Toyota Nasmoco',
            'alamat'        => 'Jl. Slamet Riyadi, no. 33 Purwosari, Surakarta, Jawa Tengah',
            'kontak'        => '08213345563',
            'keterangan'    => 'Showroom Mobil',
        ]);

        Purchasing::create([
            'nomor_po'      => 'PO/2024/V/23',
            'nama_barang'   => 'Papan Tulis Besar',
            'qty'           => 5,
            'harga'         => 500000,
            'supplier'      => 'CV. Maju Jaya',
            'total_harga'   => 2500000,
            'keterangan'    => '-',
            'input_by'      => 'Rado Aditya Sejati',
        ]);

        Purchasing::create([
            'nomor_po'      => 'PO/2024/V/28',
            'nama_barang'   => 'Kertas HVS A4',
            'qty'           => 10,
            'harga'         => 50000,
            'supplier'      => 'CV. Maju Jaya',
            'total_harga'   => 500000,
            'keterangan'    => '-',
            'status'        => 'verifikasi',
            'input_by'      => 'Rado Aditya Sejati',
        ]);

        Purchasing::create([
            'nomor_po'      => 'PO/2024/V/28',
            'nama_barang'   => 'Amplop Coklat',
            'qty'           => 100,
            'harga'         => 10000,
            'supplier'      => 'CV. Maju Jaya',
            'total_harga'   => 1000000,
            'keterangan'    => '-',
            'status'    => 'setuju',
            'input_by'      => 'Rado Aditya Sejati',
        ]);

        Purchasing::create([
            'nomor_po'      => 'PO/2024/VII/2',
            'nama_barang'   => 'Toyota Fortuner 2024',
            'qty'           => 1,
            'harga'         => 800000000,
            'supplier'      => 'Toyota Nasmoco',
            'total_harga'   => 800000000,
            'keterangan'    => '-',
            'status'        => 'tolak',
            'input_by'      => 'Rado Aditya Sejati',
        ]);
    }
}
