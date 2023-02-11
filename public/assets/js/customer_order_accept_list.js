$(document).ready(function () {
    var table = $('#myTable').DataTable({
        responsive: true,
        "pageLength": 100,
        "order": [],
        "columns": [
            { "data": "factory_po_num" },
            { "data": "customer_po_num" },
            { "data": "customer_name" },
            { "data": "order_status" },
            { "data": "order_action" },
            { "data": "fund_status" },
            { "data": "fund_action" },

        ],
        columnDefs: [
            { width: 150, targets: 0 },
            { width: 30, targets: 3 },
            { width: 50, targets: 4 },
            { width: 30, targets: 5 },
            { width: 50, targets: 6 },
        ],
    });
    allCustomerOrder();
});


function allCustomerOrder() {
    $.ajax({
        type: "GET",
        url: "/customerOrderAccept/allCustomerOrder",
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
                    var order_status = response.data.result[i]['order_status'];
                    var fund_status = response.data.result[i]['fund_status'];
                    var is_allowcated = response.data.result[i]['isAllowcated'];
                    var order_status_icon = '<span class="badge bg-primary text-primary-bright ">New</span>';
                    if (order_status == 0) {
                        order_status_icon = '<span class="badge bg-primary text-primary-bright ">New</span>';
                    } else if (order_status == 1) {
                        order_status_icon = '<span class="badge bg-success text-success-bright ">Accepted</span>';
                    } else if (order_status == 2) {
                        order_status_icon = '<span class="badge bg-warning text-warning-bright ">Revised</span>';
                    } else if (order_status == 3) {
                        order_status_icon = '<span class="badge bg-danger text-danger-bright ">Rejected</span>';
                    } else if (order_status == 4) {
                        order_status_icon = '<span class="badge bg-info text-info-bright ">Proceeded</span>';
                    } else if (order_status == 5) {
                        order_status_icon = '<span class="badge bg-dark text-dark-bright ">Hold</span>';
                    } else if (order_status == 6) {
                        order_status_icon = '<span class="badge bg-danger text-danger-bright ">Canceled</span>';
                    }

                    var string_id = "'" + id + "'";
                    var order_action_button = '<div class="dropdown">';
                    order_action_button += '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">';
                    order_action_button += ' Action';
                    order_action_button += '</button>';
                    order_action_button += '<div class="dropdown-menu">';
                    //order_action_button += '<a class="dropdown-item" href="#" onclick="new_order(' + string_id + ')">New</a>';
                    //order_action_button += '<a class="dropdown-item" href="#" onclick="accept(' + string_id + ')">Accept</a>';
                    //order_action_button += '<a class="dropdown-item" href="#"  onclick="revice(' + string_id + ')">Revise</a>';
                    //order_action_button += '<a class="dropdown-item" href="#" onclick="reject(' + string_id + ')">Reject</a>';
                    order_action_button += '<a class="dropdown-item" href="#" onclick="proceed(' + string_id + ')">Proceed</a>';
                    order_action_button += '<a class="dropdown-item" href="#" onclick="hold(' + string_id + ')">Hold</a>';
                    order_action_button += '</div></div>'



                    var fund_status_icon = '<span class="badge bg-danger text-danger-bright ">No</span>';
                    if (fund_status == 0) {
                        fund_status_icon = '<span class="badge bg-danger text-danger-bright ">No</span>';
                    } else if (fund_status == 1) {
                        fund_status_icon = '<span class="badge bg-success text-success-bright ">Yes</span>';
                    }
                    var fund_action_button = '<div class="dropdown">';
                    fund_action_button += '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">';
                    fund_action_button += ' Action';
                    fund_action_button += '</button>';
                    fund_action_button += '<div class="dropdown-menu">';
                    fund_action_button += '<a class="dropdown-item" href="#" onclick="yes(' + string_id + ')">Yes</a>';
                    fund_action_button += '<a class="dropdown-item" href="#" onclick="no(' + string_id + ')">No</a>';
                    fund_action_button += '</div></div>'
                    //if (is_allowcated == 0) {
                    data.push({
                        "factory_po_num": factory_po_num,
                        "customer_po_num": customer_po_num,
                        "customer_name": customer_name,
                        "order_status": order_status_icon,
                        "order_action": order_action_button,
                        "fund_status": fund_status_icon,
                        "fund_action": fund_action_button,

                    });
                    //}
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


function new_order(id) {
    swal({
        title: "Are you sure?",
        //text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: {
            yes: {
                text: "Yes",
                value: true,
                className: 'btn btn-danger',
            },
            no: {
                text: "No",
                value: false,
                className: 'btn btn-primary',
            }
        },

    })
        .then((willDelete) => {
            if (willDelete) {
                do_new(id);
            }
        });

}



function accept(id) {
    swal({
        title: "Are you sure?",
        //text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: {
            yes: {
                text: "Yes",
                value: true,
                className: 'btn btn-danger',
            },
            no: {
                text: "No",
                value: false,
                className: 'btn btn-primary',
            }
        },

    })
        .then((willDelete) => {
            if (willDelete) {
                if (checkOrderStatus(id) >= 1) {
                    do_accept(id);
                } else {
                    showWarningMessage("This order's status cannot be changed to 'Accept' ");
                }

            }
        });

}

function revice(id) {
    swal({
        title: "Are you sure?",
        //text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: {
            yes: {
                text: "Yes",
                value: true,
                className: 'btn btn-danger',
            },
            no: {
                text: "No",
                value: false,
                className: 'btn btn-primary',
            }
        },

    })
        .then((willDelete) => {
            if (willDelete) {
                do_revice(id);
            }
        });

}

function reject(id) {
    swal({
        title: "Are you sure?",
        //text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: {
            yes: {
                text: "Yes",
                value: true,
                className: 'btn btn-danger',
            },
            no: {
                text: "No",
                value: false,
                className: 'btn btn-primary',
            }
        },

    })
        .then((willDelete) => {
            if (willDelete) {
                do_reject(id);
            }
        });

}


function proceed(id) {
    swal({
        title: "Are you sure?",
        //text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: {
            yes: {
                text: "Yes",
                value: true,
                className: 'btn btn-danger',
            },
            no: {
                text: "No",
                value: false,
                className: 'btn btn-primary',
            }
        },

    })
        .then((willDelete) => {
            if (willDelete) {

                if (checkOrderStatus(id) >= 1) {
                    do_proceed(id);
                } else {
                    showWarningMessage("Can do only by USA office after accept the order . Can not do until accepted by Sri Lanka office ");
                }
            }
        });
}



function hold(id) {
    swal({
        title: "Are you sure?",
        //text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: {
            yes: {
                text: "Yes",
                value: true,
                className: 'btn btn-danger',
            },
            no: {
                text: "No",
                value: false,
                className: 'btn btn-primary',
            }
        },

    })
        .then((willDelete) => {
            if (willDelete) {
                if (checkOrderStatus(id) >= 1) {
                    do_hold(id);
                } else {
                    showWarningMessage("Can do only by USA office after accept the order . Can not do until accepted by Sri Lanka Office ");
                }
            }
        });
}




function yes(id) {
    swal({
        title: "Are you sure?",
        //text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: {
            yes: {
                text: "Yes",
                value: true,
                className: 'btn btn-danger',
            },
            no: {
                text: "No",
                value: false,
                className: 'btn btn-primary',
            }
        },

    })
        .then((willDelete) => {
            if (willDelete) {
                do_yes(id);
            }
        });
}




function no(id) {
    swal({
        title: "Are you sure?",
        //text: "Once deleted, you will not be able to recover this record!",
        icon: "warning",
        buttons: {
            yes: {
                text: "Yes",
                value: true,
                className: 'btn btn-danger',
            },
            no: {
                text: "No",
                value: false,
                className: 'btn btn-primary',
            }
        },

    })
        .then((willDelete) => {
            if (willDelete) {
                do_no(id);
            }
        });
}






function do_new(id) {

    $.ajax({
        type: "POST",
        url: '/customerOrderAccept/new_order_staus',
        data: { 'id': id },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);

            if (response.data.success) {

                showSuccessMessage("Customer Order has been changed to New status...");
                allCustomerOrder();

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


function do_accept(id) {

    $.ajax({
        type: "POST",
        url: '/customerOrderAccept/accept',
        data: { 'id': id },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);

            if (response.data.success) {

                showSuccessMessage("Customer Order Accepted...");
                allCustomerOrder();

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



function do_revice(id) {
    $.ajax({
        type: "POST",
        url: '/customerOrderRevice/revice',
        data: { 'id': id },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);

            if (response.data.success) {

                showSuccessMessage("Customer Order Revised...");
                allCustomerOrder();

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



function do_reject(id) {
    $.ajax({
        type: "POST",
        url: '/customerOrderReject/reject',
        data: { 'id': id },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);

            if (response.data.success) {

                showSuccessMessage("Customer Order Rejected...");
                allCustomerOrder();

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



function do_proceed(id) {
    $.ajax({
        type: "POST",
        url: '/customerOrderScheduled/proceed',
        data: { 'id': id },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);

            if (response.data.success) {

                showSuccessMessage("Customer Order Scheduled...");
                allCustomerOrder();

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





function do_hold(id) {
    $.ajax({
        type: "POST",
        url: '/customerOrderScheduled/hold',
        data: { 'id': id },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);

            if (response.data.success) {

                showSuccessMessage("Customer Order Hold...");
                allCustomerOrder();

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





function do_yes(id) {
    $.ajax({
        type: "POST",
        url: '/customerOrderScheduled/fund_status_yes',
        data: { 'id': id },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);

            if (response.data.success) {

                showSuccessMessage("Fund status changed as 'Yes'");
                allCustomerOrder();

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




function do_no(id) {
    $.ajax({
        type: "POST",
        url: '/customerOrderScheduled/fund_status_no',
        data: { 'id': id },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);

            if (response.data.success) {

                showSuccessMessage("Fund status changed as 'No'");
                allCustomerOrder();

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




function checkOrderStatus(id) {

    var status = 0;
    $.ajax({
        type: "GET",
        url: "/customerOrder/checkOrderStatus/" + id,
        async: false,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            status = response.data.result;

        },
        error: function (error) {
            console.log(error);

        },
        complete: function () {

        }
    });
    return status;
}



/*function isAllowcated() {
    var allowcated = false;
    $.ajax({
        type: "GET",
        url: "/customerOrderAccept/isAllowcated",
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);

            allowcated = response.data.result;
        },
        error: function (error) {
            console.log(error);

        },

    });
    return allowcated;
}*/



/**
* showSuccessMessage
* This function is used to show success message.
* @param message This is the paramter to require message content
*/
function showSuccessMessage(message) {
    toastr.success(message,'Success Alert',{ timeOut: 5000 });
}


/**
* showWarningMessage
* This function is used to show warning message.
* @param message This is the paramter to require message content
*/
function showWarningMessage(message) {
    toastr.warning(message,'Warning Alert',{ timeOut: 10000 });
}



/**
* showErrorMessage
* This function is used to show error message.
* @param message This is the paramter to require message content
*/
function showErrorMessage() {
    toastr.error('Something went wrong');
}



