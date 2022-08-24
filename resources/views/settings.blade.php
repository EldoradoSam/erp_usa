@extends('layouts.app')

@section('head')
<!-- Prism -->
<link rel="stylesheet" href="{{ url('vendors/prism/prism.css') }}" type="text/css">
<link href="{{ url('assets/css/settings.css') }}" media="all" rel="stylesheet" type="text/css" />


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
                <h6 class="card-title">Settings</h6>
                <div class="accordion" id="accordionExample">
                    <div class="col-md-12 mb-3">
                        <div class="card ">
                            <div class="card-header" id="headingShippingTerm">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" id="settingsModal" data-toggle="collapse" data-target="#collapseShippingTerm" aria-expanded="false" aria-controls="collapseShippingTerm" onclick="getSettings('ShippingTerm')">
                                        <i class="ti-settings mr-2"></i> Shipping Term
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseShippingTerm" class="collapse" aria-labelledby="headingShippingTerm" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div>
                                        <button type="button" class="btn btn-primary" data-target="#settingsAddModal" data-whatever="@getbootstrap" name="save" onclick="showModal('save','ShippingTerm')">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <!-- Required for Responsive -->
                                        <table class="table table-striped table-responsive-stack">
                                            <thead>
                                                <tr>
                                                    <th class="id">ID#</th>
                                                    <th>Name</th>
                                                    <th class="edit">Edit</th>
                                                    <th class="edit">Delete</th>
                                                    <th class="disable">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tblShippingTerm"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-header" id="headingProductMix">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseProductMix" aria-expanded="false" aria-controls="collapseProductMix" onclick="getSettings('ProductMix')">
                                        <i class="ti-settings mr-2"></i> Product Mix
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseProductMix" class="collapse" aria-labelledby="headingProductMix" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div>
                                        <button type="button" class="btn btn-primary" data-target="#settingsAddModal" data-whatever="@getbootstrap" name="save" onclick="showModal('save','ProductMix')">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <!-- Required for Responsive -->
                                        <table class="table table-striped table-responsive-stack">
                                            <thead>
                                                <tr>
                                                    <th class="id">ID#</th>
                                                    <th>Name</th>
                                                    <th class="edit">Edit</th>
                                                    <th class="edit">Delete</th>
                                                    <th class="disable">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tblProductMix"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-header" id="headingWashedLevel">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseWashedLevel" aria-expanded="false" aria-controls="collapseWashedLevel" onclick="getSettings('WashedLevel')">
                                        <i class="ti-settings mr-2"></i> Washed Level
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseWashedLevel" class="collapse" aria-labelledby="headingWashedLevel" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div>
                                        <button type="button" class="btn btn-primary" data-target="#settingsAddModal" data-whatever="@getbootstrap" name="save" onclick="showModal('save','WashedLevel')">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <!-- Required for Responsive -->
                                        <table class="table table-striped table-responsive-stack">
                                            <thead>
                                                <tr>
                                                    <th class="id">ID#</th>
                                                    <th>Name</th>
                                                    <th class="edit">Edit</th>
                                                    <th class="edit">Delete</th>
                                                    <th class="disable">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tblWashedLevel"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-header" id="headingDrainHoleSize">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseDrainHoleSize" aria-expanded="false" aria-controls="collapseDrainHoleSize" onclick="getSettings('DrainHoleSize')">
                                        <i class="ti-settings mr-2"></i> Drain Hole Size
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseDrainHoleSize" class="collapse" aria-labelledby="headingDrainHoleSize" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div>
                                        <button type="button" class="btn btn-primary" data-target="#settingsAddModal" data-whatever="@getbootstrap" name="save" onclick="showModal('save','DrainHoleSize')">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <!-- Required for Responsive -->
                                        <table class="table table-striped table-responsive-stack">
                                            <thead>
                                                <tr>
                                                    <th class="id">ID#</th>
                                                    <th>Size</th>
                                                    <th class="edit">Edit</th>
                                                    <th class="edit">Delete</th>
                                                    <th class="disable">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tblDrainHoleSize"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-header" id="headingDrainHoleShape">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseDrainHoleShape" aria-expanded="false" aria-controls="collapseDrainHoleShape" onclick="getSettings('DrainHoleShape')">
                                        <i class="ti-settings mr-2"></i> Drain Hole Shape
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseDrainHoleShape" class="collapse" aria-labelledby="headingDrainHoleShape" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div>
                                        <button type="button" class="btn btn-primary" data-target="#settingsAddModal" data-whatever="@getbootstrap" name="save" onclick="showModal('save','DrainHoleShape')">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <!-- Required for Responsive -->
                                        <table class="table table-striped table-responsive-stack">
                                            <thead>
                                                <tr>
                                                    <th class="id">ID#</th>
                                                    <th>Shape</th>
                                                    <th class="edit">Edit</th>
                                                    <th class="edit">Delete</th>
                                                    <th class="disable">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tblDrainHoleShape"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                   <!-- <div class="col-md-12 mb-3">
                        <div class="card">
                            <div class="card-header" id="headingProductSize">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseProductSize" aria-expanded="false" aria-controls="collapseProductSize" onclick="getSettings('ProductSize')">
                                        <i class="ti-settings mr-2"></i> Product Size
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseProductSize" class="collapse" aria-labelledby="headingProductSize" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div>
                                        <button type="button" class="btn btn-primary" data-target="#settingsAddModal" data-whatever="@getbootstrap" name="save" onclick="showModal('save','ProductSize')">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        Required for Responsive 
                                        <table class="table table-striped table-responsive-stack">
                                            <thead>
                                                <tr>
                                                    <th class="id">ID#</th>
                                                    <th>Size</th>
                                                    <th class="edit">Edit</th>
                                                    <th class="edit">Delete</th>
                                                    <th class="disable">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tblProductSize"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>!-->

                    <div class="col-md-12 mb-3">
                        <!--<div class="card">
                            <div class="card-header" id="headingPlantHoleSize">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapsePlantHoleSize" aria-expanded="false" aria-controls="collapsePlantHoleSize" onclick="getSettings('PlantHoleSize')">
                                        <i class="ti-settings mr-2"></i> Plant Hole Size
                                    </button>
                                </h5>
                            </div>
                            <div id="collapsePlantHoleSize" class="collapse" aria-labelledby="headingPlantHoleSize" data-parent="#accordionExample">
                                <div class="card-body">
                                    <div>
                                        <button type="button" class="btn btn-primary" data-target="#settingsAddModal" data-whatever="@getbootstrap" name="save" onclick="showModal('save','PlantHoleSize')">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-responsive-stack">
                                            <thead>
                                                <tr>
                                                    <th class="id">ID#</th>
                                                    <th>Name</th>
                                                    <th class="edit">Edit</th>
                                                    <th class="edit">Delete</th>
                                                    <th class="disable">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tblPlantHoleSize"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>!-->
                    </div>


    <div class="modal fade" id="settingsAddModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="settingsAddModalTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="ti-close"></i>
                    </button>
                </div>
                <form method="POST" id="myForm">
                    {{csrf_field()}}
                    <input type="hidden" id="settingID" name="settingID" value>
                    <div class="modal-body" id="settingsAddModalBody">
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="txtName">Name</label>
                                <input type="text" class="form-control" id="txtSettingName" name="txtSettingName" placeholder="Name" required="">
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
</div>


@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('script')
<!-- App scripts -->
<script src="{{ url('assets/js/settings.js') }}?random=<?php echo uniqid(); ?>"></script>
<!-- Sweet alert -->
<script src="{{ url('assets/js/examples/sweet-alert.js') }}"></script>
<!-- Prism -->
<script src="{{ url('vendors/prism/prism.js') }}"></script>
@endsection
