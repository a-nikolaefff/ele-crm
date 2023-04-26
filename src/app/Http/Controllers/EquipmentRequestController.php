<?php

namespace App\Http\Controllers;

use App\Models\EquipmentRequest;
use Illuminate\Http\Request;

class EquipmentRequestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'authorized']);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'test';
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
    public function show(EquipmentRequest $equipmentRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EquipmentRequest $equipmentRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EquipmentRequest $equipmentRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EquipmentRequest $equipmentRequest)
    {
        //
    }
}
