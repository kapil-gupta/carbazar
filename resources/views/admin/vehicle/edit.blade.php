@extends('admin.layouts.onecolom')


@section('pageHeadSpecificCSS')	{{-- Page Head Specific CSS Files --}}
{!! Html::style('admin/global/plugins/select2/select2.css') !!}
@stop

@section('pageHeadSpecificJS')	{{-- Page Head Specific JS Files --}}
@stop
<?php
$AllBrands = $page->getBody()->getDataByKey('Brands');
$AllCategories = $page->getBody()->getDataByKey('Categories');
$Vehicle = $page->getBody()->getDataByKey('Vehicle');

?>
@section('bodyContent')	{{-- Page Body Content --}}
<!-- START :: Logo -->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-basket font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">
                        Add Vehicle </span>
                    <!--<span class="caption-helper">Man Tops</span>-->
                </div>
            </div>
            <div class="portlet-body">
                {!! Form::model($Vehicle, array('name'=>'create', 'method'=>'PUT', 'url'=>'admin/vehicle/'.$Vehicle->id, 'class'=>'form-horizontal form-row-seperated','id'=>'form_sample_3')) !!}
                                <div class="form-body">
                    <div class="form-group {{($errors->has('category_id')) ? "has-error" : ""}}">
                        <label class="col-md-2 control-label">Select Category: <span class="required">
                                * </span>
                        </label>
                        <div class="col-md-10">
                            {!!  Form::select('category_id',$AllCategories , Input::old('category_id'), ['id'=>'category_id','placeholder' => 'Select a Category','class'=>'form-control input-xlarge select2me']) !!}
                            @if ($errors->has('category_id'))
                            <span id="name-error" class="help-block help-block-error">{{$errors->first('category_id')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{($errors->has('name')) ? "has-error" : ""}}">
                        <label class="col-md-2 control-label">Name: 
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-10">
                            {!! Form::text('name', Input::old('name'), array('id'=>'name','class'=>'form-control','placeholder'=>'Vehicle name')) !!}
                            @if ($errors->has('name'))
                            <span id="name-error" class="help-block help-block-error">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{($errors->has('description')) ? "has-error" : ""}}">
                        <label class="col-md-2 control-label">Description: <span class="required">
                                * </span>
                        </label>
                        <div class="col-md-10">
                            {!! Form::textarea('description', Input::old('description'), array('id'=>'decription','class'=>'form-control','placeholder'=>'Vehicle Description','rows'=>6,'data-error-container'=>'editor2_error')) !!}
                            <div id="editor2_error"></div>
                            @if ($errors->has('description'))
                            <span id="name-error" class="help-block help-block-error">{{$errors->first('description')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{($errors->has('model_id')) ? "has-error" : ""}}">
                        <label class="col-md-2 control-label">Select Model: <span class="required">
                                * </span>
                        </label>
                        <div class="col-md-10">
                            <select class="form-control input-xlarge select2me" name="model_id" id="model_id" data-placeholder="Select...">
                                <option value=""></option>
                                @foreach($AllBrands as $brand)
                                <option value="{{$brand->id}}"
                                        <?php if($brand->id==Input::old('model_id')){echo 'selected';} ?>
                                        >{{$brand->brand->name." ".$brand->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('model_id'))
                            <span id="name-error" class="help-block help-block-error">{{$errors->first('model_id')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{($errors->has('price')) ? "has-error" : ""}}">
                        <label class="col-md-2 control-label">Price: <span class="required">
                                * </span>
                        </label>
                        <div class="col-md-2">
                            {!! Form::text('price', Input::old('price'),['id'=>'price','class'=>'form-control','placeholder'=>'Price']) !!}
                            @if ($errors->has('price'))
                            <span id="name-error" class="help-block help-block-error">{{$errors->first('price')}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{($errors->has('is_active')) ? "has-error" : ""}}">
                        <label class="col-md-2 control-label">Status: <span class="required">
                                * </span>
                        </label>
                        <div class="col-md-10">
                            {!!  Form::select('is_active',['0'=>'Not Active','1'=>'Active'] , Input::old('is_active'), ['id'=>'is_active','placeholder' => 'Select Status','class'=>'table-group-action-input form-control input-medium']) !!}
                            @if ($errors->has('is_active'))
                            <span id="name-error" class="help-block help-block-error">{{$errors->first('is_active')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{($errors->has('meta_title')) ? "has-error" : ""}}">
                        <label class="col-md-2 control-label">Meta Title:</label>
                        <div class="col-md-10">
                            {!! Form::text('meta_title', Input::old('meta_title'), array('id'=>'meta_title','class'=>'form-control','placeholder'=>'Meta Title','maxlength'=>100)) !!}
                            <span class="help-block"> max 100 chars </span>
                            @if ($errors->has('meta_title'))
                            <span id="name-error" class="help-block help-block-error">{{$errors->first('meta_title')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{($errors->has('meta_keywords')) ? "has-error" : ""}}">
                        <label class="col-md-2 control-label">Meta Keywords:</label>
                        <div class="col-md-10">
                            {!! Form::textarea('meta_keywords', Input::old('meta_keywords'), array('id'=>'meta_keywords','class'=>'form-control maxlength-handler','placeholder'=>'Meta Keywords','rows'=>8,'maxlength'=>255)) !!}
                            <span class="help-block"> max 1000 chars </span>
                            @if ($errors->has('meta_keywords'))
                            <span id="name-error" class="help-block help-block-error">{{$errors->first('meta_keywords')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{($errors->has('meta_description')) ? "has-error" : ""}}">
                        <label class="col-md-2 control-label">Meta Description:</label>
                        <div class="col-md-10">
                            {!! Form::textarea('meta_description', Input::old('meta_description'), array('id'=>'meta_description','class'=>'form-control maxlength-handler','placeholder'=>'Meta Description','rows'=>8,'maxlength'=>255)) !!}
                            <span class="help-block">max 255 chars </span>
                            @if ($errors->has('meta_description'))
                            <span id="name-error" class="help-block help-block-error">{{$errors->first('meta_description')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">Submit</button>
                                <button type="button" class="btn default">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
</div>
@stop

@section('pageFooterSpecificPlugin')	{{-- Page Footer Specific Plugin Files --}}
<!-- BEGIN PAGE LEVEL PLUGINS -->
{!! Html::script('admin/global/plugins/jquery-validation/js/jquery.validate.min.js') !!}
{!! Html::script('admin/global/plugins/jquery-validation/js/additional-methods.min.js') !!}
{!! Html::script('admin/global/plugins/select2/select2.min.js') !!}
{!! Html::script('admin/global/plugins/ckeditor/ckeditor.js') !!}
{!! Html::script('admin/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') !!}
<!-- END PAGE LEVEL PLUGINS -->
@stop

@section('pageFooterSpecificJS')
{!! Html::script('admin/custom/vehicle/create-form-validation.js') !!}
{!! Html::script('admin/custom/vehicle/create.js') !!}
@stop

@section('pageFooterScriptInitialize')	{{-- Page Footer Script Initialization Code --}}
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        //FormValidation.init();
        VehicleAdd.init();
    });
</script>
@stop