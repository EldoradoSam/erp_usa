console.log('st_customerList.js loading');
$(document).ready(function () {

    var table = $('#myTable').DataTable({
        responsive: false,
        "order": [],
        "columns": [
            { "data": "factory_po" },
            { "data": "customer_po" },
            { "data": "reason" },
            { "data": "edit" },
            { "data": "view" },
            { "data": "delete" },
        ],
        columnDefs: [
            { width: 100, targets: 0 },
            { width: 100, targets: 1 },
            { width: 50, targets: 3 },
            { width: 50, targets: 4 },
            { width: 50, targets: 5 },


        ],

    });
    table.column( 5 ).visible( false );

    loadOrderCancel();
})

function loadOrderCancel() {
    $.ajax({
        type: 'GET',
        url: '/OrderCancelList/loadOrderCancel',
        success: function (response) {
            console.log(response)
            if (response.data.success) {

                var data = [];
                for (i = 0; i < response.data.result.length; i++) {
                    var id = response.data.result[i]['order_cancel_id'];
                    var factory_po = response.data.result[i]['factory_po_no'];
                    var customer_po = response.data.result[i]['customer_po_no'];
                    var reason = response.data.result[i]['reason'];
                    var date = response.data.result[i]['date'];
                    data.push({
                        "factory_po": factory_po,
                        "customer_po": customer_po,
                        "reason": reason,
                        "edit": '<button class="btn btn-primary" onclick="edit(' + id + ')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>',
                        "view": '<button class="btn btn-success" onclick="view(' + id + ')"><i class="fa fa-eye" aria-hidden="true"></i></button>',
                        "delete": '<button class="btn btn-danger" onclick="_delete(' + id + ')"><i class="fa fa-trash" aria-hidden="true"></i></button>'
                    });
                }

                var table = $('#myTable').DataTable();
                table.clear();
                table.rows.add(data).draw();

            }
        }, error: function (data) {
            console.log('something went wrong');
        }
    });
}



function _delete(id) {

    $.ajax({
        type: 'DELETE',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: '/OrderCancelList/deleteOrderCancel/' + id,
        success: function (response) {
            console.log(response);
            showSuccessMessage('Order Cancel deleted successful.');
            loadOrderCancel();

        }, error: function (data) {
            // console.log('something went wrong');
        }
    });
}






function edit(id) {

    location.href = "/order_cancel?id=" + id + "&action=edit";

}
function view(id) {
    location.href = "/order_cancel?id=" + id + "&action=view";
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
