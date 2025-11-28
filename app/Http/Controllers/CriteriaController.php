<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCriteriaRequest;
use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the last criteria code to generate the next one
        $lastCriteria = Criteria::orderBy('code', 'desc')->first();
        $nextCode = 'C1';
        
        if ($lastCriteria) {
            // Extract the number from the last code (e.g., C3 -> 3)
            $lastNumber = (int) substr($lastCriteria->code, 1);
            $nextNumber = $lastNumber + 1;
            $nextCode = 'C' . $nextNumber;
        }

        return view('admin.criteria.index', [
            'criteria' => Criteria::paginate(10),
            'nextCode' => $nextCode,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCriteriaRequest $request)
    {
        $validated = $request->validated();

        $criteria = Criteria::create($validated);

        return redirect()->route('');

    }

    /**
     * Display the specified resource.
     */
    public function show(Criteria $criteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Criteria $criteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Criteria $criteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Criteria $criteria)
    {
        //
    }
}
