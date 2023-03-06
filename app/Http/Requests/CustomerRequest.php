<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cpf' => $this->cpf,
            'birthday' => $this->birthday,
            'phone' => $this->phone,
        ];
    }

    public function with($request)
    {
        return [
            'message' => 'Customer successfully recovered.',
            'status' => 200,
        ];
    }
}