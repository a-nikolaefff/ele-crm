<?php

namespace App\Http\Controllers;

use App\Enums\BaseCustomerTypeEnum;
use App\Filters\CustomerFilter;
use App\Http\Requests\Customer\AutocompleteCustomerRequest;
use App\Http\Requests\Customer\IndexCustomerRequest;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\CustomerType;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index(IndexCustomerRequest $request)
    {
        $queryParams = $request->validated();
        $filter = app()->make(
            CustomerFilter::class,
            ['queryParams' => $queryParams]
        );
        $customers = Customer::with('type')
            ->filter($filter)
            ->sort($queryParams)
            ->paginate(6)
            ->withQueryString();
        $types = CustomerType::all();
        return view('customers.index', compact('customers', 'types'));
    }

    /**
     * Show the form for creating a new customer.
     */
    public function create()
    {
        $types = CustomerType::all();
        return view('customers.create', compact('types'));
    }

    /**
     * Store a newly created customer in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $data = $request->validated();
        Customer::create($data);
        return redirect()->route('customers.index');
    }

    /**
     * Display the specified customer.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function edit(Customer $customer)
    {
        $types = CustomerType::all();
        return view('customers.edit', compact('customer', 'types'));
    }

    /**
     * Update the specified customer in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $data = $request->validated();
        $customer->fill($data)->save();
        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index');
    }

    public function autocomplete(Request $request)
    {
        $keyword = $request->input('search');
        $isProjectOrganization = $request->input('is_project_organization');
        $projectOrganizationTypeId = null;

        if ($isProjectOrganization) {
            $projectOrganizationTypeId = CustomerType::getBaseCustomerType(
                BaseCustomerTypeEnum::ProjectOrganization
            )->get()->first()->id;
        }
        $customers = Customer::where(function ($query) use ($keyword) {
            $query->where('name', 'like', "%$keyword%")
                ->orWhere('full_name', 'like', "%$keyword%");
        })
            ->when(
                isset($projectOrganizationTypeId),
                function ($query) use ($projectOrganizationTypeId) {
                    return $query->where('customer_type_id', $projectOrganizationTypeId);
                }
            )
            ->get();
        return response()->json($customers);
    }
}
