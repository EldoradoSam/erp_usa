@extends('layouts.app')

@section('head')
<!-- DataTable -->
<link rel="stylesheet" href="{{ url('vendors/dataTable/datatables.min.css') }}" type="text/css">
<link rel="stylesheet" href="{{ url('vendors/datepicker/daterangepicker.css') }}" type="text/css">
<!-- Prism -->
<link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
<link rel="stylesheet" href="{{ url('assets/js/autocomplete2/css/autocomplete.min.css') }}" type="text/css">
<!-- Css -->
<link rel="stylesheet" href="{{ url('vendors/dropzone/dropzone.css') }}" type="text/css">
<link rel="stylesheet" href="{{ url('assets/css/hr/employee.css') }}" type="text/css">
<link rel="stylesheet" href="{{ url('assets/css/hr/settings.css') }}" media="all" type="text/css" />


<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    var user_type = "{{ Auth::user()->user_type }}";
</script>
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
                <h6 class="card-title">Order Form</h6>

                <form id="orderForm" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <i class="fa fa-search text-info" aria-hidden="true"></i>
                                    <label for="txtName">1. Customer Name</label>
                                    <input type="hidden" id="hidOrderID" name="hidOrderID" value="">
                                    <input type="text" class="form-control auto-complete required-input" id="txtName" name="name" placeholder="Customer Name" required="">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <i class="fa fa-search text-info" aria-hidden="true"></i>
                                    <label for="txtPurchase">2. Customer Purchase Order Number</label>
                                    <input type="text" class="form-control required-input" id="txtPurchase" name="txtPurchase" placeholder="RBMX-20110601 (Agrico-3210)" required="" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                                    <label for="txtName">3. Factory PO number</label>
                                    <input type="text" class="form-control required-input" id="txtFactoryPo" name="txtFactoryPo" placeholder="Factory PO number" required="" AutoComplete="off">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                                    <label for="txtPurchase">4. Invoice Number</label>
                                    <input type="text" class="form-control  required-input" id="txtInvoiceNumber" name="txtInvoiceNumber" placeholder="Invoice Number" required="" AutoComplete="off">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <i class="fa fa-address-book-o text-info" aria-hidden="true"></i>
                                            <label for="txtBillAddress">5. Customer Bill To Address</label>
                                            <textarea class="form-control required-input" id="txtBillAddress" name="txtBillAddress"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <i class="fa fa-address-book-o text-info" aria-hidden="true"></i>
                                            <label for="txtDeliveryAddress">6. Customer Delivery Address & Contact</label>
                                            <textarea class="form-control required-input" id="txtDeliveryAddress" name="txtDeliveryAddress"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <i class="fa fa-address-book-o text-info" aria-hidden="true"></i>
                                            <label for="txtCosigneeDetails">7. Consignee Name, Address, Contact </label>
                                            <textarea class="form-control  required-input" id="txtCosigneeDetails" name="txtCosigneeDetails"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <i class="fa fa-address-book-o text-info" aria-hidden="true"></i>
                                            <label for="txtPartyDetails">8. Notify Party Name, Address, Contact (If in USA leave blank)</label>
                                            <textarea class="form-control  required-input" id="txtPartyDetails" name="txtPartyDetails"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <i class="fa fa-address-book-o text-info" aria-hidden="true"></i>
                                            <label for="txtPartyDetails">9. Country</label>
                                            <select id="cmbCountry" name="cmbCountry" class="form-control"></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <i class="fa fa-calendar text-info" aria-hidden="true"></i>
                                    <label for="Date">10. Date</label>
                                    <input type="text" name="dteDate" class="form-control required-input" id="dteDate" placeholder="YYYY-MM-DD">
                                </div>

                                <div class="col-md-3 mb-3">
                                    <i class="fa fa-calendar text-info" aria-hidden="true"></i>
                                    <label for="DeliveryDate">11. Requested Delivery Date</label>
                                    <input type="text" name="dteDeliveryDate" class="form-control required-input" id="dteDeliveryDate" placeholder="YYYY-MM-DD" AutoComplete="off">
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <i class="fa fa-angle-down text-info" aria-hidden="true"></i>
                                    <label for="selcShippingTerms">25. Shipping Terms</label>
                                    <select class="form-control" id="selcShippingTerms" name="selcShippingTerms"></select>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <i class="fa fa-user-o text-info" aria-hidden="true"></i>
                                    <label for="txtFillName">26. Name of person filling out form</label>
                                    <input type="text" class="form-control required-input" id="txtFillName" name="txtFillName" placeholder="" required="" AutoComplete="off">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <i class="fa fa-address-book-o text-info" aria-hidden="true"></i>
                                            <label for="txtPartyDetails">8.Remarks</label>
                                            <textarea class="form-control" id="txtremarksbox" name="remarks"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="form-row mt-2 mb-3 ml-1">
                                <div id="orderdata">
                                    <button name="addorderdatamodel" id="btnAddOrderDataModel" type="button" class="btn btn-primary" onclick="showModelAddOrderData()">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <table id="CustomerOrderDataTable" class="table table-striped table-bordered dataTable dtr-inline collapsed" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <th>01. Product Type</th>
                                            <th>02. Product Code</th>
                                            <th>03. Product Dimentions</th>
                                            <th>04. Product Mix</th>
                                            <th>05. Washed Level</th>
                                            <th class="disable">06. Is This Product Naked</th>
                                            <th>07. Salb Position</th>
                                            <th>08. Driper Hole</th>
                                            <th>09. No of Driper Holes</th>
                                            <th>10. Drain Holes</th>
                                            <th>11. No of Drain Holes</th>
                                            <th>12. Drain Holes Size</th>
                                            <th>13. DUg Holes</th>
                                            <th>14. No of Dug Holes</th>
                                            <th>15. Dug Holes Size</th>
                                            <th>16. Crop Type vegetable</th>
                                            <th>17. Crop Type berry</th>
                                            <th>18. Crop Type flowers</th>
                                            <th>19. Crop Type PCM_val</th>
                                            <th>20. Crop Type Others</th>
                                            <th>21. Plant Holes</th>
                                            <th>22. No of Holes</th>
                                            <th>23. Plant Holes Size</th>
                                            <th>24. Standing/Lying</th>
                                            <th>25. Bio Degratable Bags</th>
                                            <th>26. Pallets Or Half Pallets</th>
                                            <th>27. Bottom Mesh Liner</th>
                                            <th>28. Boxes / Cases</th>
                                            <th>29. Pcs Per Boxes</th>
                                            <th>30. Boxes Per Pallet</th>
                                            <th>31. Boxes Per Master Cartoon</th>
                                            <th>32. Master Cartoons Per Pallets</th>
                                            <th>33. Quantity</th>
                                            <th class="edit">Edit</th>
                                            <th class="view">View</th>
                                            <th class="delete">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tBodyCustomerOrderList">

                                    </tbody>
                                </table>
                            </div>
                            <br>

                        </div>
                    </div>

                </form>

                <br>

                <div class="form-row mt-2 mb-3 ml-1">
                    <button type="button" id="btnAttachment" class="btn btn-primary" onclick="openModal()">Attachment</button>
                </div>

                <br>

                <div class="row" id='rowAtachmentTable'>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <!-- Required for Responsive -->
                            <table id="myTable" class="table table-striped  datatable">
                                <thead>
                                    <tr>
                                        <th class="thTitle">Title</th>
                                        <th class="thView">View</th>
                                        <th class="thDownload">Down</th>
                                        <th class="thDelete" id="thDelete">Delete</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <br>


                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <button type="button" class="btn btn-warning" id="btnResetOrder">Reset</button>
                        <button type="button" class="btn btn-primary" id="btnSaveOrder">Save</button>
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div id="threadParent" class="col-md-6 mb-3">
                    </div>
                </div>

                <div class="row" id="thradArea">
                    <div class="col-md-6 mb-3">
                        <textarea id="txtOrderThread" class="form-control" style="min-height: 200px;"></textarea>
                        <div style="text-align: right; padding-top:10px;">
                            <button id="btnSubmitThread" type="button" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


<!--Add Order Modal -->

<div class="modal fade" id="addOrderDataModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Customer Order Data</h5>
            </div>
            <div class="modal-body">
                <form method="POST" id="OrderDataForm" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                            <label for="txtProductType">Product Type</label>
                            <input type="hidden" id="hidOrderDataID" name="hidOrderDataID">
                            <input type="text" class="form-control auto-complete" id="txtProductType" name="txtProductType" placeholder="Product Type" AutoComplete="off">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                            <label for="txtProductCode">Product Code</label>
                            <input type="text" class="form-control" id="txtProductCode" name="txtProductCode" placeholder="GB300-030-F" required="" AutoComplete="off">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                            <label for="txtDimensions">Product Dimensions</label>
                            <input type="text" class="form-control" id="txtDimensions" name="txtDimensions" placeholder="50X20X12" required="" AutoComplete="off">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-angle-down text-info" aria-hidden="true"></i>
                            <label for="selcProductMix">Riococo Product Mix</label>
                            <select class="form-control" id="selcProductMix" name="selcProductMix"></select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>
                    {{-- by nipuna start --}}
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-check text-info" aria-hidden="true"></i>
                            <label for="cropTypeCheck">Crop Type</label>
                            <div class="form-check ">
                                <div class="form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="vegetableCheck" id="vegetableCheck">
                                    <label class="form-check-label" for="exampleCheck1">Vegetable</label>
                                </div>
                                <div class="form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="berryCheck" id="berryCheck">
                                    <label class="form-check-label" for="exampleCheck1">Berry</label>
                                </div>
                                <div class="form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="flowersCheck" id="flowersCheck">
                                    <label class="form-check-label" for="exampleCheck1">Flowers</label>
                                </div>
                                <div class="form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="PCMCheck" id="PCMCheck">
                                    <label class="form-check-label" for="exampleCheck1">PCM</label>
                                </div>
                                <div class="form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="OthersCheck" id="OthersCheck">
                                    <label class="form-check-label" for="exampleCheck1">Others</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- by nipuna end --}}

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-angle-down text-info" aria-hidden="true"></i>
                            <label for="selcWashedLevel">Washed Level</label>
                            <select class="form-control" id="selcWashedLevel" name="selcWashedLevel">
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <div class="form-row">
                                <div class="col-md-8">
                                    <i class="fa fa-dot-circle-o text-info" aria-hidden="true"></i>
                                    <label for="txtName">Is this product a naked plank?</label>
                                </div>
                                <div class="col-md-3">
                                    <fieldset id="group1" name="properties[group1]">
                                        <div class="form-check form-check-inline">
                                            <input id="group11" type="radio" value="Yes" name="group1">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input id="group12" type="radio" value="No" name="group1" checked>
                                            <label class="form-check-label" for="inlineRadio2">No</label>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-angle-down text-info" aria-hidden="true"></i>
                            <label for="selcSlabPosition">Slab Position</label>
                            <select class="form-control" id="selcSlabPosition" name="selcSlabPosition">
                                <option value="0">Unspecified</option>
                                <option value="1">Up side up</option>
                                <option value="2">Up side down</option>
                            </select>

                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <i class="fa fa-dot-circle-o text-info" aria-hidden="true"></i>
                                    <label class="mr-5" for="txtName">Dripper Holes</label>
                                </div>
                                <div class="col-md-6">
                                    <fieldset id="group2" name="properties[group2]">
                                        <div class="form-check form-check-inline">
                                            <input id="group21" type="radio" value="Yes" name="group2">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input id="group22" type="radio" value="No" name="group2" checked>
                                            <label class="form-check-label" for="inlineRadio2">No</label>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                            <label for="txtDripperHoles">No of Dripper Holes</label>
                            <input type="text" class="form-control" id="txtDripperHoles" name="txtDripperHoles" placeholder="" required="" AutoComplete="off" disabled>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <i class="fa fa-dot-circle-o text-info" aria-hidden="true"></i>
                                    <label class="mr-5" for="txtName">Drain Holes</label>
                                </div>
                                <div class="col-md-6">
                                    <fieldset id="group3" name="properties[group3]">
                                        <div class="form-check form-check-inline">
                                            <input id="group31" type="radio" value="Yes" name="group3">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input id="group32" type="radio" value="No" name="group3" checked>
                                            <label class="form-check-label" for="inlineRadio2">No</label>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                            <label for="txtDrainHoles">No of Drain Holes</label>
                            <input type="text" class="form-control" id="txtDrainHoles" name="txtDrainHoles" placeholder="" required="" AutoComplete="off" disabled>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                            <label for="txtDrainHolesSize">Drain Holes size</label>
                            <select class="form-control" id="txtDrainHolesSize" name="txtDrainHolesSize" disabled></select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                            <label for="txtDrainHolesSize">Drain Holes shape</label>
                            <select class="form-control" id="txtDrainHolesShape" name="txtDrainHolesShape"></select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                    {{-- bu nipuna start --}}
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <i class="fa fa-dot-circle-o text-info" aria-hidden="true"></i>
                                    <label class="mr-5" for="txtName">Dug Holes</label>
                                </div>
                                <div class="col-md-6">
                                    <fieldset id="group8" name="properties[group8]">
                                        <div class="form-check form-check-inline">
                                            <input id="group81" type="radio" value="Yes" name="group8">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input id="group82" type="radio" value="No" name="group8" checked>
                                            <label class="form-check-label" for="inlineRadio2">No</label>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                            <label for="txtDugHoles">No of Dug Holes</label>
                            <input type="text" class="form-control" id="txtDugHoles" name="txtDugHoles" placeholder="" required="" AutoComplete="off" disabled>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                            <label for="txtDugHolesSize">Dug Holes size</label>
                            <input type="text" class="form-control" id="txtDugHolesSize" name="txtDugHolesSize" placeholder="" required="" AutoComplete="off" disabled>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>
                    {{-- by nipuna end --}}

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <i class="fa fa-dot-circle-o text-info" aria-hidden="true"></i>
                                    <label class="mr-5" for="txtName">Plant Holes</label>
                                </div>
                                <div class="col-md-6">
                                    <fieldset id="group4" name="properties[group4]">
                                        <div class="form-check form-check-inline">
                                            <input id="group41" type="radio" value="Yes" name="group4">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input id="group42" type="radio" value="No" name="group4" checked>
                                            <label class="form-check-label" for="inlineRadio2">No</label>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                            <label for="txtPlantHoles">No of Plant Holes</label>
                            <input type="text" class="form-control" id="txtPlantHoles" name="txtPlantHoles" placeholder="" required="" AutoComplete="off" disabled>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                            <label for="txtPlantHolesSize">Plant Holes size</label>
                            <input type="text" class="form-control" id="txtPlantHolesSize" name="txtPlantHolesSize" placeholder="" required="" AutoComplete="off" disabled>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-angle-down text-info" aria-hidden="true"></i>
                            <label for="selcPlantHoles">Plant Holes Standing / Lying</label>
                            <select class="form-control" id="selcPlantHoles" name="selcPlantHoles" disabled>
                                <option value="0">Unspecified</option>
                                <option value="1">Standing</option>
                                <option value="2">Lying</option>
                                <option value="3">Not Applicable</option>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <i class="fa fa-dot-circle-o text-info" aria-hidden="true"></i>
                                    <label class="mr-5" for="txtName">Bio Degratable Bags ?</label>
                                </div>
                                <div class="col-md-6">
                                    <fieldset id="group5" name="properties[group5]">
                                        <div class="form-check form-check-inline">
                                            <input id="group51" type="radio" value="Yes" name="group5">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input id="group52" type="radio" value="No" name="group5" checked>
                                            <label class="form-check-label" for="inlineRadio2">No</label>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-angle-down text-info" aria-hidden="true"></i>
                            <label for="selcPallet">Pallet or Half Pallet</label>
                            <select class="form-control" id="selcPallet" name="selcPallet">
                                <option value="0">Unspecified</option>
                                <option value="1">Pallet</option>
                                <option value="2">Half Pallet</option>
                            </select>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <i class="fa fa-dot-circle-o text-info" aria-hidden="true"></i>
                                    <label class="mr-5" for="txtName">Bottom Mesh Liner</label>
                                </div>
                                <div class="col-md-6">
                                    <fieldset id="group6" name="properties[group6]">
                                        <div class="form-check form-check-inline">
                                            <input id="group61" type="radio" value="Yes" name="group6">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input id="group62" type="radio" value="No" name="group6" checked>
                                            <label class="form-check-label" for="inlineRadio2">No</label>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <i class="fa fa-dot-circle-o text-info" aria-hidden="true"></i>
                                    <label class="mr-5" for="txtName">Boxes / Cases</label>
                                </div>
                                <div class="col-md-6">
                                    <fieldset id="group7" name="properties[group7]">
                                        <div class="form-check form-check-inline">
                                            <input id="group71" type="radio" value="Yes" name="group7">
                                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input id="group72" type="radio" value="No" name="group7" checked>
                                            <label class="form-check-label" for="inlineRadio2">No</label>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                            <label for="txtPcsPerBoxes">Pcs Per Boxes</label>
                            <input type="text" class="form-control" id="txtPcsPerBoxes" name="txtPcsPerBoxes" placeholder="" required="" AutoComplete="off" disabled>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                            <label for="txtBoxesPallet">Boxes per Pallet</label>
                            <input type="text" class="form-control" id="txtBoxesPallet" name="txtBoxesPallet" placeholder="" required="" AutoComplete="off" disabled>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                            <label for="txtBoxesMasterCartoon">Boxes Per Master Cartoon</label>
                            <input type="text" class="form-control" id="txtBoxesMasterCartoon" name="txtBoxesMasterCartoon" placeholder="" required="" AutoComplete="off" disabled>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                            <label for="txtMasterCartoonPallets">Master Cartoons Per Pallets</label>
                            <input type="text" class="form-control" id="txtMasterCartoonPallets" name="txtMasterCartoonPallets" placeholder="" required="" AutoComplete="off" disabled>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <i class="fa fa-pencil text-info" aria-hidden="true"></i>
                            <label for="txtQtyPieces">Quantity of Pieces</label>
                            <input type="text" class="form-control" id="txtQtyPieces" name="txtQtyPieces" required="" AutoComplete="off">
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" name="saveorderdata" id="btnSaveOrderData" class="btn btn-primary">Save</button>
                <button type="button" name="canceladdorder" id="btnCancelAddOrder" class="btn btn-warning" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>



<!--Attachment-->
<div class="modal fade" id="attachmentAddModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attachmentAddModalTitle">Add attachment here</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>
            <div class="modal-body" id="attachmentAddModalBody">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Description</label>
                        <textarea id="txtDescription" class="form-control" name="description"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label>Attachment</label>
                        <form class="dropzone" method="POST" id="myDropzone" name="myDropzone">
                            @csrf
                            <input type="hidden" id="order_id" name="order_id" value="">
                            <input type="hidden" id="attachmnet_token" name="attachmnet_token" value="">
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close
                    </button>

                </div>
            </div>
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
<script src="{{ url('vendors/dropzone/dropzone.js') }}"></script>

<!-- Javascript -->
<script src="{{ url('vendors/datepicker/daterangepicker.js') }}"></script>
<script src="{{ url('assets/js/autocomplete2/js/autocomplete.min.js') }}?random=<?php echo uniqid(); ?>"></script>
<script src="{{ url('assets/js/rquired_input.min.js') }}?random=<?php echo uniqid(); ?>"></script>
<script src="{{ url('assets/js/progress_widget.js') }}?random=<?php echo uniqid(); ?>"></script>
<script src="{{ url('assets/js/customer_order2.js') }}?random=<?php echo uniqid(); ?>"></script>
<script src="{{ url('assets/js/customer_order_thread.js') }}?random=<?php echo uniqid(); ?>"></script>



<!-- Prism -->
<script src="{{ url('vendors/prism/prism.js') }}"></script>


@endsection