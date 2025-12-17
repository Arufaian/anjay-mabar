<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlternativeValueRequest;
use App\Http\Requests\UpdateAlternativeValueRequest;
use App\Models\AlternativeValue;

class AlternativeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alternativeValues = AlternativeValue::with(['alternative', 'criteria'])
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('value', 'like', "%{$search}%")
                        ->orWhere('notes', 'like', "%{$search}%")
                        ->orWhereHas('alternative', function ($subQuery) use ($search) {
                            $subQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('code', 'like', "%{$search}%");
                        })
                        ->orWhereHas('criteria', function ($subQuery) use ($search) {
                            $subQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('code', 'like', "%{$search}%");
                        });
                });
            })
            ->when(request('alternative_id'), function ($query, $alternativeId) {
                $query->where('alternative_id', $alternativeId);
            })
            ->when(request('criteria_id'), function ($query, $criteriaId) {
                $query->where('criteria_id', $criteriaId);
            })
            ->orderBy('alternative_id')
            ->orderBy('criteria_id')
            ->paginate(20);

        $alternatives = \App\Models\Alternative::orderBy('code')->get();
        $criteria = \App\Models\Criteria::orderBy('code')->get();

        return view('admin.alternative-value.index', [
            'alternativeValues' => $alternativeValues,
            'alternatives' => $alternatives,
            'criteria' => $criteria,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alternatives = \App\Models\Alternative::orderBy('code')->get();
        $criteria = \App\Models\Criteria::orderBy('code')->get();

        return view('admin.alternative-value.create', [
            'alternatives' => $alternatives,
            'criteria' => $criteria,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlternativeValueRequest $request)
    {
        $validated = $request->validated();

        AlternativeValue::create($validated);

        return redirect()
            ->route('admin.alternative-value.index')
            ->with('success', 'Alternative value created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AlternativeValue $alternativeValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AlternativeValue $alternativeValue)
    {
        $alternatives = \App\Models\Alternative::orderBy('code')->get();
        $criteria = \App\Models\Criteria::orderBy('code')->get();

        return view('admin.alternative-value.edit', [
            'alternativeValue' => $alternativeValue,
            'alternatives' => $alternatives,
            'criteria' => $criteria,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlternativeValueRequest $request, AlternativeValue $alternativeValue)
    {
        $validated = $request->validated();

        $alternativeValue->update($validated);

        return redirect()
            ->route('admin.alternative-value.index')
            ->with('success', 'Alternative value updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AlternativeValue $alternativeValue)
    {
        $alternativeValue->delete();

        return redirect()
            ->route('admin.alternative-value.index')
            ->with('success', 'Alternative value deleted successfully.');
    }
}
