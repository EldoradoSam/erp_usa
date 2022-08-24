console.log('st_customerList.js loading');
$(document).ready(function () {

    $('#myTable').DataTable({
        responsive: true,
        "order": [],
        "columns": [
            { "data": "thCustomerid" },
            { "data": "thName" },
            { "data": "thAddress" },
            { "data": "edit"},
            { "data": "view"},
            { "data": "delete"},
        ],
        columnDefs: [
            { width: 100, targets: 0 },
            { width: 30, targets: 3 },
            { width: 30, targets: 4 },
            { width: 30, targets: 5 }

        ], 
    });
    loadcustomers();
})

function loadcustomers() {
    $.ajax({
        type: 'GET',
        url: '/CustomerList/loadCustomers',
        success: function (response) {
            console.log(response)
            if (response.data.success) {

                var data = [];
                for (i = 0; i < response.data.result.length; i++) {
                    var customer_id = response.data.result[i]['customer_id'];
                    var address = response.data.result[i]['address'];
                    var customer_name = response.data.result[i]['customer_name'];
                    data.push({
                        "thCustomerid": customer_id,
                        "thName": customer_name,
                        "thAddress": address,
                        "edit": '<button class="btn btn-primary" onclick="edit(' + customer_id + ')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>',
                        "view": '<button class="btn btn-success" onclick="view(' + customer_id + ')"><i class="fa fa-eye" aria-hidden="true"></i></button>',
                        "delete": '<button class="btn btn-danger" onclick="_delete(' + customer_id + ')"><i class="fa fa-trash" aria-hidden="true"></i></button>'
                    });
                }

                var table = $('#myTable').DataTable();
                table.clear();
                table.rows.add(data).draw();
                table.columns('.edit').visible(false);
                table.columns('.view').visible(false);
                table.columns('.delete').visible(false);



                if (edit_permission == 1) {
                    table.columns('.edit').visible(true);
                }

                if (view_permission == 1) {
                    table.columns('.view').visible(true);
                }

                if (delete_permission == 1) {
                    table.columns('.delete').visible(true);
                }
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
        url: '/st/CustomerList/deleteCustomer/' + id,
        success: function (response) {
            console.log(response);
            loadcustomers();

        }, error: function (data) {
            // console.log('something went wrong');
        }
    });
}
function edit(id) {

    location.href = "/customer?" + id;

}
function view(id) {
    location.href = "/customer?" + id + "&view";
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
