<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishRequest extends FormRequest
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
            'type_id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'type_id.required' => 'Bạn phải chọn loại món ăn',
            'name.required' => 'Bạn phải nhập tên món ăn',
            'price.required' => 'Bạn phải nhập giá',
            'description.required' => 'Bạn phải nhập mô tả',
        ];
    }
}
