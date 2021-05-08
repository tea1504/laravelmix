<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'staff_id' => 'required',
            'table_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'staff_id.required' => 'Bạn phải chọn nhân viên',
            'table_id.required' => 'Bạn phải chọn bàn',
        ];
    }
}
