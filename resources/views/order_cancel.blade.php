@extends('layouts.app')

@section('head')
<!-- Prism -->
<link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">

<!-- Datepicker -->
<link rel="stylesheet" href="{{ url('vendors/datepicker/daterangepicker.css') }}" type="text/css">

<!-- DataTable -->
<link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('content')

<div class="page-header">
    <div>
        <h3>Order Cancel</h3>
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

        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Order Cancel</h6>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label>Date</label>
                        <input type="text" class="form-control" id="txtDate" name="txtDate">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label>Factory PO No.</label>
                        <select id="cmbFactoryPO" class="form-control"></select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label>Customer PO No.</label>
                        <label id="lblCustomerPO" class="form-control"></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label>Reason</label>
                        <select id="cmbReason" class="form-control"></select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label>Remark</label>
                        <textarea id="txtRemark" class="form-control"></textarea>
                    </div>
                </div>
         
                <hr>
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <button type="button" id="btnAction" class="btn btn-primary">Save</button>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <div id="supplierChooser"></div>

    <!-- JQuery !-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @endsection


    @section('script')
    <!-- Datepicker -->
    <script src="{{ url('vendors/datepicker/daterangepicker.js') }}"></script>
    <!-- DataTable -->
    <script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
    <script src="{{ url('assets/js/order_cancel.js') }}?random=<?php echo uniqid(); ?>"></script>


    @endsection