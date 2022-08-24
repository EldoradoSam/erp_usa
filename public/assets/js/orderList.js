$(document).ready(function () {
    $('#myTable').DataTable({
        responsive: true,
        "pageLength": 100,
        "order": [],
        "columns": [
            { "data": "factory_po_num" },
            { "data": "customer_name" },
            { "data": "status" },
            { "data": "edit" },
            // { "data": "view" },
            // { "data": "delete" },
            { "data": "view", className: "view" },
            { "data": "delete", className: "delete" },

        ],
        columnDefs: [
            { width: 150, targets: 0 },
            { width: 20, targets: 2 },
            { width: 20, targets: 3 },
            { width: 20, targets: 4 },
            { width: 20, targets: 5 },
        ],
    });
    getOrder(1);

});


function getOrder(page_id) {

    $.ajax({
        type: "GET",
        url: "/order/allOrder",
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);

            if (response.data.success) {
                var data = [];
                var disable = { 0: "", 1: "checked" }
                for (i = 0; i < response.data.result.length; i++) {
                    var id = response.data.result[i]['order_id'];
                    var factory_po_num = response.data.result[i]['factory_po_num'];
                    var customer_name = response.data.result[i]['customer_name'];

                    var string_id = "'" + id + "'";
                    data.push({
                        "factory_po_num": factory_po_num,
                        "customer_name": customer_name,
                        "status": '<label class="switch"><input type="checkbox" id="' + response.data.result[i].order_id + '" onchange="disable(event,' + "'Order'" + ')" ' + disable[response.data.result[i].status] + '><span class="slider round"></span</lable>',
                        "edit": '<button class="btn btn-primary" onclick="edit(' + string_id + ')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>',
                        "view": '<button class="btn btn-success" onclick="view(' + string_id + ')"><i class="fa fa-eye" aria-hidden="true"></i></button>',
                        "delete": '<button class="btn btn-danger" onclick="_delete(' + string_id + ')"><i class="fa fa-trash" aria-hidden="true"></i></button>'
                    });
                }

                //table
                var table = $('#myTable').DataTable();
                table.clear();
                table.rows.add(data).draw();


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

function edit(id) {

    location.href = "/customerOrder?" + id;

}

function view(id) {
    location.href = "/customerOrder?" + id + "&view";
}

function _delete(id) {
    $.ajax({
        type: 'DELETE',
        url: '/order/' + id,
        data: {
            _token: $('input[name=_token]').val()
        },
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                showSuccessMessage("Order has been deleted successfully...")
                getOrder(1);
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


/**
* delete
* This function is used to update settings.
* @param url This is the paramter to ajax request url
* @param id This is the paramter to ajax data
*/
function _disabled(id, status) {

    var bool = 0;
    if (status) bool = 1;

    $.ajax({
        type: 'DELETE',
        url: '/order/order/' + id,
        data: {
            _token: $('input[name=_token]').val(),
            "status": bool
        },
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {

                if (status) showSuccessMessage("Data has been enabled successfully...");
                if (!status) showSuccessMessage("Data has been disabled successfully...");



            } else {
                var msg = response.data.message;
                var id = response.data.result;

                if (msg == "assigned") {//assigned settings cannot be disabled
                    showWarningMessage("Settings has been assigned...!");

                } else if (msg == "error") {
                    showErrorMessage();
                }
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



/**
* save
* This function is used to disable settings.
* @param event This is the paramter to identifi desable/enable
*/
function disable(event) {
    var id = event.target.id;
    var status = event.target.checked;
    _disabled(id, status);
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
* showErrorMessage
* This function is used to show error message.
* @param message This is the paramter to require message content
*/
function showErrorMessage() {
    toastr.error('Something went wrong');
}
