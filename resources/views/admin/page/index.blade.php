@extends('admin.layouts.onecolom')


@section('pageHeadSpecificCSS')	{{-- Page Head Specific CSS Files --}}
{!! Html::style('admin/global/plugins/select2/select2.css') !!}
{!! Html::style('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') !!}
{!! Html::style('admin/global/plugins/bootstrap-datepicker/css/datepicker.css') !!}
@stop

@section('pageHeadSpecificJS')	{{-- Page Head Specific JS Files --}}
@stop
<?php
//$BrandList = $page->getBody()->getDataByKey('Brands');
//$Vehicle = $page->getBody()->getDataByKey('Vehicle');
//$FeatureCategory = $page->getBody()->getDataByKey('FeatureCategory');
//$VehicleFeatures = $page->getBody()->getDataByKey('vehicleFeatures');
//$tab = $page->getBody()->getDataByKey('tab');
?>
@section('bodyContent')	{{-- Page Body Content --}}
<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light">
            <div class="portlet-title">
               <div class="caption">
                    <i class="fa fa-gift font-green-sharp"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">Vehicles</span>
                </div>
                 <!--<div class="actions">
                    <div class="btn-group">
                        <a class="btn btn-default btn-circle" href="javascript:;" data-toggle="dropdown">
                            <i class="fa fa-share"></i> Tools <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:;">
                                    Export to Excel </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    Export to CSV </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    Export to XML </a>
                            </li>
                            <li class="divider">
                            </li>
                            <li>
                                <a href="javascript:;">
                                    Print Invoices </a>
                            </li>
                        </ul>
                    </div>
                </div>-->
            </div> 
            <div class="portlet-body">
                <div class="table-container">
                    <div class="table-actions-wrapper">
                        <span>
                        </span>
                        <select class="table-group-action-input form-control input-inline input-small input-sm">
                            <option value="">Select...</option>
                            <option value="publish">Publish</option>
                            <option value="unpublished">Un-publish</option>
                            <option value="delete">Delete</option>
                        </select>
                        <button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i> Submit</button>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="datatable_products">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="10%">
                                    ID
                                </th>
                                <th width="15%">
                                    Product&nbsp;Name
                                </th>
                                <th width="15%">
                                    Category
                                </th>
                                <th width="15%">
                                   Brand
                                </th>
                                <th width="15%">
                                    Model
                                </th>
                                <th width="10%">
                                    Price
                                </th>
                                <th width="15%">
                                    Date&nbsp;Created
                                </th>
                                <th width="10%">
                                    Status
                                </th>
                                <th width="10%">
                                    Action
                                </th>
                            </tr>

                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
@stop

@section('pageFooterSpecificPlugin')	{{-- Page Footer Specific Plugin Files --}}
<!-- BEGIN PAGE LEVEL PLUGINS -->
{!! Html::script('admin/global/plugins/select2/select2.min.js') !!}
{!! Html::script('admin/global/plugins/datatables/media/js/jquery.dataTables.min.js') !!}
{!! Html::script('admin/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') !!}
{!! Html::script('admin/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') !!}
<!-- END PAGE LEVEL PLUGINS -->
@stop

@section('pageFooterSpecificJS')
{!! Html::script('admin/global/scripts/datatable.js') !!}
@stop

@section('pageFooterScriptInitialize')	{{-- Page Footer Script Initialization Code --}}
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        $('#datatable_products').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('vehicle.list') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'category.name', name: 'categroy', orderable: false, searchable: false},
                {data: 'model.brand.name' , name: 'brand', orderable: false, searchable: false},
                {data: 'model.name' , name: 'model', orderable: false, searchable: false},
                {data: 'price', name: 'price'},
                {data: 'created_at', name: 'created_at'},
                {data: 'is_active', name: 'is_active'},
                 {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
@stop