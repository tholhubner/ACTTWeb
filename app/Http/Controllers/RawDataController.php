<?php

namespace App\Http\Controllers;

use App\Models\RawData;
use Illuminate\Http\Request;
use Illuminuate\Http\Requests\RawDataRequest;

class RawDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rawData = RawData::all();
        return response()->json([
            'rawData' => $rawData
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
    public function store(RawDataRequest $request)
    {
        $request->validate([
            'intake_data' => 'required|json'
        ]);

        $rawData = RawData::create($request->all());

        return response()->json([
            'message' => "success",
            'data' => $rawData
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(RawData $rawData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RawData $rawData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RawData $rawData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RawData $rawData)
    {
        //
    }
}
