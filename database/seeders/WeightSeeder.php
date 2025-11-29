<?php

namespace Database\Seeders;

use App\Models\Criteria;
use App\Models\Weights;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WeightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = Carbon::now();

        // contoh bobot sementara (jumlah sekitar 1.0)
        // disesuaikan dengan tujuan "termurah": Harga dominan
        $weights = [
            ['criteria_code' => 'C1', 'weight' => 0.50, 'method' => 'dummy'], // Harga
            ['criteria_code' => 'C2', 'weight' => 0.15, 'method' => 'dummy'], // CC
            ['criteria_code' => 'C3', 'weight' => 0.25, 'method' => 'dummy'], // konsumsi
            ['criteria_code' => 'C4', 'weight' => 0.10, 'method' => 'dummy'], // pajak
        ];

        foreach ($weights as $w) {
            $crit = Criteria::where('code', $w['criteria_code'])->first();
            if ($crit) {
                Weights::updateOrInsert(
                    ['criteria_id' => $crit->id],
                    [
                        'weight' => $w['weight'],
                        'method' => $w['method'],
                        'source' => 'seed_dummy',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }
    }
}
