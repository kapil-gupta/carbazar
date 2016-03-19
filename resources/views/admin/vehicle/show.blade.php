@extends('admin.layouts.onecolom')


@section('pageHeadSpecificCSS')	{{-- Page Head Specific CSS Files --}}
{!! Html::style('admin/global/plugins/fancybox/source/jquery.fancybox.css') !!}
{!! Html::style('admin/pages/css/portfolio.css') !!}
@stop

@section('pageHeadSpecificJS')	{{-- Page Head Specific JS Files --}}
@stop
<?php
$BrandList = $page->getBody()->getDataByKey('Brands');
$Vehicle = $page->getBody()->getDataByKey('Vehicle');
$FeatureCategory = $page->getBody()->getDataByKey('FeatureCategory');
$VehicleFeatures = $page->getBody()->getDataByKey('vehicleFeatures');
//$tab = $page->getBody()->getDataByKey('tab');
?>
@section('bodyContent')	{{-- Page Body Content --}}
<!-- START :: Logo -->
<div class="row">
    <div class="col-md-12">
        <!-- <form class="form-horizontal form-row-seperated" action="javascript:;">-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-basket font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">
                        {{ $Vehicle->name}} </span>
                </div>
                <div class="actions btn-set">
                    <!-- <button type="button" name="back" class="btn btn-default btn-circle"><i class="fa fa-angle-left"></i> Back</button>
                    <button class="btn btn-default btn-circle "><i class="fa fa-reply"></i> Reset</button>
                    <button class="btn green-haze btn-circle"><i class="fa fa-check"></i> Save</button>-->
                    <a class="btn green-haze btn-circle" href="{{admin_route('vehicle.edit',$Vehicle->id)}}"><i class="fa fa-check-circle"></i> Edit</a>
                </div>
            </div>
            <div class="portlet-body form bordered">
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
                            <div class="portlet-body">
                                <div class="col-md-6  col-sm-12">
                                    <div class="row static-info">
                                        <div class="col-md-5 value">
                                            Category:
                                        </div>
                                        <div class="col-md-7 value">
                                           {{$Vehicle->category->name}}
                                        </div>
                                    </div>
                                    <div class="row static-info">
                                        <div class="col-md-5 value">
                                             Model:
                                        </div>
                                        <div class="col-md-7 value">
                                           {{$Vehicle->model->brand->name." ".$Vehicle->model->name}}
                                        </div>
                                    </div>
                                    <div class="row static-info">
                                        <div class="col-md-5 value">
                                             Status:
                                        </div>
                                        <div class="col-md-7 value">
                                           {{$Vehicle->IsActive}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6  col-sm-12">
                                    <div class="row static-info">
                                        <div class="col-md-5 value">
                                            Name:
                                        </div>
                                        <div class="col-md-7 value">
                                           {{$Vehicle->name}}
                                        </div>
                                    </div>
                                    <div class="row static-info">
                                        <div class="col-md-5 value">
                                            Price:
                                        </div>
                                        <div class="col-md-7 value">
                                           {{$Vehicle->price}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_meta">
                            <div class="portlet-body">
                                <div class="col-md-12  col-sm-12">
                                    <div class="row static-info">
                                        <div class="col-md-5 value">
                                            Meta Title:
                                        </div>
                                        <div class="col-md-7 value">
                                           {{$Vehicle->seo->title}}
                                        </div>
                                    </div>
                                    <div class="row static-info">
                                        <div class="col-md-5 value">
                                            Meta Keywords:
                                        </div>
                                        <div class="col-md-7 value">
                                           {{$Vehicle->seo->keyword}}
                                        </div>
                                    </div>
                                    <div class="row static-info">
                                        <div class="col-md-5 value">
                                            Meta Description:
                                        </div>
                                        <div class="col-md-7 value">
                                           {{$Vehicle->seo->description}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_images">
                            <div class="row mix-grid thumbnails">
                                @foreach($Vehicle->photos  as $photo)
                                <div class="col-md-4 mix category_1">
                                    <div class="mix-inner">
                                        <img class="img-responsive" src="{{route('imagecache',['large',$photo->name])}}" alt="">
                                        <div class="mix-details">
                                            <h3>{{$Vehicle->name}}</h3>
                                            <a class="mix-preview fancybox-button" href="{{route('imagecache',['original',$photo->name])}}" title="{{$Vehicle->name}}" data-rel="fancybox-button">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_features">
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
    </div>
</div>
@stop

@section('pageFooterSpecificPlugin')	{{-- Page Footer Specific Plugin Files --}}
<!-- BEGIN PAGE LEVEL PLUGINS -->
{!! Html::script('admin/global/plugins/jquery-mixitup/jquery.mixitup.min.js') !!}
{!! Html::script('admin/global/plugins/fancybox/source/jquery.fancybox.pack.js') !!}
<!-- END PAGE LEVEL PLUGINS -->
@stop

@section('pageFooterSpecificJS')
{!! Html::script('admin/pages/scripts/portfolio.js') !!}
@stop

@section('pageFooterScriptInitialize')	{{-- Page Footer Script Initialization Code --}}
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        Portfolio.init();
    });
</script>
@stop