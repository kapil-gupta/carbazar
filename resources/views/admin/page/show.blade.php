@extends('admin.layouts.onecolom')


@section('pageHeadSpecificCSS')	{{-- Page Head Specific CSS Files --}}
{!! Html::style('admin/global/plugins/fancybox/source/jquery.fancybox.css') !!}
{!! Html::style('admin/pages/css/portfolio.css') !!}
@stop

@section('pageHeadSpecificJS')	{{-- Page Head Specific JS Files --}}
@stop
<?php
$Page = $page->getBody()->getDataByKey('Page');
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
                        {{ $Page->name}} </span>
                </div>
                <div class="actions btn-set">
                    <!-- <button type="button" name="back" class="btn btn-default btn-circle"><i class="fa fa-angle-left"></i> Back</button>
                    <button class="btn btn-default btn-circle "><i class="fa fa-reply"></i> Reset</button>
                    <button class="btn green-haze btn-circle"><i class="fa fa-check"></i> Save</button>-->
                    <a class="btn green-haze btn-circle" href="{{admin_route('page.edit',$Page->id)}}"><i class="fa fa-check-circle"></i> Edit</a>
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

                    </ul>
                    <div class="tab-content no-space">
                        <div class="tab-pane active" id="tab_general">
                            <div class="form-body">
                                <div class="col-md-6 col-sm-12">
                                    <div class="row static-info">
                                        <div class="col-md-5 name">
                                            Parent:
                                        </div>
                                        <div class="col-md-7 value">
                                             @if($Page->category()->count()){{$Page->category->name}}@endif
                                        </div>
                                    </div>
                                    <div class="row static-info">
                                        <div class="col-md-5 name">
                                            Name: 
                                        </div>
                                        <div class="col-md-7 value">
                                           {{$Page->name}}
                                        </div>
                                    </div>
                                    <div class="row static-info">
                                        <div class="col-md-5 name">
                                            Description:
                                        </div>
                                        <div class="col-md-7 value">
                                            {!! $Page->description !!}
                                        </div>
                                    </div>
                                    <div class="row static-info">
                                        <div class="col-md-5 name">
                                            Status:
                                        </div>
                                        <div class="col-md-7 value">
                                            {{$Page->IsActive}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_meta">
                            <div class="form-body">
                                <div class="col-md-12 col-sm-12">
                                    <div class="row static-info">
                                        <div class="col-md-5 name">
                                            Meta Title:
                                        </div>
                                        <div class="col-md-7 value">
                                            {{$Page->seo->title}}
                                        </div>
                                    </div>
                                    <div class="row static-info">
                                        <div class="col-md-5 name">
                                            Meta Keywords:
                                        </div>
                                        <div class="col-md-7 value">
                                            {{$Page->seo->keyword}}
                                        </div>
                                    </div>
                                    <div class="row static-info">
                                        <div class="col-md-5 name">
                                            Meta Description:
                                        </div>
                                        <div class="col-md-7 value">
                                            {{$Page->seo->description}}
                                        </div>
                                    </div>
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