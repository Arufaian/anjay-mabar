<?php

namespace Database\Seeders;

use App\Models\Alternative;
use App\Models\AlternativeValue;
use App\Models\Criteria;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AlternativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $now = Carbon::now();

        // 1. Insert alternatives
        $alternatives = [
            [
                'code' => 'ALT-001',
                'name' => 'Yamaha Mio M3',
                'model' => 'Mio M3',
                'year' => 2024,
                'notes' => 'Contoh data dummy',
            ],
            [
                'code' => 'ALT-002',
                'name' => 'Yamaha Fazzio',
                'model' => 'Fazzio',
                'year' => 2024,
                'notes' => 'Contoh data dummy',
            ],
            [
                'code' => 'ALT-003',
                'name' => 'Yamaha NMax',
                'model' => 'NMax 155',
                'year' => 2024,
                'notes' => 'Contoh data dummy',
            ],
        ];

        foreach ($alternatives as $alt) {
            Alternative::updateOrCreate(
                ['code' => $alt['code']],
                $alt + ['created_at' => $now, 'updated_at' => $now]
            );
        }

        // 2. Ambil criteria (kode → id)
        $criteriaMap = Criteria::pluck('id', 'code');
        // hasil: ['C1' => 1, 'C2' => 2, ...]

        // 3. Masukkan nilai alternative_values
        $values = [
            // ALT-001
            ['alt_code' => 'ALT-001', 'criteria_code' => 'C1', 'value' => 14900000],
            ['alt_code' => 'ALT-001', 'criteria_code' => 'C2', 'value' => 125],
            ['alt_code' => 'ALT-001', 'criteria_code' => 'C3', 'value' => 0.045],
            ['alt_code' => 'ALT-001', 'criteria_code' => 'C4', 'value' => 200000],

            // ALT-002
            ['alt_code' => 'ALT-002', 'criteria_code' => 'C1', 'value' => 16700000],
            ['alt_code' => 'ALT-002', 'criteria_code' => 'C2', 'value' => 125],
            ['alt_code' => 'ALT-002', 'criteria_code' => 'C3', 'value' => 0.047],
            ['alt_code' => 'ALT-002', 'criteria_code' => 'C4', 'value' => 220000],

            // ALT-003
            ['alt_code' => 'ALT-003', 'criteria_code' => 'C1', 'value' => 29500000],
            ['alt_code' => 'ALT-003', 'criteria_code' => 'C2', 'value' => 155],
            ['alt_code' => 'ALT-003', 'criteria_code' => 'C3', 'value' => 0.055],
            ['alt_code' => 'ALT-003', 'criteria_code' => 'C4', 'value' => 300000],
        ];

        foreach ($values as $v) {
            $alternativeId = Alternative::where('code', $v['alt_code'])->value('id');
            $criteriaId = $criteriaMap[$v['criteria_code']] ?? null;

            if (! $alternativeId || ! $criteriaId) {
                continue;
            }

            AlternativeValue::updateOrCreate(
                [
                    'alternative_id' => $alternativeId,
                    'criteria_id' => $criteriaId,
                ],
                [
                    'value' => $v['value'],
                    'notes' => 'seeded',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
