$(document).ready(function () {
    $('#tblCountry').DataTable({
        "scrollX": true,
        "order": [],
        "columns": [
            { "data": "name" },
            { "data": "code" },
            { "data": "instruction" },
            { "data": "edit", className: "edit" },
            { "data": "view", className: "view" },
            { "data": "status", className: "status" },
        ],
        columnDefs: [
            { width: 100, targets: 1 },
            { width: 40, targets: 3 },
            { width: 40, targets: 4 },
            { width: 40, targets: 5 },
        ],
    });

    allCountries();
    $('#btnAdd').on('click', function () {
        $('#countryForm').trigger("reset");
        $('#divInstructionView').hide();
        $('#divInstructionEdit').show();
        $('#btnSetting').show();
        $('#btnSetting').text('Save');
        showModal();
    });

    $('#btnSetting').on('click', function () {

        var event = $(this).text();
        if (event == 'Save') {
            save();
        } else if (event == 'Update') {
            var id = $('#countryID').val();
            update(id);
        }
    });

});





function showModal() {
    $("#countryModal").modal('toggle');
}

function hideModal() {
    $("#countryModal").modal('hide');
}




function save() {

    $.ajax({
        type: "POST",
        url: '/countryListController/save',
        data: $('#countryForm').serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        timeout: 800000,
        beforeSend: function () {
        },
        success: function (response) {
            console.log(response);

            if (response.data.success) {

                $('#countryForm')[0].reset();
                hideModal();
                allCountries();
                showSuccessMessage("Country has been saved successfully...");


            } else {
                showErrorMessage();
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




function getCountry(event, id) {
    $.ajax({
        type: "GET",
        url: "/countryListController/getCountry/" + id,
        async: false,
        processData: false,
        contentType: false,
        async: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            var res = response.data.result;
            console.log(res);
            $('#countryID').val(res.country_id);
            $('#txtCode').val(res.country_code);
            $('#txtName').val(res.country_name);
            $('#txtInstruction').val(res.import_instruction);
            $('#lblInstruction').text(res.import_instruction);
            $('#lblInstruction').attr("href",res.import_instruction);
            if (event == 'Edit') {
               $('#divInstructionView').hide();
               $('#divInstructionEdit').show();
               $('#btnSetting').show();
            }else{
                $('#divInstructionEdit').hide();
                $('#divInstructionView').show();
                $('#btnSetting').hide();
            }
            showModal();
        },
        error: function (error) {
            console.log(error);


        },
        complete: function () {

        }

    });
}




function allCountries() {
    $.ajax({
        type: "GET",
        url: "/countryListController/allCountries",
        async: false,
        processData: false,
        contentType: false,
        async: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                var result = response.data.result;
                appendTableRow(result);

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





function appendTableRow(result) {

    var data = [];
    for (i = 0; i < result.length; i++) {


        var country_primary_id = result[i]['country_id'];
        var country_code = result[i]['country_code'];
        var country_name = result[i]['country_name'];
        var instruction = result[i]['import_instruction'];
        var status = result[i]['status'];
        var string_id = "'" + country_primary_id + "'";

        var disable = { 0: "", 1: "checked" };
        data.push({
            "name": country_name,
            "code": country_code,
            "instruction": '<a href="'+instruction+'">' + instruction + '</a>',
            "edit": '<button class="btn btn-primary" onclick="edit(' + string_id + ')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>',
            "view": '<button class="btn btn-success" onclick="view(' + string_id + ')"><i class="fa fa-eye" aria-hidden="true"></i></i></button>',
            "status": '<label class="switch"><input type="checkbox" id="'+country_primary_id+'" onchange="disable('+string_id+','+status+')" '+disable[status]+'><span class="slider round"></span></label>',
        });

    }



    var table = $('#tblCountry').DataTable();
    table.clear();
    table.rows.add(data).draw();

}



function edit(id) {
    $('#btnSetting').text('Update');
    getCountry('Edit',id);
}



function update(id) {
    $.ajax({
        type: "PUT",
        url: '/countryListController/update/' + id,
        data: {
            "id": $('#countryID').val(),
            "code": $('#txtCode').val(),
            "name": $('#txtName').val(),
            "instruction": $('#txtInstruction').val(),
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

                $('#countryForm')[0].reset();
                hideModal();
                allCountries();
                showSuccessMessage("Country has been update successfully...");


            } else {
                showErrorMessage();
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


function view(id) {
    $('#btnSetting').hide();
    getCountry('View',id);
}

function disable(id,status){
    $.ajax({
        type: "PUT",
        url: '/countryListController/disable/' + id,
        data: {
            "status": status,
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
                allCountries();
                showSuccessMessage("Country has been update successfully...");


            } else {
                showErrorMessage();
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
function showErrorMessage() {
    toastr.error('Something went wrong');
}


