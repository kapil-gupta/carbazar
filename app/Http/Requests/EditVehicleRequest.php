<?php

namespace SmartCarBazar\Http\Requests;

use SmartCarBazar\Http\Requests\Request;

class EditVehicleRequest extends Request {
    private  $extraMessage; 
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
        $radio_validation_array =[];
        $radio_validation_message_array =[];
        
        $check_validation_array =[];
        $check_validation_message_array =[];
        
        if($this->has('radio_validate_message')){
            $msgs= $this->input('radio_validate_message');
        }
        if($this->has('radio_validate')){
            $i=0;
            foreach($this->input('radio_validate') as $id){
                $radio_validation_array['features_radio_'.$id] = 'required';
                $radio_validation_message_array['features_radio_'.$id.'.required'] = $msgs[$i];
                $i++;
            }
        }
        if($this->has('check_validate_message')){
            $msgs= $this->input('check_validate_message');
        }
        if($this->has('check_validate')){
            $i=0;
            foreach($this->input('check_validate') as $id){
                $check_validation_array['features_checkbox_'.$id] = 'required|array';
                $check_validation_message_array['features_checkbox_'.$id.'.required'] = $msgs[$i];
                $check_validation_message_array['features_checkbox_'.$id.'.array'] = $msgs[$i];
                $i++;
            }
        }
        $this->extraMessage = array_merge($radio_validation_message_array,$check_validation_message_array);
         
        $main_array= [
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
        $main_array =  array_merge($main_array,$radio_validation_array,$check_validation_array);
        return $main_array;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() {
        $msg = [
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
        $msg = array_merge($msg,$this->extraMessage);
        return $msg;
    }

}
