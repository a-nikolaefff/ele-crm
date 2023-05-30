<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerGroup\IndexCustomerTypeRequest;
use App\Http\Requests\CustomerGroup\StoreCustomerTypeRequest;
use App\Http\Requests\CustomerGroup\UpdateCustomerTypeRequest;
use App\Models\CustomerType;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        $this->authorizeResource(CustomerType::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexCustomerTypeRequest $request)
    {
        $queryParams = $request->validated();
        $customerTypes = CustomerType::sort($queryParams)->paginate(6);
        return view('customer-types.index', compact('customerTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerTypeRequest $request)
    {
        $data = $request->validated();
        CustomerType::create($data);
        return redirect()->route('customer-types.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerType $customerGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerType $customerType)
    {
        return view('customer-types.edit', compact('customerType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerTypeRequest $request, CustomerType $customerType)
    {
        $data = $request->validated();
        $this->authorize('update', [$customerType]);
        $customerType->fill($data)->save();
        return redirect()->route('customer-types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerType $customerType)
    {
        $customerType->delete();
        return redirect()->route('customer-types.index');
    }
}
