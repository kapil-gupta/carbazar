<?php

namespace SmartCarBazar\Http\Requests;

use SmartCarBazar\Http\Requests\Request;

class PhotoUploadRequest extends Request {
 /**
     * Force response json type when validation fails
     * @var bool
     */

     protected $forceJsonResponse = true;
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
            'file' => 'required|image:jpeg,png|max:3000',
            'imageable_id' => 'required',
            'imageable_type' => 'required',
            ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() {
        return [
            'file.required' => 'Vehicle photo is required',
            'file.image' => 'Photo should be jpeg/png',
            'file.max' => 'Photo maximum size is 3000 Kb',
            'imageable_id.required' => 'Vehicle is required',
            'imageable_type.required' => 'Vehicle type is required',
        ];
    }

}
