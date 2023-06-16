<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerEmployee\CreateCustomerEmployeeRequest;
use App\Http\Requests\CustomerEmployee\StoreCustomerEmployeeRequest;
use App\Http\Requests\CustomerEmployee\UpdateCustomerEmployeeRequest;
use App\Models\Customer;
use App\Models\CustomerEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateCustomerEmployeeRequest $request)
    {
        $queryParams = $request->validated();
        $customer = Customer::find($queryParams['customer_id']);
        return view('customer-employees.create', compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerEmployeeRequest $request)
    {
        $validatedData = $request->validated();
        $newEmployee = CustomerEmployee::create($validatedData);
        $updatedCustomer = $newEmployee->customer;
        $newEmployee->customer->fill(['updated_by_user_id' => Auth::user()->id])->save();
        return redirect()->route('customers.show', $updatedCustomer->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerEmployee $customerEmployee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerEmployee $customerEmployee)
    {
        return view('customer-employees.edit', compact('customerEmployee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerEmployeeRequest $request, CustomerEmployee $customerEmployee)
    {
        $validatedData = $request->validated();
        $customerEmployee->fill($validatedData)->save();
        $updatedCustomer = $customerEmployee->customer;
        $updatedCustomer->fill(['updated_by_user_id' => Auth::user()->id])->save();
        return redirect()->route('customers.show', $updatedCustomer->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerEmployee $customerEmployee)
    {
        $updatedCustomer = $customerEmployee->customer;
        $customerEmployee->delete();
        $updatedCustomer->fill(['updated_by_user_id' => Auth::user()->id])->save();
        return redirect()->route('customers.show', $updatedCustomer->id);
    }
}
