<?php

namespace App\Http\Controllers;

use App\Filters\RequestFilter;
use App\Http\Requests\Request\UpdateRequestRequest;
use App\Http\Requests\Request\StoreRequestRequest;
use App\Http\Requests\Request\IndexRequestRequest;
use App\Models\Request;
use App\Models\RequestStatus;
use App\Services\Request\CreateRequestService;
use App\Services\Request\UpdateRequestService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RequestController extends Controller
{
    /**
     * Display a listing of the requests.
     *
     * @param IndexRequestRequest $httpRequest The index request instance.
     *
     * @return View The requests index view.
     */
    public function index(IndexRequestRequest $httpRequest): View
    {
        $queryParams = $httpRequest->validated();
        $filter = app()->make(
            RequestFilter::class,
            ['queryParams' => $queryParams]
        );
        $requests = Request::select('requests.*')
            ->leftjoin(
                'customers as customers',
                'requests.customer_id',
                '=',
                'customers.id'
            )
            ->with(
                'customer',
                'projectOrganization',
                'customerEmployee',
                'projectOrganizationEmployee',
                'status'
            )
            ->filter($filter)
            ->sort($queryParams, 'number', 'desc')
            ->paginate(6)
            ->withQueryString();
        $statuses = RequestStatus::all();
        return view('requests.index', compact('requests', 'statuses'));
    }

    /**
     * Show the form for creating a new request.
     *
     * @return View The create request form view.
     */
    public function create(): View
    {
        return view('requests.create');
    }

    /**
     * Store a newly created request in storage.
     *
     * @param StoreRequestRequest $httpRequest The store request instance.
     * @param CreateRequestService $service    The create request service instance.
     *
     * @return RedirectResponse A redirect response to the requests index.
     */
    public function store(
        StoreRequestRequest $httpRequest,
        CreateRequestService $service
    ): RedirectResponse {
        $validatedData = $httpRequest->validated();
        $processedData = $service->processData($validatedData);
        Request::create($processedData);
        return redirect()->route('requests.index');
    }


    /**
     * Show the form for editing the specified request.
     *
     * @param Request $request The request instance.
     *
     * @return View The edit request form view.
     */
    public function edit(Request $request): View
    {
        $request->load(['customer.employees', 'projectOrganization.employees']);
        $statuses = RequestStatus::all();
        return view('requests.edit', compact('request', 'statuses'));
    }

    /**
     * Update the specified request in storage.
     *
     * @param UpdateRequestRequest $httpRequest The update request instance.
     * @param Request              $request     The request instance.
     * @param UpdateRequestService $service     The update request service instance.
     *
     * @return RedirectResponse A redirect response to the requests index.
     */
    public function update(
        UpdateRequestRequest $httpRequest,
        Request $request,
        UpdateRequestService $service
    ): RedirectResponse {
        $validatedData = $httpRequest->validated();
        $processedData = $service->processData($validatedData);
        $request->fill($processedData)->save();
        return redirect()->route('requests.index');
    }

    /**
     * Remove the specified request from storage.
     *
     * @param Request $request The request instance.
     *
     * @return RedirectResponse A redirect response to the requests index.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->delete();
        return redirect()->route('requests.index');
    }
}
