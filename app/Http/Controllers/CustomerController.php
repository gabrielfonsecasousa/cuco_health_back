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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = $this->model->findOrFail($id);
        return new CustomerResource($customer);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, string $id)
    {
        if (count($this->model->where('id', '', $id)->get()) == 0) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        $customer = $this->model->findOrFail($id);
        $customer->update($request->validated());
        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (count($this->model->where('id', '', $id)->get()) == 0) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        $customer = $this->model->findOrFail($id);
        $this->model->destroy($id);
        return new CustomerResource($customer);
    }

}