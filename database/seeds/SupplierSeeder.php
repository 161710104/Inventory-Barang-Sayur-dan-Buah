<?php

use Illuminate\Database\Seeder;
Use App\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =  [
      [
        'nama' => 'Toko Sayuran MM ( Mamah Bunga ) ',
        'alamat' => 'Jalan Batununggal Indah II N8. 48, Pasar Modern Batununggal Blok LC 20 - 23, Mengger, Bandung Kidul, Kota Bandung, Jawa Barat 40266',
        'no_telepon' => '082127576064',
      ],

      [
        'nama' => 'UD Memed',
        'alamat' => 'Ps. Cicadas II, Jl. Cikutra No.81, RW.04, Cikutra, Cibeunying Kidul, Bandung, Jawa Barat 40124',
        'no_telepon' => '0895329599352',
      ],

      [
        'nama' => 'UD. Amir',
        'alamat' => 'Ps. Cicadas II, Jl. Cikutra No.13, RW.04, Cikutra, Cibeunying Kidul, Bandung, Jawa Barat 40124',
        'no_telepon' => '0823-1897-0652',
      ],

      ];

      Supplier::insert($data);
    }
}
