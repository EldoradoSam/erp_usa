$(document).ready(function () {
    var table = $('#myTable').DataTable({
        responsive: false,
        "pageLength": 25,
        "order": [],
        "columns": [
            { "data": "factory_po_num" },
            { "data": "customer_po_num" },
            { "data": "customer_name" },
            { "data": "production_status" },
            { "data": "order_status" },
            { "data": "fund_status" },
            { "data": "status" },
            { "data": "edit" },
            // { "data": "view" },
            // { "data": "delete" },
            { "data": "view", className: "view" },
            { "data": "delete", className: "delete" },

        ],
        columnDefs: [
            { width: 150, targets: 0 },
            { width: 150, targets: 1 },
            { width: 20, targets: 3 },
            { width: 20, targets: 4 },
            { width: 20, targets: 5 },
            { width: 20, targets: 6 },
            { width: 20, targets: 7 },
        ],
    });

    table.column(6).visible(false);
    //table.column(8).visible(false);
    allCustomerOrder();
    /*if (user_type == 'USA OFFiCE') {
        table.column(5).visible(false);
        table.column(7).visible(false);
    }*/
});


function allCustomerOrder() {
    $.ajax({
        type: "GET",
        url: "/customerOrderList/allCustomerOrder",
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
                    var customer_po_num = response.data.result[i]['purchase_order'];
                    var customer_name = response.data.result[i]['customer_name'];
                    var production_status = response.data.result[i]['production_status'];
                    var order_status = response.data.result[i]['order_status'];
                    var fund_status = response.data.result[i]['fund_status'];
                    var string_id = "'" + id + "'";
                    var order_status_icon = '<span class="badge bg-primary text-primary-bright ">New</span>';
                    var edit_button = '<button class="btn btn-primary" onclick="edit(' + string_id + ')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
                    var delete_button = '<button class="btn btn-danger" onclick="_delete(' + string_id + ')"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                    if (order_status == 0) {
                        order_status_icon = '<span class="badge bg-primary text-primary-bright ">New</span>';
                    } else if (order_status == 1) {
                        order_status_icon = '<span class="badge bg-success text-primary-bright ">Accepted</span>';
                        edit_button = '<button class="btn btn-primary" onclick="edit(' + string_id + ')" disabled><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
                        delete_button = '<button class="btn btn-danger" onclick="_delete(' + string_id + ')" disabled><i class="fa fa-trash" aria-hidden="true"></i></button>';
                    } else if (order_status == 2) {
                        order_status_icon = '<span class="badge bg-warning text-warning-bright ">Reviced</span>';
                    } else if (order_status == 3) {
                        order_status_icon = '<span class="badge bg-danger text-danger-bright ">Reject</span>';
                        edit_button = '<button class="btn btn-primary" onclick="edit(' + string_id + ')" disabled><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
                        delete_button = '<button class="btn btn-danger" onclick="_delete(' + string_id + ')" disabled><i class="fa fa-trash" aria-hidden="true"></i></button>';
                    } else if (order_status == 4) {
                        order_status_icon = '<span class="badge bg-info text-info-bright ">Proceeded</span>';
                    } else if (order_status == 5) {
                        order_status_icon = '<span class="badge bg-dark text-dark-bright ">Hold</span>';
                    } else if (order_status == 6) {
                        order_status_icon = '<span class="badge bg-danger text-danger-bright ">Canceled</span>';
                    }

                    var production_status_icon = '<span class="badge bg-primary text-primary-bright ">New</span>';
                    if (production_status == 0) {
                        production_status_icon = '<span class="badge bg-primary text-primary-bright ">New</span>';
                    } else if (production_status == 1) {
                        production_status_icon = '<span class="badge bg-success text-success-bright ">Planed</span>';
                    } else if (production_status == 2) {
                        production_status_icon = '<span class="badge bg-dark text-dark-bright ">Scheduled</span>';
                    } else if (production_status == 3) {
                        production_status_icon = '<span class="badge bg-warning text-warning-bright ">Start</span>';
                    } else if (production_status == 4) {
                        production_status_icon = '<span class="badge bg-danger text-danger-bright ">Hold</span>';
                    } else if (production_status == 5) {
                        production_status_icon = '<span class="badge bg-primary text-primary-bright ">Finished</span>';
                    } else if (production_status == 6) {
                        production_status_icon = '<span class="badge bg-success text-success-bright ">Delivered</span>';
                    }


                    var fund_status_icon = '<span class="badge bg-danger text-danger-bright ">No</span>';
                    if (fund_status == 0) {
                        fund_status_icon = '<span class="badge bg-danger text-danger-bright ">No</span>';
                    } else if (fund_status == 1) {
                        fund_status_icon = '<span class="badge bg-success text-success-bright ">Yes</span>';
                    }
                    data.push({
                        "factory_po_num": factory_po_num,
                        "customer_po_num": customer_po_num,
                        "customer_name": customer_name,
                        "production_status": production_status_icon,
                        "order_status": order_status_icon,
                        "fund_status": fund_status_icon,
                        "status": '<label class="switch"><input type="checkbox" id="' + response.data.result[i].order_id + '" onchange="disable(event,' + "'Order'" + ')" ' + disable[response.data.result[i].status] + '><span class="slider round"></span</lable>',
                        "edit": edit_button,
                        "view": '<button class="btn btn-success" onclick="view(' + string_id + ')"><i class="fa fa-eye" aria-hidden="true"></i></button>',
                        "delete": delete_button,
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

        },

    });
}



function edit(id) {
    location.href = "/customerOrder?id=" + id + "&action=edit";
}

function view(id) {
    location.href = "/customerOrder?id=" + id + "&action=view";
}

function _delete(id) {

    if (isAllowcateOrder(id)) {
        showWarningMessage('This order has already allocated.')
        return;
    }

    $.ajax({
        type: 'DELETE',
        url: '/customerOrderList/delete/' + id,
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
                allCustomerOrder();
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



function isAllowcateOrder(id) {

    var bool = 0;
    $.ajax({
        type: 'GET',
        url: '/customerOrderList/isAllowcateOrder/' + id,
        async: false,
        success: function (response) {
            if (response == 1) {
                bool = true;
            } else {
                bool = false;
            }
        }, error: function (data) {
            // console.log('something went wrong');
        }
    });
    return bool;
}


function disable(id) {
    //alert(id);
}


function checkOrderStatus(id) {

    var status = 0;
    $.ajax({
        type: "GET",
        url: "/customerOrder/checkOrderStatus/" + id,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {
            progress(true);
        },
        success: function (response) {
            console.log(response);
            status = response.data.result;

        },
        error: function (error) {
            console.log(error);

        },
        complete: function () {
            progress(false);
        }
    });
    return status;



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
