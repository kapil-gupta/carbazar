@extends('admin.layouts.onecolom')


@section('pageHeadSpecificCSS')	{{-- Page Head Specific CSS Files --}}
{!! Html::style('admin/global/plugins/select2/select2.css') !!}
{!! Html::style('admin/global/plugins/dropzone/css/dropzone.css') !!}
@stop

@section('pageHeadSpecificJS')	{{-- Page Head Specific JS Files --}}
@stop
<?php
$BrandList = $page->getBody()->getDataByKey('Brands');
$AllCategories = $page->getBody()->getDataByKey('Categories');
$Vehicle = $page->getBody()->getDataByKey('Vehicle');
$FeatureCategory = $page->getBody()->getDataByKey('FeatureCategory');
$VehicleFeatures = $page->getBody()->getDataByKey('vehicleFeatures');
$tab = $page->getBody()->getDataByKey('tab');
?>
@section('bodyContent')	{{-- Page Body Content --}}
<!-- START :: Logo -->
<div class="row">
    <div class="col-md-12">
        <!-- <form class="form-horizontal form-row-seperated" action="javascript:;">-->
        {!! Form::model($Vehicle, array('name'=>'create', 'method'=>'PUT', 'url'=>admin_route('vehicle.update',$Vehicle->id), 'class'=>'form-horizontal form-row-seperated','id'=>'form_sample_3')) !!}
        <input type="hidden" name="vehicle_id" id="vehicle_id" value="{{$Vehicle->id}}" />
        <input type="hidden" name="vehicle_type" id="vehicle_type" value="Vehicle" />
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-basket font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">
                        Edit {{ $Vehicle->name}} </span>
                </div>
                <div class="actions btn-set">
                    <button class="btn green-haze btn-circle"><i class="fa fa-check-circle"></i> Save & Continue Edit</button>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li <?php if (null == $tab) echo 'class="active"'; ?>>
                            <a href="#tab_general" data-toggle="tab">
                                General </a>
                        </li>
                        <li>
                            <a href="#tab_meta" data-toggle="tab">
                                Meta </a>
                        </li>
                        <li <?php if ('images' == $tab) echo 'class="active"'; ?>>
                            <a href="#tab_images" data-toggle="tab">
                                Images </a>
                        </li>
                        <li <?php if ('features' == $tab) echo 'class="active"'; ?>>
                            <a href="#tab_features" data-toggle="tab">
                                Features
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content no-space">
                        <div class="tab-pane <?php if (null == $tab) echo 'active'; ?>" id="tab_general">
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
                                        {!! Form::select('model_id',$BrandList, Input::old('model_id'), array('class'=>'form-control input-xlarge select2me','data-placeholder'=>'Select..')) !!}
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
                                        <?php 
                                            $is_active = Input::old('is_active')=='Active' ? 1:0; 
                                        ?>
                                        {!!  Form::select('is_active',['0'=>'Not Active','1'=>'Active'] , $is_active, ['id'=>'is_active','placeholder' => 'Select Status','class'=>'table-group-action-input form-control input-medium']) !!}
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
                        <div class="tab-pane <?php if ('images' == $tab) echo 'active'; ?>" id="tab_images">
                            <div class="col-md-12">
                                <p><span class="label label-danger">NOTE: </span>&nbsp; This plugins works only on Latest Chrome, Firefox, Safari, Opera & Internet Explorer 10.</p>
                                <div id="mydropzone" class="dropzone"></div>
                            </div>

                        </div>
                        <div class="tab-pane <?php if ('features' == $tab) echo 'active'; ?>" id="tab_features">
                            <div class="portlet box">
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <div class="form-body">
                                        @foreach($FeatureCategory  as $category)
                                        <h3 class="form-section green">{{$category->name}}</h3>
                                        @if($category->features->count() > 0 )
                                        @if(TEXT == $category->input_type)
                                        <div class="row">
                                            <?php
                                            $i = 1;
                                            foreach ($category->features as $feature) {
                                                ?>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">{{$feature->name}}</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" placeholder="Chee Kin">
                                                            <span class="help-block">
                                                                This is inline help </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                if ($i % 2 == 0) {
                                                    echo '</div><div class="row">';
                                                }
                                                $i++;
                                            }
                                            ?>

                                        </div>
                                        @endif
                                        @if(CHECKBOX == $category->input_type)
                                        <input name="check_validate[]" type="hidden" value="{{ $category->id }}" />
                                        <input name="check_validate_message[]" type="hidden" value="{{ 'Please select atleast one  '.$category->name }}" />
                                        <div class="row">
                                            <div class="form-group {{($errors->has('features_checkbox_'.$category->id)) ? "has-error" : ""}}">

                                                <div class="checkbox-inline" data-error-container="#form_2_services_error">
                                                    <?php
                                                    foreach ($category->features as $feature) {
                                                        echo '<label>';
                                                        echo Form::checkbox("features_checkbox_" . $category->id . "[]", $feature->id, in_array($feature->id, $VehicleFeatures));
                                                        echo $feature->name . '</label>&nbsp;&nbsp;';
                                                    }
                                                    ?>
                                                    @if ($errors->has('features_checkbox_'.$category->id))
                                                    <div id="form_2_membership_error">
                                                        <span id="membership-error" class="help-block">{{ $errors->first('features_checkbox_'.$category->id) }}</span>
                                                    </div>
                                                    @endif 
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    @endif
                                    @if(RADIO == $category->input_type)
                                    <input name="radio_validate[]" type="hidden" value="{{ $category->id }}" />
                                    <input name="radio_validate_message[]" type="hidden" value="{{ 'Please select '.$category->name }}" />
                                    <div class="row">
                                        <div class="form-group {{($errors->has('features_radio_'.$category->id)) ? "has-error" : ""}}">
                                            <label class="control-label">&nbsp;&nbsp;&nbsp;</label>
                                            <div class="col-md-9">
                                                <div class="radio-list" data-error-container="#form_2_services_error">
                                                    <?php
                                                    foreach ($category->features as $feature) {
                                                        echo '<label class="radio-inline">';
                                                        echo Form::radio("features_radio_" . $category->id, $feature->id, in_array($feature->id, $VehicleFeatures));
                                                        echo $feature->name . '</label>&nbsp;';
                                                    }
                                                    ?>
                                                </div>
                                                @if ($errors->has('features_radio_'.$category->id))
                                                <div id="form_2_membership_error">
                                                    <span id="membership-error" class="help-block">{{ $errors->first('features_radio_'.$category->id) }}</span>
                                                </div>
                                                @endif
                                            </div>

                                        </div>

                                    </div>
                                    @endif
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
{!! Html::script('admin/global/plugins/dropzone/dropzone.js') !!}
{!! Html::script('admin/pages/scripts/form-dropzone.js') !!}
{!! Html::script('admin/custom/vehicle/create-form-validation.js') !!}
{!! Html::script('admin/custom/vehicle/create.js') !!}
@stop

@section('pageFooterScriptInitialize')	{{-- Page Footer Script Initialization Code --}}
<script>
    jQuery(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            }
        });
        // var Dropzone = new Dropzone("div#mydropzone", { url: "file-upload"});
        Dropzone.autoDiscover = false;
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        //FormValidation.init();
        VehicleAdd.init();
        $("#mydropzone").dropzone({
            init: function () {
               
                this.on("success", function (file, response) {
                    //alert(JSON.stringify(response));
                    file.serverId = response.id;
                    file.name = response.name;
                    file.size = response.size;

                });
               
                this.on("removedfile", function (file) {
                    if (!file.serverId) {
                        return;
                    }
                    var url = '{{ route("image.delete", ":id") }}';
                    url = url.replace(':id', file.serverId);
                    //$.post(url);
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function(result) {
                            // Do something with the result
                        }
                    });
                });
                        thisDropzone = this;
                        $.get("{{ route('vehicle.images',array($Vehicle->id,'Vehicle'))}}", function (data) {
                               $.each(data, function (key, value) {
                 
                                        var mockFile = {name: value.name, size: value.size, serverId: value.id};
                         
                                        thisDropzone.options.addedfile.call(thisDropzone, mockFile);
         
                                        thisDropzone.options.thumbnail.call(thisDropzone, mockFile, '/imagecache/small/' + value.name);
                                                        var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-block'>Remove file</button>");
                        removeButton.addEventListener("click", function (e) {
                            // Make sure the button click doesn't submit the form:
                            e.preventDefault();
                            e.stopPropagation();
                            thisDropzone.removeFile(mockFile);
                        });
                        mockFile.previewElement.appendChild(removeButton);
                                });
             
                        });
                this.on("addedfile", function (file) {
                    // Create the remove button
                    var removeButton = Dropzone.createElement("<button class='btn btn-sm btn-block'>Remove file</button>");

                    // Capture the Dropzone instance as closure.
                    var _this = this;

                    // Listen to the click event
                    removeButton.addEventListener("click", function (e) {
                        // Make sure the button click doesn't submit the form:
                        e.preventDefault();
                        e.stopPropagation();

                        // Remove the file preview.
                        _this.removeFile(file);
                        // If you want to the delete the file on the server as well,
                        // you can do the AJAX request here.
                        alert(file.serverId);
                    });

                    // Add the button to the file preview element.
                    file.previewElement.appendChild(removeButton);
                });
                    },
            acceptedFiles: 'image/*',
            url: "{{ admin_route('vehicle.imageupload')}}",
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            sending: function (file, xhr, formData) {
                // Pass token. You can use the same method to pass any other values as well such as a id to associate the image with for example.
                formData.append("imageable_id", $('#vehicle_id').val()); // Laravel expect the token post value to be named _token by default
                formData.append("imageable_type", $('#vehicle_type').val());
            },
            error: function (file, response) {
                //alert(JSON.stringify(response));
                if ($.type(response) === "string")
                    var message = response; //dropzone sends it's own error messages in string
                else
                    var message = response.file;
                file.previewElement.classList.add("dz-error");
                _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            }
        });
        //FormDropzone.init();
    });
</script>
@stop