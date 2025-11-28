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

        return view('admin.criteria.index', [
            'criteria' => Criteria::paginate(10),
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

        return redirect()->route('admin.criteria.index')
            ->with('success', "Criteria {$criteria->name} created successfully.");

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
        Criteria::destroy($criteria->id);

        return redirect()->route('admin.criteria.index')
            ->with('success', "Criteria {$criteria->name} deleted successfully.");
    }
}
