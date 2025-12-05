<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Weights;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeightsController extends Controller
{
    public function index()
    {
        $criteria = Criteria::with('weight')->orderBy('code')->get();
        return view('admin.weight', compact('criteria'));
    }

    public function update(Request $request)
    {
        $weights = $request->input('weights', []);
        
        // Validate that sum equals exactly 1.00
        $sum = 0;
        foreach ($weights as $weight) {
            $sum += (float) $weight;
        }
        
        if (bccomp((string) $sum, '1.00', 6) !== 0) {
            return back()
                ->with('error', 'Total weights must equal exactly 1.00')
                ->withInput();
        }

        DB::transaction(function () use ($weights) {
            foreach ($weights as $criteriaId => $weight) {
                Weights::updateOrCreate(
                    ['criteria_id' => $criteriaId],
                    [
                        'weight' => $weight,
                        'method' => 'manual',
                        'source' => 'admin_input'
                    ]
                );
            }
        });

        return back()->with('success', 'Weights updated successfully');
    }
}