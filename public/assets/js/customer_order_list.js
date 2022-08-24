$(document).ready(function () {
    $('#myTable').DataTable({
        responsive: true,
        "pageLength": 100,
        "order": [],
        "columns": [
            { "data": "factory_po_num" },
            { "data": "customer_po_num" },
            { "data": "customer_name" },
            { "data": "order_status" },
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

    allCustomerOrder();
    if (user_type == 'USA OFFiCE') {
        table.column(5).visible(false);
        table.column(7).visible(false);
    }
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
                    var order_status = response.data.result[i]['order_status'];

                    var status_icon = '<span class="badge bg-primary text-primary-bright ">Accepted</span>';
                    if (order_status == 1) {
                        status_icon = '<span class="badge bg-primary text-primary-bright ">Accepted</span>';
                    } else if (order_status == 2) {
                        status_icon = '<span class="badge bg-warning text-warning-bright ">Reviced</span>';
                    } else if (order_status == 0) {
                        status_icon = '<span class="badge bg-danger text-danger-bright ">Reject</span>';
                    }
                    var string_id = "'" + id + "'";
                    data.push({
                        "factory_po_num": factory_po_num,
                        "customer_po_num": customer_po_num,
                        "customer_name": customer_name,
                        "order_status": status_icon,
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
    //alert(id);
}

function disable(id) {
    //alert(id);
}