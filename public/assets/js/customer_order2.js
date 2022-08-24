var CUSTOMER_ID = undefined;
var FORM_ACTION = 'SAVE';
var UPDATE_ORDER_ID = undefined;
var UPDATE_ORDER_DATA_ID = undefined;
var ACTION = 'Save';
const TOKEN = Math.floor(Math.random() * 212345);
var ORDER_DATA_RADIO_VAL = {

    "NAKED_PLANK": false,
    "DRIPPER_HOLES": false,
    "DRAIN_HOLES": false,
    "DUG_HOLES": false,
    "PLANT_HOLES": false,
    "BAGS": false,
    "MESH_LINER": false,
    "BOXES": false,
};

var ORDER_DATA = [];
const RADIO_VAL = {
    true: "Yes",
    false: "No",
    1: "Yes",
    0: "No"
};

var RADIO_SERVER_VAL = {
    true: 1,
    false: 0,
};

$(document).ready(function () {
    allCustomer();
    allCountries();
    allShippingTerms();
    allDrainHoleSize();
    allDrainHoleShape();
    allProductMix();
    allWashedLevel();

    $('#attachmnet_token').val(TOKEN);

    $('#myTable').DataTable({
        responsive: true,
        "order": [],
        "columns": [
            { "data": "file" },
            { "data": "view" },
            { "data": "download" },
            { "data": "delete" },
        ],
    });



    $('#CustomerOrderDataTable').DataTable({
        responsive: true,
        scrollX: true,
        paging: false,
        "order": [],
        "columns": [
            { "data": "product_type" },
            { "data": "product_code" },
            { "data": "product_dimensions" },
            { "data": "product_mix_id" },
            { "data": "washed_level_id" },
            { "data": "naked_plank" },
            { "data": "slab_position" },
            { "data": "dripper_holes" },
            { "data": "no_of_dripper" },
            { "data": "drain_holes" },
            { "data": "no_of_drain" },
            { "data": "drain_holes_size" },
            { "data": "dug_holes" },
            { "data": "no_of_dug" },
            { "data": "dug_holes_size" },
            { "data": "vegetableCheck" },
            { "data": "berryCheck" },
            { "data": "flowersCheck" },
            { "data": "PCMCheck" },
            { "data": "OthersCheck" },
            { "data": "plant_holes" },
            { "data": "no_of_plant" },
            { "data": "plant_holes_size" },
            { "data": "standing_Lying" },
            { "data": "Bio_Degratable_Bags" },
            { "data": "pallet" },
            { "data": "Bottom_Mesh_Liner" },
            { "data": "Boxes_Cases" },
            { "data": "pcs_per_boxes" },
            { "data": "boxes_pallet" },
            { "data": "boxes_master_cartoon" },
            { "data": "master_cartoon_pallets" },
            { "data": "quantity_pieces" },
            { "data": "edit", className: "edit" },
            { "data": "view", className: "view" },
            { "data": "delete", className: "delete" },



        ],
    });


    /**
   * datepicker
   * This is jquery for datepicker .
   */
    $('input[name="dteDate"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: false
    }).on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
    });

    /**
    * datepicker
    * This is jquery for datepicker .
    */
    $('input[name="dteDeliveryDate"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: false
    }).on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
    });

    let today = new Date().toISOString().substr(0, 10);
    document.querySelector("#dteDate").value = today;
    document.querySelector("#dteDeliveryDate").value = today;



    if (window.location.search.length > 0) {
        var sPageURL = window.location.search.substring(1);
        var param = sPageURL.split('?');
        var id = param[0].split('=')[1].split('&')[0];
        checkOrderStatus(id);
        UPDATE_ORDER_ID = id;
        ACTION = param[0].split('=')[2].split('&')[0];
        if (ACTION == 'edit') {
            if(user_type == 'USA OFFiCE'){
                $('#actionArea').hide();
            }
            getCustomerMainOrder(id);
            $('#btnSaveOrder').text('Update');
        } else if (ACTION == 'view') {
            getCustomerMainOrder(id);
            $('#btnSaveOrder').hide();
        }


    }




    $('#btnAddOrderDataModel').on('click', function () {
        showModal();
    });



    ///////////////////////////////////////////////////

    $('#group11').on('change', function () {
        var bool = $(this).is(':checked');
        ORDER_DATA_RADIO_VAL.NAKED_PLANK = bool;
        disableOrderDataInputs();
    });

    $('#group12').on('change', function () {
        var bool = $(this).is(':checked');
        ORDER_DATA_RADIO_VAL.NAKED_PLANK = !bool;
        disableOrderDataInputs();
    });

    ////////////////////////////////////////////////////

    $('#group21').on('change', function () {
        var bool = $(this).is(':checked');
        ORDER_DATA_RADIO_VAL.DRIPPER_HOLES = bool;
        disableOrderDataInputs();
    });

    $('#group22').on('change', function () {
        var bool = $(this).is(':checked');
        ORDER_DATA_RADIO_VAL.DRIPPER_HOLES = !bool;
        disableOrderDataInputs();
    });

    ////////////////////////////////////////////////////

    $('#group31').on('change', function () {
        var bool = $(this).is(':checked');
        ORDER_DATA_RADIO_VAL.DRAIN_HOLES = bool;
        disableOrderDataInputs();
    });

    $('#group32').on('change', function () {
        var bool = $(this).is(':checked');
        ORDER_DATA_RADIO_VAL.DRAIN_HOLES = !bool;
        disableOrderDataInputs();
    });

    ////////////////////////////////////////////////////

    $('#group81').on('change', function () {
        var bool = $(this).is(':checked');
        ORDER_DATA_RADIO_VAL.DUG_HOLES = bool;
        disableOrderDataInputs();
    });

    $('#group82').on('change', function () {
        var bool = $(this).is(':checked');
        ORDER_DATA_RADIO_VAL.DUG_HOLES = !bool;
        disableOrderDataInputs();
    });

    ////////////////////////////////////////////////////

    $('#group41').on('change', function () {
        var bool = $(this).is(':checked');
        ORDER_DATA_RADIO_VAL.PLANT_HOLES = bool;
        disableOrderDataInputs();
    });

    $('#group42').on('change', function () {
        var bool = $(this).is(':checked');
        ORDER_DATA_RADIO_VAL.PLANT_HOLES = !bool;
        disableOrderDataInputs();
    });

    ////////////////////////////////////////////////////

    $('#group51').on('change', function () {
        var bool = $(this).is(':checked');
        ORDER_DATA_RADIO_VAL.BAGS = bool;
        disableOrderDataInputs();
    });

    $('#group52').on('change', function () {
        var bool = $(this).is(':checked');
        ORDER_DATA_RADIO_VAL.BAGS = !bool;
        disableOrderDataInputs();
    });

    ////////////////////////////////////////////////////

    $('#group61').on('change', function () {
        var bool = $(this).is(':checked');
        ORDER_DATA_RADIO_VAL.MESH_LINER = bool;
        disableOrderDataInputs();
    });

    $('#group62').on('change', function () {
        var bool = $(this).is(':checked');
        ORDER_DATA_RADIO_VAL.MESH_LINER = !bool;
        disableOrderDataInputs();
    });

    ////////////////////////////////////////////////////

    $('#group71').on('change', function () {
        var bool = $(this).is(':checked');
        ORDER_DATA_RADIO_VAL.BOXES = bool;
        disableOrderDataInputs();
    });

    $('#group72').on('change', function () {
        var bool = $(this).is(':checked');
        ORDER_DATA_RADIO_VAL.BOXES = !bool;
        disableOrderDataInputs();
    });

    ////////////////////////////////////////////////////



    $('#btnSaveOrderData').on('click', function () {
        if ($('#txtProductType').val() == "") {
            $('#txtProductType').focus();
            showWarningMessage("Please enter product type");
            return;
        }
        if ($('#txtProductCode').val() == "") {
            $('#txtProductCode').focus();
            showWarningMessage("Please enter product code");
            return;
        }
        if ($('#txtDimensions').val() == "") {
            $('#txtDimensions').focus();
            showWarningMessage("Please enter product dimension");
            return;
        }
        if ($('#txtQtyPieces').val() == "") {
            $('#txtQtyPieces').focus();
            showWarningMessage("Please enter product quentity pieces");
            return;
        }
        if ($('#btnSaveOrderData').text() == 'Save') {
            saveOrderData();
        } else if ($('#btnSaveOrderData').text() == 'Update') {
            if (UPDATE_ORDER_DATA_ID != undefined) {
                updateOrderData();
            } else {
                showWarningMessage("Please select an order data...!");
            }

        }




    });










    $('#btnSaveOrder').on('click', function () {

        if (isRequiredInputs()) {
            if ($('#btnSaveOrder').text() == "Save") {
                saveCustomerOrder();
            } else if ($('#btnSaveOrder').text() == "Update") {
                updateCustomerOrder();
            }
        }

    });

    $('#btnAttachment').on('click', function () {
        if (CUSTOMER_ID != undefined) {
            $('#attachmentAddModal').modal('toggle');
            return;
        }
        showWarningMessage('Please select customer...!');
    });


    $('#btnResetOrder').on('click', function () {
        location.href = '/customerOrder';
    });

    disableOrderDataInputs();



});


Dropzone.options.myDropzone = {
    dictDefaultMessage: 'Drop file here or click to upload!!!!!!!!',
    method: 'POST',
    url: '/customerOrder/uploadAttachment',
    params: {
        description: "abc"
    },
    addRemoveLinks: true,
    uploadMultiple: false,
    clickable: true,

    /*init: function () {
        this.on("complete", function (file) {
            $('#attachmentAddModal').modal('hide');
            allAttachment(UPDATE_ORDER_ID);
        });
    }*/



    init: function () {
        var myDropzone = this;

        // Here's the change from enyo's tutorial...

        $("#submit-all").click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            myDropzone.processQueue();
        }
        );

        this.on("sending", function (file, xhr, formData) {

            // Will sendthe filesize along with the file as POST data.

            formData.append("foo", $('#txtDescription').val());

        });

        this.on("success", function(file, responseText) {
            var responseText = file.id // or however you would point to your assigned file ID here;
            console.log(responseText); // console should show the ID you pointed to
            // do stuff with file.id ...
            //alert();
        });

        this.on("addedfile", file => {
            console.log(file);
        });

        this.on("complete", function (file) {
            this.removeAllFiles(true);
            $('#txtDescription').val("");
            $('#attachmentAddModal').modal('hide');
            allAttachment(UPDATE_ORDER_ID);
            console.log(file);
        });

        this.on("errormultiple", function (files, response) {
          
        });
    }
};



function allCustomer() {
    $.ajax({
        type: "GET",
        url: "/customerOrder/allCustomer",
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                $('#txtName').setData(response.data.result)
            } else {
                showErrorMessage();
            }

        },
        error: function (error) {
            console.log(error);

        },

    });
}



function allAttachment(id) {
    $.ajax({
        type: "GET",
        url: "/customerOrder/allAttachment/" + id,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                var result = response.data.result;
                var data = [];
                for (var i = 0; i < result.length; i++) {
                    var path = "'" + result[i].file_path + "'";
                    var id = "'" + result[i].id + "'";
                    data.push({
                        "file": result[i].description,
                        "view": '<button type= "button" class="btn btn-primary" onclick="viewAttachment(' + path + ');"><i class="fa fa-eye" aria-hidden="true"></i></button> ',
                        "download": '<button type= "button" class="btn btn-success" onclick="downloadAttachment(' + path + ');"><i class="fa fa-download" aria-hidden="true"></i></button> ',
                        "delete": '<button type= "button" class="btn btn-danger" onclick="deleteAttachment(' + id + ');"><i class="fa fa-trash" aria-hidden="true"></i></button> ',
                    });
                }
                var table = $('#myTable').DataTable();
                table.clear();
                table.rows.add(data).draw();
            } else {
                showErrorMessage();
            }

        },
        error: function (error) {
            console.log(error);

        },

    });
}



function autoCompleteSelectedOption(input, data) {
    if (input.id == "txtName") {
        resetOrderData();
        loadSelectedCustomerdata(data.id);
    } else if (input.id == "txtProductType") {
        getCustomerOrderData(data.id);
    }

}


function loadSelectedCustomerdata(id) {
    $.ajax({
        type: "GET",
        url: "/customerOrder/getCustomer/" + id,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                console.log(response.data.result);
                CUSTOMER_ID = response.data.result.customer_id;
                var adress = response.data.result['address'];
                var delivery_address = response.data.result['delivery_address'];
                var cosignee_details = response.data.result['cosignee_details'];
                var party_details = response.data.result['party_details'];

                var name = response.data.result['customer_name'];


                $('#txtBillAddress').val(adress);
                $('#txtDeliveryAddress').val(delivery_address);
                $('#txtCosigneeDetails').val(cosignee_details);
                $('#txtPartyDetails').val(party_details);

                $('#txtFillName').val(name);



            } else {
                showErrorMessage(response.data.result);
            }

        },
        error: function (error) {
            console.log(error);

        },

    });
}



function allCountries() {
    $.ajax({
        type: "GET",
        url: "/customerOrder/allCountries",
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            for (var i = 0; i < response.data.result.length; i++) {
                $('#cmbCountry').append('<option value="' + response.data.result[i]['country_id'] + '">' + response.data.result[i]['country_name'] + '</option>');
            }
        },
        error: function (error) {
            console.log(error);

        },

    });
}


function allShippingTerms() {
    $.ajax({
        type: "GET",
        url: "/customerOrder/allShippingTerms",
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            $('#selcShippingTerms').append('<option value="0">Unspecified</option>');
            for (var i = 0; i < response.data.result.length; i++) {
                $('#selcShippingTerms').append('<option value="' + response.data.result[i]['shipping_term_id'] + '">' + response.data.result[i]['shipping_term'] + '</option>');
            }
        },
        error: function (error) {
            console.log(error);

        },

    });
}



function showModal() {
    if (CUSTOMER_ID != undefined) {
        getCustomerAllOrderData($('#txtName').attr('data-id'));
        resetOrderData();
        $('#addOrderDataModal').modal('toggle');
        return;
    }
    showWarningMessage('Please select customer...!');
}



function disableOrderDataInputs() {

    console.log(ORDER_DATA_RADIO_VAL);

    ////////////////////////////////////////////////////////

    $('#group11').attr("checked", ORDER_DATA_RADIO_VAL.NAKED_PLANK);
    $('#group12').attr("checked", !ORDER_DATA_RADIO_VAL.NAKED_PLANK);

    /////////////////////////////////////////////////////////

    $('#group21').attr("checked", ORDER_DATA_RADIO_VAL.DRIPPER_HOLES);
    $('#group22').attr("checked", !ORDER_DATA_RADIO_VAL.DRIPPER_HOLES);
    $('#txtDripperHoles').attr("disabled", !ORDER_DATA_RADIO_VAL.DRIPPER_HOLES);
    if (!ORDER_DATA_RADIO_VAL.DRIPPER_HOLES) {
        $('#txtDripperHoles').val("0");
    }

    /////////////////////////////////////////////////////////

    $('#group31').attr("checked", ORDER_DATA_RADIO_VAL.DRAIN_HOLES);
    $('#group32').attr("checked", !ORDER_DATA_RADIO_VAL.DRAIN_HOLES);
    $('#txtDrainHoles').attr("disabled", !ORDER_DATA_RADIO_VAL.DRAIN_HOLES);
    $('#txtDrainHolesSize').attr("disabled", !ORDER_DATA_RADIO_VAL.DRAIN_HOLES);
    if (!ORDER_DATA_RADIO_VAL.DRAIN_HOLES) {
        $('#txtDrainHoles').val("0");
        setSelectedOption('txtDrainHolesSize', 0);
    }


    /////////////////////////////////////////////////////////

    $('#group81').attr("checked", ORDER_DATA_RADIO_VAL.DUG_HOLES);
    $('#group82').attr("checked", !ORDER_DATA_RADIO_VAL.DUG_HOLES);
    $('#txtDugHoles').attr("disabled", !ORDER_DATA_RADIO_VAL.DUG_HOLES);
    $('#txtDugHolesSize').attr("disabled", !ORDER_DATA_RADIO_VAL.DUG_HOLES);
    if (!ORDER_DATA_RADIO_VAL.DUG_HOLES) {
        $('#txtDugHoles').val("0");
        $('#txtDugHolesSize').val("0");
    }


    /////////////////////////////////////////////////////////

    $('#group41').attr("checked", ORDER_DATA_RADIO_VAL.PLANT_HOLES);
    $('#group42').attr("checked", !ORDER_DATA_RADIO_VAL.PLANT_HOLES);
    $('#txtPlantHoles').attr("disabled", !ORDER_DATA_RADIO_VAL.PLANT_HOLES);
    $('#txtPlantHolesSize').attr("disabled", !ORDER_DATA_RADIO_VAL.PLANT_HOLES);
    $('#selcPlantHoles').attr("disabled", !ORDER_DATA_RADIO_VAL.PLANT_HOLES);
    if (!ORDER_DATA_RADIO_VAL.PLANT_HOLES) {
        $('#txtPlantHoles').val("0");
        $('#txtPlantHolesSize').val("0");
        setSelectedOption('selcPlantHoles', 0);

    }

    /////////////////////////////////////////////////////////

    $('#group51').attr("checked", ORDER_DATA_RADIO_VAL.BAGS);
    $('#group52').attr("checked", !ORDER_DATA_RADIO_VAL.BAGS);

    /////////////////////////////////////////////////////////

    $('#group61').attr("checked", ORDER_DATA_RADIO_VAL.MESH_LINER);
    $('#group62').attr("checked", !ORDER_DATA_RADIO_VAL.MESH_LINER);

    /////////////////////////////////////////////////////////

    $('#group71').attr("checked", ORDER_DATA_RADIO_VAL.BOXES);
    $('#group72').attr("checked", !ORDER_DATA_RADIO_VAL.BOXES);
    $('#txtPcsPerBoxes').attr("disabled", !ORDER_DATA_RADIO_VAL.BOXES);
    $('#txtBoxesPallet').attr("disabled", !ORDER_DATA_RADIO_VAL.BOXES);
    $('#txtBoxesMasterCartoon').attr("disabled", !ORDER_DATA_RADIO_VAL.BOXES);
    $('#txtMasterCartoonPallets').attr("disabled", !ORDER_DATA_RADIO_VAL.BOXES);
    if (!ORDER_DATA_RADIO_VAL.BOXES) {
        $('#txtPcsPerBoxes').val("0");
        $('#txtBoxesPallet').val("0");
        $('#txtBoxesMasterCartoon').val("0");
        $('#txtMasterCartoonPallets').val("0");
    }

    /////////////////////////////////////////////////////////





}





function allDrainHoleSize() {
    $.ajax({
        type: "GET",
        url: "/customerOrder/allDrainHoleSize",
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                var result = response.data.result;
                $('#txtDrainHolesSize').empty();
                $('#txtDrainHolesSize').append('<option value="0">Unspecified</option>');
                for (var i = 0; i < result.length; i++) {
                    $('#txtDrainHolesSize').append('<option value="' + result[i].drain_hole_size_id + '">' + result[i].size + '</option>')
                }
            } else {
                showErrorMessage();
            }

        },
        error: function (error) {
            console.log(error);

        },

    });
}



function allDrainHoleShape() {
    $.ajax({
        type: "GET",
        url: "/customerOrder/allDrainHoleShape",
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                var result = response.data.result;
                $('#txtDrainHolesShape').empty();
                $('#txtDrainHolesShape').append('<option value="0">Unspecified</option>');
                for (var i = 0; i < result.length; i++) {
                    $('#txtDrainHolesShape').append('<option value="' + result[i].drain_hole_shape_id + '">' + result[i].shape + '</option>')
                }
            } else {
                showErrorMessage();
            }

        },
        error: function (error) {
            console.log(error);

        },

    });
}



function allProductMix() {
    $.ajax({
        type: "GET",
        url: "/customerOrder/allProductMix",
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                var result = response.data.result;
                $('#selcProductMix').empty();
                //$('#selcProductMix').append('<option value="0">Unspecified</option>');
                for (var i = 0; i < result.length; i++) {
                    $('#selcProductMix').append('<option value="' + result[i].product_mix_id + '">' + result[i].product_mix + '</option>')
                }
            } else {
                showErrorMessage();
            }

        },
        error: function (error) {
            console.log(error);

        },

    });
}





function allWashedLevel() {
    $.ajax({
        type: "GET",
        url: "/customerOrder/allWashedLevel",
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                var result = response.data.result;
                $('#selcWashedLevel').empty();
                $('#selcWashedLevel').append('<option value="0">Unspecified</option>');
                for (var i = 0; i < result.length; i++) {
                    $('#selcWashedLevel').append('<option value="' + result[i].washed_level_id + '">' + result[i].washed_level + '</option>')
                }
            } else {
                showErrorMessage();
            }

        },
        error: function (error) {
            console.log(error);

        },

    });
}



function saveOrderData() {

    var data = {
        "token": TOKEN,
        "product_type": $('#txtProductType').val(),
        "product_code": $('#txtProductCode').val(),
        "product_dimension": $('#txtDimensions').val(),
        "product_mix_name": $('#selcProductMix option:selected').text(),
        "product_mix_id": $('#selcProductMix').val(),
        "naked_plank": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL.NAKED_PLANK],
        "vegetable": RADIO_SERVER_VAL[$('#vegetableCheck').is(':checked')],
        "berry": RADIO_SERVER_VAL[$('#berryCheck').is(':checked')],
        "flowers": RADIO_SERVER_VAL[$('#flowersCheck').is(':checked')],
        "pcm": RADIO_SERVER_VAL[$('#PCMCheck').is(':checked')],
        "others": RADIO_SERVER_VAL[$('#OthersCheck').is(':checked')],
        "washed_level_name": $('#selcWashedLevel option:selected').text(),
        "washed_level_id": $('#selcWashedLevel').val(),
        "slab_psition_name": $('#selcSlabPosition option:selected').text(),
        "slab_psition_id": $('#selcSlabPosition').val(),
        "dripper_holes": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL.DRIPPER_HOLES],
        "dripper_holes_no": $('#txtDripperHoles').val(),
        "drain_holes": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL.DRAIN_HOLES],
        "drain_holes_no": $('#txtDrainHoles').val(),
        "drain_holes_size_name": $('#txtDrainHolesSize option:selected').text(),
        "drain_holes_size_id": $('#txtDrainHolesSize').val(),
        "drain_holes_shape_name": $('#txtDrainHolesShape option:selected').text(),
        "drain_holes_shape_id": $('#txtDrainHolesShape').val(),
        "dug_holes": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL.DUG_HOLES],
        "dug_holes_no": $('#txtDugHoles').val(),
        "dug_holes_size": $('#txtDugHolesSize').val(),
        "plant_holes": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL.PLANT_HOLES],
        "plant_holes_no": $('#txtPlantHoles').val(),
        "plant_holes_size": $('#txtPlantHolesSize').val(),
        "plant_holes_standing_lying_name": $('#selcPlantHoles option:selected').text(),
        "plant_holes_standing_lying_id": $('#selcPlantHoles').val(),
        "bags": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL.BAGS],
        "mesh_liner": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL.MESH_LINER],
        "pallet_name": $('#selcPallet option:selected').text(),
        "pallet_id": $('#selcPallet').val(),
        "boxes_cases": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL.BOXES],
        "pcs_boxes": $('#txtPcsPerBoxes').val(),
        "boxess_pallet": $('#txtBoxesPallet').val(),
        "boxess_cartoon": $('#txtBoxesMasterCartoon').val(),
        "master_pallet": $('#txtMasterCartoonPallets').val(),
        "quantity": $('#txtQtyPieces').val(),
        "radio_value": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL],
    };




    $.ajax({
        type: "POST",
        url: '/customerOrder/saveOrderData',
        data: {
            'order_data': JSON.stringify(data),
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        timeout: 800000,
        beforeSend: function () {
        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                toastr.success('Customer data has been saved successful...!');
                allOrderDataWithToken(UPDATE_ORDER_ID, TOKEN);
                resetOrderData();
            } else {
                toastr.error('Something went wrong');
            }


        },
        error: function (error) {
            console.log(error);
            toastr.error('Something went wrong');
        },
        complete: function () {
        }

    });
}



function setSelectedOption(id, valueToSelect) {
    let element = document.getElementById(id);
    element.value = valueToSelect;
}


function resetOrderData() {
    $('#OrderDataForm').trigger("reset");
    ORDER_DATA_RADIO_VAL.NAKED_PLANK = false;
    ORDER_DATA_RADIO_VAL.DRIPPER_HOLES = false;
    ORDER_DATA_RADIO_VAL.DRAIN_HOLES = false;
    ORDER_DATA_RADIO_VAL.DUG_HOLES = false;
    ORDER_DATA_RADIO_VAL.PLANT_HOLES = false;
    ORDER_DATA_RADIO_VAL.BAGS = false;
    ORDER_DATA_RADIO_VAL.MESH_LINER = false;
    ORDER_DATA_RADIO_VAL.BOXES = false;
    $('#vegetableCheck').attr('checked', false);
    $('#berryCheck').attr('checked', false);
    $('#flowersCheck').attr('checked', false);
    $('#PCMCheck').attr('checked', false);
    $('#OthersCheck').attr('checked', false);
    disableOrderDataInputs();
    $('#addOrderDataModal').modal('hide');
    $('#btnSaveOrderData').text('Save');
    $('#btnSaveOrderData').show();
}



function resetAttachment() {
    var table = $('#myTable').DataTable();
    table.clear();
}






function allOrderDataWithToken(id, token) {
    $.ajax({
        type: "GET",
        url: "/customerOrder/allOrderDataWithToken/" + id + "/" + token,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);

            var data = [];
            var result = response.data.result;
            for (var i = 0; i < result.length; i++) {
                var string_id = "'" + result[i].order_data_id + "'";
                setSelectedOption('selcProductMix', result[i].product_mix_id);
                setSelectedOption('selcWashedLevel', result[i].washed_level_id);
                setSelectedOption('selcSlabPosition', result[i].slab_position);
                setSelectedOption('selcPlantHoles', result[i].standing_Lying);
                setSelectedOption('selcPallet', result[i].pallet);
                result[i].product_mix_id = $('#selcProductMix option:selected').text();
                result[i].washed_level_id = $('#selcWashedLevel option:selected').text();
                result[i].naked_plank = RADIO_VAL[result[i].naked_plank];
                result[i].slab_position = $('#selcSlabPosition option:selected').text();
                result[i].dripper_holes = RADIO_VAL[result[i].dripper_holes];
                result[i].drain_holes = RADIO_VAL[result[i].drain_holes];
                result[i].dug_holes = RADIO_VAL[result[i].dug_holes];
                result[i].standing_Lying = $('#selcPlantHoles option:selected').text();
                result[i].pallet = $('#selcPallet option:selected').text();
                result[i].plant_holes = RADIO_VAL[result[i].plant_holes];
                result[i].Bio_Degratable_Bags = RADIO_VAL[result[i].Bio_Degratable_Bags];
                result[i].Bottom_Mesh_Liner = RADIO_VAL[result[i].Bottom_Mesh_Liner];
                result[i].Boxes_Cases = RADIO_VAL[result[i].Boxes_Cases];
                result[i].edit = '<button type="button" class="btn btn-warning mr-4 ml-2 btn-edit" id="' + result[i].order_data_id + '"  onclick="editOrderData(' + string_id + ')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
                result[i].view = '<button type="button" class="btn btn-success mr-4 btn-view" id="' + result[i].order_data_id + '"   onclick="viewOrderData(' + string_id + ')"><i class="fa fa-eye" aria-hidden="true"></i></button>';
                result[i].delete = '<button type="button" class="btn btn-danger mr-4 btn-delete" id="' + result[i].order_data_id + '" onclick="deleteOrderData(' + string_id + ')" ><i class="fa fa-trash" aria-hidden="true"></i></button>';
                data.push(
                    result[i]
                );
            }

            var table = $('#CustomerOrderDataTable').DataTable();
            //table.clear();
            table.rows.add(data).draw();


        },
        error: function (error) {
            console.log(error);

        },

    });
}




function allOrderData(id) {
    $.ajax({
        type: "GET",
        url: "/customerOrder/allOrderData/" + id,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);

            var data = [];
            var result = response.data.result;
            for (var i = 0; i < result.length; i++) {
                var string_id = "'" + result[i].order_data_id + "'";
                setSelectedOption('selcProductMix', result[i].product_mix_id);
                setSelectedOption('selcWashedLevel', result[i].washed_level_id);
                setSelectedOption('selcSlabPosition', result[i].slab_position);
                setSelectedOption('selcPlantHoles', result[i].standing_Lying);
                setSelectedOption('selcPallet', result[i].pallet);
                result[i].product_mix_id = $('#selcProductMix option:selected').text();
                result[i].washed_level_id = $('#selcWashedLevel option:selected').text();
                result[i].naked_plank = RADIO_VAL[result[i].naked_plank];
                result[i].slab_position = $('#selcSlabPosition option:selected').text();
                result[i].dripper_holes = RADIO_VAL[result[i].dripper_holes];
                result[i].drain_holes = RADIO_VAL[result[i].drain_holes];
                result[i].dug_holes = RADIO_VAL[result[i].dug_holes];
                result[i].standing_Lying = $('#selcPlantHoles option:selected').text();
                result[i].pallet = $('#selcPallet option:selected').text();
                result[i].plant_holes = RADIO_VAL[result[i].plant_holes];
                result[i].Bio_Degratable_Bags = RADIO_VAL[result[i].Bio_Degratable_Bags];
                result[i].Bottom_Mesh_Liner = RADIO_VAL[result[i].Bottom_Mesh_Liner];
                result[i].Boxes_Cases = RADIO_VAL[result[i].Boxes_Cases];
                result[i].edit = '<button type="button" class="btn btn-warning mr-4 ml-2 btn-edit" id="' + result[i].order_data_id + '"  onclick="editOrderData(' + string_id + ')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
                result[i].view = '<button type="button" class="btn btn-success mr-4 btn-view" id="' + result[i].order_data_id + '"   onclick="viewOrderData(' + string_id + ')"><i class="fa fa-eye" aria-hidden="true"></i></button>';
                result[i].delete = '<button type="button" class="btn btn-danger mr-4 btn-delete" id="' + result[i].order_data_id + '" onclick="deleteOrderData(' + string_id + ')" ><i class="fa fa-trash" aria-hidden="true"></i></button>';
                data.push(
                    result[i]
                );
            }

            var table = $('#CustomerOrderDataTable').DataTable();
            table.clear();
            table.rows.add(data).draw();


        },
        error: function (error) {
            console.log(error);

        },

    });
}




function saveCustomerOrder() {
    var data = {
        "token": TOKEN,
        "customer_id": $('#txtName').attr('data-id'),
        "customer_name": $('#txtName').val(),
        "purchase_order": $('#txtPurchase').val(),
        "factory_po_num": $('#txtFactoryPo').val(),
        "invoice_num": $('#txtInvoiceNumber').val(),
        "bill_address": $('#txtBillAddress').val(),
        "delivery_address": $('#txtDeliveryAddress').val(),
        "cosignee_details": $('#txtCosigneeDetails').val(),
        "party_details": $('#txtPartyDetails').val(),
        "country_id": $('#cmbCountry').val(),
        "date": $('#dteDate').val(),
        "delivery_date": $('#dteDeliveryDate').val(),
        "shipping_term_id": $('#selcShippingTerms').val(),
        "name_fill": $('#txtFillName').val(),
        "remarks": $('#txtremarksbox').val(),
        "production_status": false,
        "status": true,
    };
    $.ajax({
        type: "POST",
        url: '/customerOrder/saveCustomerOrder',
        data: {
            'order': JSON.stringify(data),
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        timeout: 800000,
        beforeSend: function () {
        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                toastr.success('Customer data has been saved successful...!');
                allOrderData();
                resetOrderData();
                resetAttachment();
                location.href = '/customerOrder';
                $('#orderForm').trigger('reset');
            } else {
                toastr.error('Something went wrong');
            }


        },
        error: function (error) {
            console.log(error);
            toastr.error('Something went wrong');
        },
        complete: function () {
        }

    });
}



function getCustomerAllOrderData(id) {
    $.ajax({
        type: "GET",
        url: "/customerOrder/getCustomerAllOrderData/" + id,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                $('#txtProductType').setData(response.data.result);
            } else {
                showErrorMessage();
            }

        },
        error: function (error) {
            console.log(error);

        },

    });
}




function editOrderData(id) {
    resetOrderData();
    showModal();
    $('#btnSaveOrderData').text('Update');
    UPDATE_ORDER_DATA_ID = id;
    getCustomerOrderData(id);
}


function viewOrderData(id) {
    resetOrderData();
    showModal();
    $('#btnSaveOrderData').hide();
    UPDATE_ORDER_DATA_ID = id;
    getCustomerOrderData(id);
}


function deleteOrderData(id) {

    $.ajax({
        type: 'DELETE',
        url: '/customerOrder/deleteOrderData/' + id,
        data: {
            _token: $('input[name=_token]').val()
        },
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                showSuccessMessage("Order Data has been deleted successfully...")
                allOrderData(UPDATE_ORDER_ID);
            } else {
                showErrorMessage();
            }
        },
        error: function (error) {
            console.log(error);
            showErrorMessage();
        },
        complete: function () {

        }

    });
}



function getCustomerOrderData(id) {
    $.ajax({
        type: "GET",
        url: "/customerOrder/getCustomerOrderData/" + id,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                setOrderData(response.data.result);

            } else {
                showErrorMessage();
            }

        },
        error: function (error) {
            console.log(error);

        },

    });
}



function setOrderData(data) {

    var bool_val = {
        0: false,
        1: true,
    }
    ORDER_DATA_RADIO_VAL.NAKED_PLANK = bool_val[data.naked_plank];
    ORDER_DATA_RADIO_VAL.DRIPPER_HOLES = bool_val[data.dripper_holes];
    ORDER_DATA_RADIO_VAL.DRAIN_HOLES = bool_val[data.drain_holes];
    ORDER_DATA_RADIO_VAL.DUG_HOLES = bool_val[data.dug_holes];
    ORDER_DATA_RADIO_VAL.PLANT_HOLES = bool_val[data.plant_holes];
    ORDER_DATA_RADIO_VAL.BAGS = bool_val[data.Bio_Degratable_Bags];
    ORDER_DATA_RADIO_VAL.MESH_LINER = bool_val[data.Bottom_Mesh_Liner];
    ORDER_DATA_RADIO_VAL.BOXES = bool_val[data.Boxes_Cases];
    disableOrderDataInputs();


    $('#txtProductType').val(data.product_type);
    $('#txtProductCode').val(data.product_code);
    $('#txtDimensions').val(data.product_dimensions);
    setSelectedOption('selcProductMix', data.product_mix_id)
    $('#vegetableCheck').attr('checked', data.vegetableCheck);
    $('#berryCheck').attr('checked', data.berryCheck);
    $('#flowersCheck').attr('checked', data.flowersCheck);
    $('#PCMCheck').attr('checked', data.PCMCheck);
    $('#OthersCheck').attr('checked', data.OthersCheck);
    setSelectedOption('selcWashedLevel', data.washed_level_id);
    setSelectedOption('selcSlabPosition', data.slab_position);
    $('#txtDripperHoles').val(data.no_of_dripper);
    $('#txtDrainHoles').val(data.no_of_drain);
    setSelectedOption('txtDrainHolesSize', data.drain_holes_size);
    setSelectedOption('txtDrainHolesShape', data.drain_holes_shape);
    $('#txtDugHoles').val(data.no_of_dug);
    $('#txtDugHolesSize').val(data.dug_holes_size);
    $('#txtPlantHoles').val(data.no_of_plant);
    $('#txtPlantHolesSize').val(data.plant_holes_size);
    setSelectedOption('selcPlantHoles', data.standing_Lying);
    setSelectedOption('selcPallet', data.pallet);
    $('#txtPcsPerBoxes').val(data.pcs_per_boxes);
    $('#txtBoxesPallet').val(data.boxes_pallet);
    $('#txtBoxesMasterCartoon').val(data.boxes_master_cartoon);
    $('#txtMasterCartoonPallets').val(data.master_cartoon_pallets);
    $('#txtQtyPieces').val(data.quantity_pieces);


}










function updateOrderData() {

    var data = {
        "product_type": $('#txtProductType').val(),
        "product_code": $('#txtProductCode').val(),
        "product_dimension": $('#txtDimensions').val(),
        "product_mix_name": $('#selcProductMix option:selected').text(),
        "product_mix_id": $('#selcProductMix').val(),
        "naked_plank": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL.NAKED_PLANK],
        "vegetable": RADIO_SERVER_VAL[$('#vegetableCheck').is(':checked')],
        "berry": RADIO_SERVER_VAL[$('#berryCheck').is(':checked')],
        "flowers": RADIO_SERVER_VAL[$('#flowersCheck').is(':checked')],
        "pcm": RADIO_SERVER_VAL[$('#PCMCheck').is(':checked')],
        "others": RADIO_SERVER_VAL[$('#OthersCheck').is(':checked')],
        "washed_level_name": $('#selcWashedLevel option:selected').text(),
        "washed_level_id": $('#selcWashedLevel').val(),
        "slab_psition_name": $('#selcSlabPosition option:selected').text(),
        "slab_psition_id": $('#selcSlabPosition').val(),
        "dripper_holes": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL.DRIPPER_HOLES],
        "dripper_holes_no": $('#txtDripperHoles').val(),
        "drain_holes": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL.DRAIN_HOLES],
        "drain_holes_no": $('#txtDrainHoles').val(),
        "drain_holes_size_name": $('#txtDrainHolesSize option:selected').text(),
        "drain_holes_size_id": $('#txtDrainHolesSize').val(),
        "drain_holes_shape_name": $('#txtDrainHolesShape option:selected').text(),
        "drain_holes_shape_id": $('#txtDrainHolesShape').val(),
        "dug_holes": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL.DUG_HOLES],
        "dug_holes_no": $('#txtDugHoles').val(),
        "dug_holes_size": $('#txtDugHolesSize').val(),
        "plant_holes": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL.PLANT_HOLES],
        "plant_holes_no": $('#txtPlantHoles').val(),
        "plant_holes_size": $('#txtPlantHolesSize').val(),
        "plant_holes_standing_lying_name": $('#selcPlantHoles option:selected').text(),
        "plant_holes_standing_lying_id": $('#selcPlantHoles').val(),
        "bags": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL.BAGS],
        "mesh_liner": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL.MESH_LINER],
        "pallet_name": $('#selcPallet option:selected').text(),
        "pallet_id": $('#selcPallet').val(),
        "boxes_cases": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL.BOXES],
        "pcs_boxes": $('#txtPcsPerBoxes').val(),
        "boxess_pallet": $('#txtBoxesPallet').val(),
        "boxess_cartoon": $('#txtBoxesMasterCartoon').val(),
        "master_pallet": $('#txtMasterCartoonPallets').val(),
        "quantity": $('#txtQtyPieces').val(),
        "radio_value": RADIO_SERVER_VAL[ORDER_DATA_RADIO_VAL],
    };




    $.ajax({
        type: "POST",
        url: '/customerOrder/updateOrderData/' + UPDATE_ORDER_DATA_ID,
        data: {
            'order_data': JSON.stringify(data),
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        timeout: 800000,
        beforeSend: function () {
        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                toastr.success('Customer data has been updated successful...!');
                allOrderData(UPDATE_ORDER_ID);
                resetOrderData();
            } else {
                toastr.error('Something went wrong');
            }


        },
        error: function (error) {
            console.log(error);
            toastr.error('Something went wrong');
        },
        complete: function () {
        }

    });
}




function getCustomerMainOrder(id) {
    $.ajax({
        type: "GET",
        url: "/customerOrder/getCustomerMainOrder/" + id,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {
            progress(true);
        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                setCustomerMainOrder(response.data.result);
                allAttachment(id);

            } else {
                showErrorMessage();
            }

        },
        error: function (error) {
            console.log(error);

        },
        complete: function () {
            progress(false);
        }
    });
}



function setCustomerMainOrder(data) {
    CUSTOMER_ID = data.customer_id;
    $('#txtName').attr('data-id', data.customer_id);
    $('#txtName').val(data.customer_name);
    $('#txtPurchase').val(data.purchase_order);
    $('#txtFactoryPo').val(data.factory_po_num);
    $('#txtInvoiceNumber').val(data.invoice_num);
    $('#txtBillAddress').val(data.bill_address);
    $('#txtDeliveryAddress').val(data.delivery_address);
    $('#txtCosigneeDetails').val(data.cosignee_details);
    $('#txtPartyDetails').val(data.party_details);
    setSelectedOption('cmbCountry', data.country_id)
    $('#dteDate').val(data.date);
    $('#dteDeliveryDate').val(data.delivery_date);
    setSelectedOption('selcShippingTerms', data.shipping_term_id);
    $('#txtFillName').val(data.name_fill);
    $('#txtremarksbox').val(data.remarks);
    allOrderData(data.order_id);
}





function updateCustomerOrder() {
    var data = {
        "token": TOKEN,
        "customer_id": $('#txtName').attr('data-id'),
        "customer_name": $('#txtName').val(),
        "purchase_order": $('#txtPurchase').val(),
        "factory_po_num": $('#txtFactoryPo').val(),
        "invoice_num": $('#txtInvoiceNumber').val(),
        "bill_address": $('#txtBillAddress').val(),
        "delivery_address": $('#txtDeliveryAddress').val(),
        "cosignee_details": $('#txtCosigneeDetails').val(),
        "party_details": $('#txtPartyDetails').val(),
        "country_id": $('#cmbCountry').val(),
        "date": $('#dteDate').val(),
        "delivery_date": $('#dteDeliveryDate').val(),
        "shipping_term_id": $('#selcShippingTerms').val(),
        "name_fill": $('#txtFillName').val(),
        "remarks": $('#txtremarksbox').val(),
        "production_status": false,
        "status": true,
    };
    $.ajax({
        type: "POST",
        url: '/customerOrder/updateCustomerOrder/' + UPDATE_ORDER_ID,
        data: {
            'order': JSON.stringify(data),
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        timeout: 800000,
        beforeSend: function () {
        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                toastr.success('Customer data has been saved successful...!');
                allOrderData();
                resetOrderData();
                $('#orderForm').trigger('reset');
                location.href = "/orderList";
            } else {
                toastr.error('Something went wrong');
            }


        },
        error: function (error) {
            console.log(error);
            toastr.error('Something went wrong');
        },
        complete: function () {
        }

    });
}



function viewAttachment(file) {
    window.open('/order/' + file);

}


function downloadAttachment(file) {
    var link = document.createElement("a");
    link.download = file;
    link.href = "/order/" + file;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    delete link;
}


function deleteAttachment(id) {
    $.ajax({
        type: "DELETE",
        url: "/customerOrder/deleteAttachment/" + id,
        data: {
            _token: $('input[name=_token]').val()
        },
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                showSuccessMessage("Attachment has been deleted successfully...");
                allAttachment(UPDATE_ORDER_ID);
            } else {
                showErrorMessage();
            }

        },
        error: function (error) {
            console.log(error);

        },
        complete: function () {

        }
    });
}





function checkOrderStatus(id) {

    /*$.ajax({
        type: "GET",
        url: "/pp/customerOrder/checkOrderStatus/" + id,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {
            progress(true);
        },
        success: function (response) {
            console.log(response);
            if (response.data.result == 1) {
                $('#thradArea').show();
                $('#btnSubmitThread').attr('onclick', 'submitThread(' + id + ')')
                $('#actionArea').hide();
                loadCustomerOrderThread(id);
            } else {
                $('#thradArea').hide();
                $('#actionArea').show();
            }

        },
        error: function (error) {
            console.log(error);

        },
        complete: function () {
            progress(false);
        }
    });*/


    $('#btnSubmitThread').attr('onclick', 'submitThread(' + id + ')')
    loadCustomerOrderThread(id);
}















/**
* showSuccessMessage
* This function is used to show success message.
* @param message This is the paramter to require message content
*/
function showSuccessMessage(message) {
    toastr.success(message);
}


/**
* showWarningMessage
* This function is used to show warning message.
* @param message This is the paramter to require message content
*/
function showWarningMessage(message) {
    toastr.warning(message);
}



/**
* showErrorMessage
* This function is used to show error message.
* @param message This is the paramter to require message content
*/
function showErrorMessage(msg) {
    toastr.error(msg);
}


