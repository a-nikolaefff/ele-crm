<?php

namespace App\Http\Controllers;

use App\Enums\BaseCustomerTypeEnum;
use App\Filters\CustomerFilter;
use App\Http\Requests\Customer\IndexCustomerRequest;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\CustomerType;
use App\Services\Customer\CreateCustomerService;
use App\Services\Customer\UpdateCustomerService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     *
     * @param IndexCustomerRequest $request The request object.
     *
     * @return View The view with customers and types data.
     * @throws BindingResolutionException
     */
    public function index(IndexCustomerRequest $request): View
    {
        $queryParams = $request->validated();
        $filter = app()->make(
            CustomerFilter::class,
            ['queryParams' => $queryParams]
        );
        $customers = Customer::with('type', 'createdByUser', 'updatedByUser')
            ->filter($filter)
            ->sort($queryParams)
            ->paginate(6)
            ->withQueryString();
        $types = CustomerType::all();
        return view('customers.index', compact('customers', 'types'));
    }

    /**
     * Show the form for creating a new customer.
     *
     * @return View The create customer view with customer types data.
     */
    public function create(): View
    {
        $types = CustomerType::all();
        return view('customers.create', compact('types'));
    }

    /**
     * Store a newly created customer in storage.
     *
     * @param StoreCustomerRequest $request  The request object.
     * @param CreateCustomerService $service The service for creating a customer.
     *
     * @return RedirectResponse The redirect response.
     */
    public function store(
        StoreCustomerRequest $request,
        CreateCustomerService $service
    ): RedirectResponse {
        $validatedData = $request->validated();
        $processedData = $service->processData($validatedData);
        Customer::create($processedData);
        return redirect()->route('customers.index');
    }

    /**
     * Show the form for editing the specified customer.
     *
     * @param Customer $customer The customer model instance.
     *
     * @return View The edit customer view with customer and customer types data.
     */
    public function edit(Customer $customer): View
    {
        $types = CustomerType::all();
        return view('customers.edit', compact('customer', 'types'));
    }

    /**
     * Update the specified customer in storage.
     *
     * @param UpdateCustomerRequest $request The request object.
     * @param Customer $customer The customer model instance.
     * @param UpdateCustomerService $service The service for updating a customer.
     * @return RedirectResponse The redirect response.
     */
    public function update(
        UpdateCustomerRequest $request,
        Customer $customer,
        UpdateCustomerService $service
    ): RedirectResponse {
        $validatedData = $request->validated();
        $processedData = $service->processData($validatedData);
        $customer->fill($processedData)->save();
        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified customer from storage.
     *
     * @param Customer $customer The customer model instance.
     * @return RedirectResponse The redirect response.
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();
        return redirect()->route('customers.index');
    }

    /**
     * Returns the result of a search for customers in JSON format.
     *
     * @param Request $request The request object.
     * @return JsonResponse The JSON response with customer data.
     */
    public function autocomplete(Request $request): JsonResponse
    {
        $keyword = $request->input('search');

        $isProjectOrganizationRequest = $request->input('is_project_organization');

        $customers = Customer::where(function ($query) use ($keyword) {
            $query->where('name', 'like', "%$keyword%")
                ->orWhere('full_name', 'like', "%$keyword%");
        })
            ->when(
                $isProjectOrganizationRequest,
                function ($query) {
                    return $query->where('has_project_department', true);
                }
            )
            ->get();

        return response()->json($customers);
    }
}
