@extends('admin.layouts.onecolom')


@section('pageHeadSpecificCSS')	{{-- Page Head Specific CSS Files --}}
{!! Html::style('admin/global/plugins/select2/select2.css') !!}
{!! Html::style('admin/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css') !!}
{!! Html::style('admin/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css') !!}
{!! Html::style('admin/global/plugins/bootstrap-datepicker/css/datepicker.css') !!}
{!! Html::style('admin/global/plugins/fancybox/source/jquery.fancybox.css') !!}
@stop

@section('pageHeadSpecificJS')	{{-- Page Head Specific JS Files --}}
@stop
<?php
$AllBrands = $page->getBody()->getDataByKey('Brands');
?>
@section('bodyContent')	{{-- Page Body Content --}}
<!-- START :: Logo -->
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal form-row-seperated" action="javascript:;">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-basket font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">
                            Add Vehicle </span>
                        <!--<span class="caption-helper">Man Tops</span>-->
                    </div>
                    <div class="actions btn-set">
                        <button type="button" name="back" class="btn btn-default btn-circle"><i class="fa fa-angle-left"></i> Back</button>
                        <button class="btn btn-default btn-circle "><i class="fa fa-reply"></i> Reset</button>
                        <button class="btn green-haze btn-circle"><i class="fa fa-check"></i> Save</button>
                        <button class="btn green-haze btn-circle"><i class="fa fa-check-circle"></i> Save & Continue Edit</button>
                        <div class="btn-group">
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
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
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
                        </ul>
                        <div class="tab-content no-space">
                            <div class="tab-pane active" id="tab_general">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Name: <span class="required">
                                                * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="product[name]" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Description: <span class="required">
                                                * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <textarea class="ckeditor form-control" name="editor2" rows="6" data-error-container="#editor2_error"></textarea>
                                            <div id="editor2_error">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Select Model: <span class="required">
                                                * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <select class="form-control input-xlarge select2me" data-placeholder="Select...">
                                                <option value=""></option>
                                                @foreach($AllBrands as $brand)
                                                <option value="AL">{{$brand->brand->name." ".$brand->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Price: <span class="required">
                                                * </span>
                                        </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="product[price]" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Status: <span class="required">
                                                * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <select class="table-group-action-input form-control input-medium" name="product[status]">
                                                <option value="">Select...</option>
                                                <option value="1">Active</option>
                                                <option value="0">Not Active</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_meta">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Meta Title:</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control maxlength-handler" name="product[meta_title]" maxlength="100" placeholder="">
                                            <span class="help-block">
                                                max 100 chars </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Meta Keywords:</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control maxlength-handler" rows="8" name="product[meta_keywords]" maxlength="1000"></textarea>
                                            <span class="help-block">
                                                max 1000 chars </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Meta Description:</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control maxlength-handler" rows="8" name="product[meta_description]" maxlength="255"></textarea>
                                            <span class="help-block">
                                                max 255 chars </span>
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
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('pageFooterSpecificPlugin')	{{-- Page Footer Specific Plugin Files --}}
<!-- BEGIN PAGE LEVEL PLUGINS -->
{!! Html::script('admin/global/plugins/jquery-validation/js/jquery.validate.min.js') !!}
{!! Html::script('admin/global/plugins/jquery-validation/js/additional-methods.min.js') !!}
{!! Html::script('admin/global/plugins/select2/select2.min.js') !!}
{!! Html::script('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
{!! Html::script('admin/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') !!}
{!! Html::script('admin/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') !!}
{!! Html::script('admin/global/plugins/ckeditor/ckeditor.js') !!}
{!! Html::script('admin/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js') !!}
{!! Html::script('admin/global/plugins/bootstrap-markdown/lib/markdown.js') !!}
{!! Html::script('admin/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') !!}
{!! Html::script('admin/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js') !!}
{!! Html::script('admin/global/plugins/fancybox/source/jquery.fancybox.pack.js') !!}
<!-- END PAGE LEVEL PLUGINS -->
@stop

@section('pageFooterSpecificJS')
{!! Html::script('admin/custom/vehicle/form-validation.js') !!}
{!! Html::script('admin/custom/vehicle/edit.js') !!}
@stop

@section('pageFooterScriptInitialize')	{{-- Page Footer Script Initialization Code --}}
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        // FormValidation.init();
        VehicleEdit.init();
    });
</script>
@stop