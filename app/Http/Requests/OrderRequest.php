<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            //
            'name' => 'required|string',
            'table_id' => 'required|exists:tables,id',
            'menu_id' => 'required|array',
            'menu_id.*' => 'required|exists:menus,id',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
        ];
    }
}
