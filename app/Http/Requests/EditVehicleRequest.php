<?php

namespace SmartCarBazar\Http\Requests;

use SmartCarBazar\Http\Requests\Request;

class StoreVehicleRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|max:255',
            'description' => 'required',
            'model_id' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'is_active' => 'required',
            'meta_title' => 'required|max:255',
            'meta_keywords' => 'required|max:255',
            'meta_description' => 'required|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() {
        return [
            'name.required' => 'Vehicle Name/Title is required',
            'description.required' => 'Vehicle description is required',
            'model_id.required' => 'Please select Vehicle brand/model',
            'category_id.required' => 'Please select Vehicle brand/model',
            'price.required' => 'Please select Vehicle brand/model',
            'is_active.required' => 'Please select Vehicle brand/model',
            'meta_title.required' => 'Meta title is required',
            'meta_keywords.required' => 'Meta keywords are required',
            'meta_description.required' => 'Meta description is required',
        ];
    }

}
