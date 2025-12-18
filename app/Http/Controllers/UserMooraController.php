<?php

namespace App\Http\Controllers;

use App\Service\MooraService;
use App\Models\Criteria;
use Illuminate\Http\Request;

class UserMooraController extends Controller
{
    public function __construct(
        private MooraService $mooraService
    ) {}

    /**
     * Tampilkan form budget input
     */
    public function create()
    {
        // Ambil range harga dari database
        $priceRange = $this->getPriceRange();
        
        return view('user.moora.budget', [
            'minBudget' => $priceRange['min'],
            'maxBudget' => $priceRange['max'],
        ]);
    }

    /**
     * Proses perhitungan MOORA dengan budget filter
     */
    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'budget_min' => 'required|numeric|min:0',
            'budget_max' => 'required|numeric|gte:budget_min',
        ]);

        // Validasi budget range
        $priceRange = $this->getPriceRange();
        if ($validated['budget_min'] < $priceRange['min'] || 
            $validated['budget_max'] > $priceRange['max']) {
            return back()->withErrors([
                'budget' => "Budget harus antara Rp " . number_format($priceRange['min'], 0, ',', '.') . 
                          " dan Rp " . number_format($priceRange['max'], 0, ',', '.')
            ]);
        }

        // Lakukan perhitungan MOORA dengan budget filter
        $calculationResults = $this->mooraService->calculateForUser(
            $validated['budget_min'], 
            $validated['budget_max']
        );

        return view('user.moora.results', [
            'budget' => $validated,
            'results' => $calculationResults,
        ]);
    }

    /**
     * Ambil range harga dari data alternatif
     */
    private function getPriceRange(): array
    {
        $priceCriteria = Criteria::where('code', 'C1')->first();
        
        $minPrice = \App\Models\AlternativeValue::where('criteria_id', $priceCriteria->id)
            ->min('value');
        $maxPrice = \App\Models\AlternativeValue::where('criteria_id', $priceCriteria->id)
            ->max('value');

        return [
            'min' => (int) $minPrice,
            'max' => (int) $maxPrice,
        ];
    }
}