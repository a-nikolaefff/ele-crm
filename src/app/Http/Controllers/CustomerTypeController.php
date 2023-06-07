<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerType\IndexCustomerTypeRequest;
use App\Http\Requests\CustomerType\StoreCustomerTypeRequest;
use App\Http\Requests\CustomerType\UpdateCustomerTypeRequest;
use App\Models\CustomerType;
use App\Services\CustomerType\CustomerTypeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CustomerTypeController extends Controller
{
    /**
     * Create a new CustomerTypeController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(CustomerType::class);
    }

    /**
     * Display a listing of the customer types.
     *
     * @param IndexCustomerTypeRequest $request The request object.
     *
     * @return View The view with customer types data.
     */
    public function index(IndexCustomerTypeRequest $request): View
    {
        $queryParams = $request->validated();
        $customerTypes = CustomerType::sort($queryParams)->paginate(6);
        return view('customer-types.index', compact('customerTypes'));
    }

    /**
     * Show the form for creating a new customer type.
     *
     * @return View The create customer type view.
     */
    public function create(): View
    {
        return view('customer-types.create');
    }

    /**
     * Store a newly created customer type in storage.
     *
     * @param StoreCustomerTypeRequest $request The request object.
     * @param CustomerTypeService      $service The service for creating a customer type.
     *
     * @return RedirectResponse The redirect response.
     */
    public function store(
        StoreCustomerTypeRequest $request,
        CustomerTypeService $service
    ): RedirectResponse {
        $validatedData = $request->validated();
        $processedData = $service->processData($validatedData);
        CustomerType::create($processedData);
        return redirect()->route('customer-types.index');
    }

    /**
     * Show the form for editing the specified customer type.
     *
     * @param CustomerType $customerType The customer type model instance.
     *
     * @return View The edit customer type view with customer type data.
     */
    public function edit(CustomerType $customerType): View
    {
        return view('customer-types.edit', compact('customerType'));
    }

    /**
     * Update the specified customer type in storage.
     *
     * @param UpdateCustomerTypeRequest $request      The request object.
     * @param CustomerType              $customerType The customer type model instance.
     *
     * @return RedirectResponse The redirect response.
     */
    public function update(
        UpdateCustomerTypeRequest $request,
        CustomerType $customerType
    ): RedirectResponse {
        $validatedData = $request->validated();
        $this->authorize('update', [$customerType]);
        $customerType->fill($validatedData)->save();
        return redirect()->route('customer-types.index');
    }

    /**
     * Remove the specified customer type from storage.
     *
     * @param CustomerType $customerType The customer type model instance.
     *
     * @return RedirectResponse The redirect response.
     */
    public function destroy(CustomerType $customerType): RedirectResponse
    {
        $customerType->delete();
        return redirect()->route('customer-types.index');
    }
}
