<?php

namespace App\Http\Requests\Rooms\Room;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string',
            'category_id' => 'required',
            'building_id' => 'required',
            'floor_id' => 'required',
            'price' => 'required',
            'intercom_mobile' => 'required|max:11',
            'status' => 'required',
        ];
    }
}