@extends('layouts.app')

@section('head')
<!-- DataTable -->
<link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
<!-- Prism -->
<link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
<link rel="stylesheet" href="{{ url('assets/css/settings.css') }}" media="all" type="text/css" />

<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('content')

<div class="page-header">
    <div>
        <h3></h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Form Page</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-body">
                <h6 class="card-title">Customer Order Status</h6>
                {{ csrf_field() }}
                <table id="myTable" class="table table-striped table-bordered dataTable dtr-inline collapsed" role="grid" aria-describedby="example1_info">
                    <thead>
                        <tr>
                            <th class="factory_po_num">Factory PO number</th>
                            <th class="customer_po_num">Customer PO number</th>
                            <th>Customer Name</th>
                            <th>Order Status</th>
                            <th class="action">Action</th>
                            <th>Fund Status</th>
                            <th class="action">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('script')
<!-- DataTable -->
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/datatable.js') }}"></script>
<script src="{{ url('assets/js/customer_order_accept_list.js') }}?random=<?php echo uniqid(); ?>"></script>

<!-- Prism -->
<script src="{{ url('vendors/prism/prism.js') }}"></script>
<!-- Sweet alert -->
<script src="{{ url('assets/js/examples/sweet-alert.js') }}"></script>
@endsection