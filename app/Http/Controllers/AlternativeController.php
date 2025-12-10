<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alternatives = Alternative::with(['alternativeValues.criteria'])
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('code', 'like', "%{$search}%")
                      ->orWhere('model', 'like', "%{$search}%");
                });
            })
            ->when(request('type'), function ($query, $type) {
                $query->where('type', $type);
            })
            ->when(request('year'), function ($query, $year) {
                $query->where('year', $year);
            })
            ->orderBy('code')
            ->paginate(10);

        $types = Alternative::distinct()->pluck('type')->filter();
        $years = Alternative::distinct()->pluck('year')->filter()->sortDesc();

        return view('admin.alternative.index', [
            'alternatives' => $alternatives,
            'types' => $types,
            'years' => $years,
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Alternative $alternative)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alternative $alternative)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alternative $alternative)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alternative $alternative)
    {
        //
    }
}
