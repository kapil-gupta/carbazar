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
$FeatureCategory = $page->getBody()->getDataByKey('FeatureCategory');
?>
@section('bodyContent')	{{-- Page Body Content --}}
<!-- START :: Logo -->
<div class="row">
    <div class="col-md-12">
        <!-- <form class="form-horizontal form-row-seperated" action="javascript:;">-->
        {!! Form::model($Vehicle, array('name'=>'create', 'method'=>'PUT', 'url'=>admin_route('vehicle.update',$Vehicle->id), 'class'=>'form-horizontal form-row-seperated','id'=>'form_sample_3')) !!}
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-basket font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">
                        Edit Product </span>
                </div>
                <div class="actions btn-set">
                    <!-- <button type="button" name="back" class="btn btn-default btn-circle"><i class="fa fa-angle-left"></i> Back</button>
                    <button class="btn btn-default btn-circle "><i class="fa fa-reply"></i> Reset</button>
                    <button class="btn green-haze btn-circle"><i class="fa fa-check"></i> Save</button>-->
                    <button class="btn green-haze btn-circle"><i class="fa fa-check-circle"></i> Save & Continue Edit</button>
                    <!-- <div class="btn-group">
                        <a class="btn yellow btn-circle" href="javascript:;" data-toggle="dropdown">
                            <i class="fa fa-share"></i> More <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:;">
                                    Duplicate </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    Delete </a>
                            </li>
                            <li class="divider">
                            </li>
                            <li>
                                <a href="javascript:;">
                                    Print </a>
                            </li>
                        </ul>
                    </div> -->
                </div>
            </div>
            <div class="portlet-body form">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_general" data-toggle="tab">
                                General </a>
                        </li>
                        <li>
                            <a href="#tab_meta" data-toggle="tab">
                                Meta </a>
                        </li>
                        <li>
                            <a href="#tab_images" data-toggle="tab">
                                Images </a>
                        </li>
                        <li>
                            <a href="#tab_features" data-toggle="tab">
                                Features
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content no-space">
                        <div class="tab-pane active" id="tab_general">
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
                                            <?php
                                            if ($brand->id == Input::old('model_id')) {
                                                echo 'selected';
                                            }
                                            ?>
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


                            </div>
                        </div>
                        <div class="tab-pane" id="tab_meta">
                            <div class="form-body">
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
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_images">
                            <div class="alert alert-success margin-bottom-10">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                <i class="fa fa-warning fa-lg"></i> Image type and information need to be specified.
                            </div>
                            <div id="tab_images_uploader_container" class="text-align-reverse margin-bottom-10">
                                <a id="tab_images_uploader_pickfiles" href="javascript:;" class="btn yellow">
                                    <i class="fa fa-plus"></i> Select Files </a>
                                <a id="tab_images_uploader_uploadfiles" href="javascript:;" class="btn green">
                                    <i class="fa fa-share"></i> Upload Files </a>
                            </div>
                            <div class="row">
                                <div id="tab_images_uploader_filelist" class="col-md-6 col-sm-12">
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="8%">
                                            Image
                                        </th>
                                        <th width="25%">
                                            Label
                                        </th>
                                        <th width="8%">
                                            Sort Order
                                        </th>
                                        <th width="10%">
                                            Base Image
                                        </th>
                                        <th width="10%">
                                            Small Image
                                        </th>
                                        <th width="10%">
                                            Thumbnail
                                        </th>
                                        <th width="10%">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="../../assets/admin/pages/media/works/img1.jpg" class="fancybox-button" data-rel="fancybox-button">
                                                <img class="img-responsive" src="../../assets/admin/pages/media/works/img1.jpg" alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="product[images][1][label]" value="Thumbnail image">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="product[images][1][sort_order]" value="1">
                                        </td>
                                        <td>
                                            <label>
                                                <input type="radio" name="product[images][1][image_type]" value="1">
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="radio" name="product[images][1][image_type]" value="2">
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="radio" name="product[images][1][image_type]" value="3" checked>
                                            </label>
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="btn default btn-sm">
                                                <i class="fa fa-times"></i> Remove </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="../../assets/admin/pages/media/works/img2.jpg" class="fancybox-button" data-rel="fancybox-button">
                                                <img class="img-responsive" src="../../assets/admin/pages/media/works/img2.jpg" alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="product[images][2][label]" value="Product image #1">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="product[images][2][sort_order]" value="1">
                                        </td>
                                        <td>
                                            <label>
                                                <input type="radio" name="product[images][2][image_type]" value="1">
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="radio" name="product[images][2][image_type]" value="2" checked>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="radio" name="product[images][2][image_type]" value="3">
                                            </label>
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="btn default btn-sm">
                                                <i class="fa fa-times"></i> Remove </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="../../assets/admin/pages/media/works/img3.jpg" class="fancybox-button" data-rel="fancybox-button">
                                                <img class="img-responsive" src="../../assets/admin/pages/media/works/img3.jpg" alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="product[images][3][label]" value="Product image #2">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="product[images][3][sort_order]" value="1">
                                        </td>
                                        <td>
                                            <label>
                                                <input type="radio" name="product[images][3][image_type]" value="1" checked>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="radio" name="product[images][3][image_type]" value="2">
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="radio" name="product[images][3][image_type]" value="3">
                                            </label>
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="btn default btn-sm">
                                                <i class="fa fa-times"></i> Remove </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_features">
                            <div class="portlet box">
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <div class="form-body">
                                        @foreach($FeatureCategory  as $category)
                                        <h3 class="form-section">{{$category->name}}</h3>
                                        @if($category->features->count() > 0 )
                                        @foreach($category->features as $feature)
                                        {{$feature->name}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">First Name</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" placeholder="Chee Kin">
                                                        <span class="help-block">
                                                            This is inline help </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group has-error">
                                                    <label class="control-label col-md-3">Last Name</label>
                                                    <div class="col-md-9">
                                                        <select name="foo" class="select2me form-control">
                                                            <option value="1">Abc</option>
                                                            <option value="1">Abc</option>
                                                            <option value="1">This is a really long value that breaks the fluid design for a select2</option>
                                                        </select>
                                                        <span class="help-block">
                                                            This field has error. </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>

                                        @endforeach
                                        @endif
                                        <!--/row-->
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

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