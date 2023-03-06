<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Repositories\Eloquent\CustomerRepository;
use Request;

class CustomerController extends Controller
{
    protected $model;
    public function __construct(CustomerRepository $model)
    {
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = Request::all();
        $customers = $this->model->query();
        if (isset($request['cpf'])) {
            $customers = $customers->where('cpf', 'like', '%' . $request['cpf'] . '%');
        }
        if (isset($request['name'])) {
            $customers = $customers->where('name', 'like', '%' . $request['name'] . '%');
        }
        $customers = $customers->get();
        return CustomerResource::collection($customers);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $customer = $this->model->create($request->validated());
        return new CustomerResource($customer);
    }
}