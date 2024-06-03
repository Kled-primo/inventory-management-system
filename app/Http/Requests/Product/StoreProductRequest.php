<?php

namespace App\Http\Requests\Product;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'              => 'required',
            'category_id'       => 'required|integer',
            'unit_id'           => 'required|integer',
            'producttype'       => 'required|integer',
            'quantity'          => 'required|integer',
            'unit_number'      => 'required',
            'selling_price'     => 'required',
            'user_id'           => 'required|integer',
            'quantity_alert'    => 'required|integer',
            'manufacturing_date' => 'required',
            'expiry_date'       => 'required',
            'notes'             => 'nullable|max:1000'
        ];
    }

    // protected function prepareForValidation(): void
    // {
    //     $this->merge([
    //         'slug' => Str::slug($this->name, '-'),
    //         'code' =>
    //     ]);
    // }
}
