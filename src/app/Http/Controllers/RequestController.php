<?php

namespace App\Http\Controllers;

use App\Filters\RequestFilter;
use App\Http\Requests\Request\UpdateRequestRequest;
use App\Http\Requests\Request\StoreRequestRequest;
use App\Http\Requests\Request\IndexRequestRequest;
use App\Models\Request;
use App\Models\RequestStatus;
use App\Services\RequestService;

class RequestController extends Controller
{
    /**
     * Display a listing of the requests.
     */
    public function index(IndexRequestRequest $httpRequest)
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
            ->with('customer', 'projectOrganization', 'status')
            ->filter($filter)
            ->sort($queryParams, 'number', 'desc')
            ->paginate(6)
            ->withQueryString();
        $statuses = RequestStatus::all();
        return view('requests.index', compact('requests', 'statuses'));
    }

    /**
     * Show the form for creating a new request.
     */
    public function create()
    {
        return view('requests.create');
    }

    /**
     * Store a newly created request in storage.
     */
    public function store(
        StoreRequestRequest $httpRequest,
        RequestService $requestService
    ) {
        $data = $httpRequest->validated();
        $requestService->setRequestData($data);
        Request::create($requestService->getRequestData());
        return redirect()->route('requests.index');
    }

    /**
     * Display the specified request.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified request.
     */
    public function edit(Request $request)
    {
        $request->load(['customer', 'projectOrganization']);
        $statuses = RequestStatus::all();
        return view('requests.edit', compact('request', 'statuses'));
    }

    /**
     * Update the specified request in storage.
     */
    public function update(
        UpdateRequestRequest $httpRequest,
        Request $request,
        RequestService $requestService
    ) {
        $data = $httpRequest->validated();
        $requestService->setRequestData($data, false);
        $request->fill($requestService->getRequestData())->save();
        return redirect()->route('requests.index');
    }

    /**
     * Remove the specified request from storage.
     */
    public function destroy(Request $request)
    {
        $request->delete();
        return redirect()->route('requests.index');
    }
}
