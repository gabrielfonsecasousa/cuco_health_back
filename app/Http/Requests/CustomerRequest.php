<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $id = $this->route('customer');
        $nameRules = ['required', 'string', 'max:255'];
        $cpfRules = ['required', '', 'string', 'max:14'];
        $birthdayRules = ['required', 'date'];
        $phoneRules = ['required', 'string', 'max:20'];
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => $nameRules,
                    'cpf' => array_merge($cpfRules, ['unique:customers']),
                    'birthday' => $birthdayRules,
                    'phone' => $phoneRules,
                ];
            case 'PUT':
                return [
                    'name' => $nameRules,
                    'cpf' => array_merge($cpfRules, ['unique:customers,cpf,' . $id]),
                    'birthday' => $birthdayRules,
                    'phone' => $phoneRules,
                ];
            default:
                throw new \InvalidArgumentException("HTTP method not supported");
        }
    }
}