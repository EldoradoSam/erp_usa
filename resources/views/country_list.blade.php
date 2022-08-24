@extends('layouts.app')

@section('head')
<!-- DataTable -->
<link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ url('assets/css/slider_switch.css') }}" type="text/css">
<!-- Prism -->
<link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">


<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-body">
                <h6 class="card-title">Country list</h6>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <button id="btnAdd" name="btnAdd" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </div>
                </div>
                {{ csrf_field() }}
                <table id="tblCountry" class="table table-striped table-bordered dataTable dtr-inline collapsed" role="grid" aria-describedby="example1_info">
                    <thead>
                        <tr>
                            <th>Country Name</th>
                            <th>Code</th>
                            <th>Import Instruction (URL)</th>
                            <th>Edit</th>
                            <th>View</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="tblCountryList"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="countryModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="countryModalTitle">Add new country</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>
            <form method="POST" id="countryForm">
                <input type="hidden" id="countryID" name="countryID" value>
                <div class="modal-body" id="countryModalBody">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Country Code</label>
                            <input type="text" id="txtCode" name="code" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>Country Name</label>
                            <input type="text" id="txtName" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="row" id="divInstructionEdit">
                        <div class="col-md-12 mb-3">
                            <label>Import Instructions</label>
                            <input type="text" id="txtInstruction" name="instruction" class="form-control">
                        </div>
                    </div>
                    <div class="row" id="divInstructionView">
                        <div class="col-md-12 mb-3">
                            <a id="lblInstruction" href="#"></a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-primary" id="btnSetting">Save</button>
                </div>
            </form>
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
<!-- <script src="{{ url('assets/js/hr/employeeList.js') }}"></script> -->

<!-- Prism -->
<script src="{{ url('vendors/prism/prism.js') }}"></script>

<!-- custom js  -->
<!-- <script src="{{ url('assets/js/sc/product_list.js') }}"></script> -->
<script src="{{ url('assets/js/country_list.js') }}?random=<?php echo uniqid(); ?>"></script>
@endsection