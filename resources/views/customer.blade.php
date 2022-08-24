@extends('layouts.app')

@section('head')
<!-- DataTable -->
<link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ url('vendors/datepicker/daterangepicker.css') }}" type="text/css">
<!-- Prism -->
<link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
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
            <form method="POST" id="customerForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                    <h6 class="card-title">Customer</h6>
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-general-tab" data-toggle="pill" href="#tbGeneral" role="tab" aria-controls="pills-general" aria-selected="true">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#tbContactInfo" role="tab" aria-controls="pills-contact" aria-selected="false">Contacts</a>
                        </li>
                        <!--<li class="nav-item">
                            <a class="nav-link" id="pills-ShipingAddress-tab" data-toggle="pill" href="#tbShipingAddress" role="tab" aria-controls="pills-ShipingAddress" aria-selected="false">Shiping Address</a>
                        </li>!-->
                        <!--<li class="nav-item">
                            <a class="nav-link" id="pills-attachment-tab" data-toggle="pill" href="#tbAttachment" role="tab" aria-controls="pills-attachment" aria-selected="false">Attachment</a>
                        </li>!-->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-Notes-tab" data-toggle="pill" href="#tbNotes" role="tab" aria-controls="pills-Notes" aria-selected="false">Note</a>
                        </li>

                    </ul>
                    <br>


                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tbGeneral" role="tabpanel" aria-labelledby="pills-general-tab">
                            <div class="form-row">
                                <input type="hidden" name="hiddenCustomerId" id="hiddenCustomerId">
                                <!--<div class="col-md-4">
                                    <label for="SupplierId">Customer ID</label>
                                    <input type="text" onchange=" setcustomerId()" class="form-control" name="txtCustomerId" id="txtCustomerId" placeholder="Customer Id" required="">
                                </div>!-->
                                <div class="col-md-12 mb-3">
                                    <label for="supplierName">Customer Name</label>
                                    <input type="text" class="form-control" name="txtCustomerName" id="txtCustomerName" placeholder="Customer Name" required="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="address">Customer Bill To Address</label>
                                    <textarea class="form-control" id="txtAddress" name="txtAddress" placeholder="Address"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="address">Customer Delivery Address & Contact</label>
                                    <textarea class="form-control" id="txtDeliveryAddress" name="txtDeliveryAddress" placeholder="Delivery Address"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="address">Consignee Name, Address, Contact</label>
                                    <textarea class="form-control" id="txtCosigneeDetails" name="txtCosigneeDetails" placeholder="Consignee Contacts"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="address">Notify Party Name, Address, Contact (If in USA leave blank)</label>
                                    <textarea class="form-control" id="txtPartyDetails" name="txtPartyDetails" placeholder="Party Name, Address"></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-8">
                                    <label for="webAddress">Web Address</label>
                                    <input type="text" class="form-control" name="txtWebAddress" id="txtWebAddress" placeholder="Web Address" required="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>Country</label>
                                    <select class="form-control" id="selectCountry" name="selectCountry" required=""></select>
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>GL Posting</label>
                                    <select class="form-control" id="selectAccountgroup_id" name="selectAccountgroup_id" required=""></select>
                                </div>
                            </div>
                            <!--<div class="form-row">
                                <div class="col-md-6">
                                    <label>Status</label>
                                    <input type="text" class="form-control" name="txtStatus" id="txtStatus" placeholder="Status" required="">

                                </div>
                            </div>!-->

                            <div class="form-row">
                                <div class="col-md-8">
                                    <label>Notes</label>
                                    <textarea class="form-control" id="textNotes" name="textNotes" placeholder="Notes"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show activated" id="tbContactInfo" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="mb-3">
                                <button type="button" id="btncontactsmodal" class="btn btn-primary" data-target="" data-whatever="@getbootstrap" name="save">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="row" id='rowBottomTable'>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <!-- Required for Responsive -->
                                        <table id="myTable" class="table table-striped  datatable">
                                            <thead>
                                                <tr>
                                                    <th class="thdesignation">Designation</th>
                                                    <th class="themail">Email</th>
                                                    <th class="thMobile">Mobile</th>
                                                    <th class="thFixedMobile">Fixed Mobile</th>
                                                    <th class="edit">Edit</th>
                                                    <th class="delete">delete</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="tbShipingAddress" role="tabpanel" aria-labelledby="pills-ShipingAddress-tab">

                        </div>
                        <div class="tab-pane fade" id="tbNotes" role="tabpanel" aria-labelledby="pills-notes-tab">
                            <div class="form-row">
                                <div class="col-md-12 mb-5">
                                    <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                                    <label for="txtNotes">Notes</label>
                                    <br>
                                    <textarea class="form-control" id="txtNotes" name="txtNotes"></textarea>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tbAttachment" role="tabpanel" aria-labelledby="pills-attachment-tab">
                            <div class="row" id="attachmentTable">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <!-- Required for Responsive -->
                                        <table id="myTable2" class="table table-striped  datatable">
                                            <thead>
                                                <tr>
                                                    <th class="thTitle">Title</th>
                                                    <th class="thView">View</th>
                                                    <th class="thDownload">Down</th>
                                                    <th class="thDelete">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer employeeSave">
                    {{-- <button type="button" class="btn btn-warning" id="btnResetSupplier" onclick="Reset()">Reset</button> --}}
                    <button type="button" class="btn btn-primary" id="btnSaveCustomer">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="contactsmodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="settingsAddModalTitle">Add Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>
            <form method="POST" id="contactfrm">
                {{csrf_field()}}
                <input type="hidden" id="hidecustomerId" name="hidecustomerId" value>
                <input type="hidden" id="hidecontactId" name="hidecontactId" value>
                <div class="modal-body" id="settingsAddModalBody">
                    <div class="form-row">

                        <div class="col-md-6">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" name="txtDesignation" id="txtDesignation" placeholder="Designation" required="">
                        </div>
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="hidden" name="hiddenContactID" id="hiddenContactID">
                            <input type="text" class="form-control" name="txtEmail" id="txtEmail" placeholder="Email" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control" name="txtMobile" id="txtMobile" placeholder="Mobile" required="">
                        </div>
                        <div class="col-md-6">
                            <label for="fixedMobile">Fixed Mobile</label>
                            <input type="text" class="form-control" name="txtFixedMobile" id="txtFixedMobile" placeholder="Fixed Mobile" required="">
                        </div>
                    </div> <br>
                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="checkPrimaryContact" id="checkPrimaryContact" required="">
                                    <label class="form-check-label" for="invalidCheck">
                                        Primary Contact
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="checkSMSAlert" id="checkSMSAlert" required="">
                                    <label class="form-check-label" for="invalidCheck">
                                        SMS Alert
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="checkEmailAlert" id="checkEmailAlert" required="">
                                    <label class="form-check-label" for="invalidCheck">
                                        Email Alert
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnSaveContact">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<!-- App scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('script')
<!-- DataTable -->
<script src="{{ url('vendors/dataTable/datatables.min.js') }}"></script>
<script src="{{ url('assets/js/examples/datatable.js') }}"></script>
<!-- Javascript -->
<script src="{{ url('vendors/datepicker/daterangepicker.js') }}"></script>
<!-- <script src="{{ url('assets/js/gn/supplier.js') }}"></script> -->
<script src="{{url('assets/js/customer.js') }}?random=<?php echo uniqid(); ?>"></script>

<!-- Prism -->
<script src="{{ url('vendors/prism/prism.js') }}"></script>
@endsection