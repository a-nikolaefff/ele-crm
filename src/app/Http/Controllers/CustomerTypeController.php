<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerType\IndexCustomerTypeRequest;
use App\Http\Requests\CustomerType\StoreCustomerTypeRequest;
use App\Http\Requests\CustomerType\UpdateCustomerTypeRequest;
use App\Models\CustomerType;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerTypeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(CustomerType::class);
    }

    /**
     * Display a listing of the customer types.
     */
    public function index(IndexCustomerTypeRequest $request)
    {
        $queryParams = $request->validated();
        $customerTypes = CustomerType::sort($queryParams)->paginate(6);
        return view('customer-types.index', compact('customerTypes'));
    }

    /**
     * Show the form for creating a new customer type.
     */
    public function create()
    {
        return view('customer-types.create');
    }

    /**
     * Store a newly created customer type in storage.
     */
    public function store(StoreCustomerTypeRequest $request)
    {
        $data = $request->validated();
        CustomerType::create($data);
        return redirect()->route('customer-types.index');
    }

    /**
     * Display the specified customer type.
     */
    public function show(CustomerType $customerGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified customer type.
     */
    public function edit(CustomerType $customerType)
    {
        return view('customer-types.edit', compact('customerType'));
    }

    /**
     * Update the specified customer type in storage.
     */
    public function update(UpdateCustomerTypeRequest $request, CustomerType $customerType)
    {
        $data = $request->validated();
        $this->authorize('update', [$customerType]);
        $customerType->fill($data)->save();
        return redirect()->route('customer-types.index');
    }

    /**
     * Remove the specified customer type from storage.
     */
    public function destroy(CustomerType $customerType)
    {
        $customerType->delete();
        return redirect()->route('customer-types.index');
    }
}
