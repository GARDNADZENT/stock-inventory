<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sale_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.barcode' => ['required', 'exists:products,barcode'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.selling_price' => ['required', 'numeric', 'min:0'],
        ];
    }
}
