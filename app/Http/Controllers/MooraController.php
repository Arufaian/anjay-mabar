<?php

namespace App\Http\Controllers;

use App\Service\MooraService;
use Illuminate\Http\Request;

class MooraController extends Controller
{
    public function __construct(
        private MooraService $mooraService
    ) {}

    /**
     * Display MOORA calculation results page.
     */
    public function index()
    {
        $validation = $this->mooraService->validateWeights();
        $calculationSummary = $this->mooraService->getCalculationSummary();

        return view('admin.moora.index', [
            'validation' => $validation,
            'calculationSummary' => $calculationSummary,
        ]);
    }

    /**
     * Recalculate MOORA results.
     */
    public function calculate(Request $request)
    {
        $validation = $this->mooraService->validateWeights();
        
        if (!$validation['valid']) {
            return redirect()->route('admin.moora.index')
                ->with('error', 'Cannot calculate: ' . implode(', ', $validation['issues']));
        }

        $calculationSummary = $this->mooraService->getCalculationSummary();

        if (!$calculationSummary['success']) {
            return redirect()->route('admin.moora.index')
                ->with('error', $calculationSummary['error']);
        }

        return redirect()->route('admin.moora.index')
            ->with('success', 'MOORA calculation completed successfully.');
    }
}
