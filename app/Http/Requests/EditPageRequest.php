<?php

namespace SmartCarBazar\Http\Requests;

use SmartCarBazar\Http\Requests\Request;
use Validator;
class EditPageRequest extends Request {

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
        $id = $this->has('id');
        return [
            'name' => 'required|max:255|unique_with:common_attributes,type,slug'.$id,
            'description' => 'required',
            //'parent_id' => 'required',
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
            'name.required' => 'Page Name/Title is required',
            'description.required' => 'Page description is required',
            'parent_id.required' => 'Please select parent page ',
            'is_active.required' => 'Please select page status',
            'meta_title.required' => 'Meta title is required',
            'meta_keywords.required' => 'Meta keywords are required',
            'meta_description.required' => 'Meta description is required',
        ];
    }

}
