<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        Criteria::insert([
            [
                'code' => 'C1',
                'name' => 'Harga OTR',
                'type' => 'cost',
                'unit' => 'Rp',
                'description' => 'Harga On The Road (rupiah)',
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'C2',
                'name' => 'Kapasitas Mesin',
                'type' => 'benefit',
                'unit' => 'CC',
                'description' => 'Kapasitas mesin dalam CC',
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'C3',
                'name' => 'Konsumsi BBM (L per KM)',
                'type' => 'cost',
                'unit' => 'L/km',
                'description' => 'Konsumsi bahan bakar (litre per kilometer) - cost',
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'C4',
                'name' => 'Pajak Tahunan',
                'type' => 'cost',
                'unit' => 'Rp',
                'description' => 'Biaya pajak tahunan (rupiah)',
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
