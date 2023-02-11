var ORDER_CANCEL_ID = undefined;
var ACTION = 'Save';
$(document).ready(function () {


    var datepicker = $('input[name="txtDate"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        locale: {
            format: 'YYYY-MM-DD',
        }

    });

    

    getFactoryPO();
    getReason();




    if (window.location.search.length > 0) {
        var sPageURL = window.location.search.substring(1);
        var param = sPageURL.split('?');
        ORDER_CANCEL_ID = param[0].split('=')[1].split('&')[0];
        ACTION = param[0].split('=')[2].split('&')[0];

        getOrderCancel(ORDER_CANCEL_ID);
        if (ACTION == 'edit') {
            $('#btnAction').text('Update');
        } else if (ACTION == 'view') {
            $('#btnAction').hide();
        }

    } else {
        $('#btnAction').text('Save');
    }


    $('#btnAction').on('click', function () {
        if ($(this).text() == 'Save') {
            save();
        } else {
            update();
        }
    });


    $('#cmbFactoryPO').on('change', function () {
        getCustomerPO($(this).val());
    });

    getCustomerPO($('#cmbFactoryPO').val());

});



function getFactoryPO() {
    $.ajax({
        type: 'GET',
        url: '/OrderCancel/getFactoryPO',
        async: false,
        success: function (response) {

            $('#cmbFactoryPO').empty();
            for (var i = 0; i < response.data.result.length; i++) {
                $('#cmbFactoryPO').append('<option value="' + response.data.result[i].order_id + '">' + response.data.result[i].factory_po_num + '</option>');
            }

        }, error: function (data) {
            // console.log('something went wrong');
        }
    });
}



function getCustomerPO(order_id) {
    $.ajax({
        type: 'GET',
        url: '/OrderCancel/getCustomerPO/' + order_id,
        async: false,
        success: function (response) {

            if (response.data.success) {
                $('#lblCustomerPO').text(response.data.result[0].purchase_order);
            }

        }, error: function (data) {
            // console.log('something went wrong');
        }
    });
}



function getReason() {
    $.ajax({
        type: 'GET',
        url: '/OrderCancel/getReason',
        async: false,
        success: function (response) {

            $('#cmbReason').empty();
            for (var i = 0; i < response.data.result.length; i++) {
                $('#cmbReason').append('<option value="' + response.data.result[i].reason_id + '">' + response.data.result[i].reason + '</option>');
            }

        }, error: function (data) {
            // console.log('something went wrong');
        }
    });
}



function save() {
    $.ajax({
        type: "POST",
        url: '/OrderCancel/save',
        data: {
            "date": $('#txtDate').val(),
            "factory_po": $('#cmbFactoryPO option:selected').text(),
            "customer_po": $('#lblCustomerPO').text(),
            "order_id": $('#cmbFactoryPO').val(),
            "reason": $('#cmbReason').val(),
            "remark": $('#txtRemark').val(),
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
                showSuccessMessage('Order Cancel data has been saved successful...!');
                $('#txtDate').val('');
                $('#txtRemark').val('');
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




function update() {
    if (ORDER_CANCEL_ID == undefined) {
        showWarningMessage('Invalied Order cancel.');
        return;
    }
    $.ajax({
        type: "PUT",
        url: '/OrderCancel/update/' + ORDER_CANCEL_ID,
        data: {
            "date": $('#txtDate').val(),
            "factory_po": $('#cmbFactoryPO option:selected').text(),
            "customer_po": $('#lblCustomerPO').text(),
            "order_id": $('#cmbFactoryPO').val(),
            "reason": $('#cmbReason').val(),
            "remark": $('#txtRemark').val(),
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
                showSuccessMessage('Order Cancel data has been updated successful...!');
                $('#txtDate').val('');
                $('#txtRemark').val('');
                location.href = '/order_cancel_list';
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



function getOrderCancel(id) {
    $.ajax({
        type: "GET",
        url: "/OrderCancel/getOrderCancel/" + id,
        async:false,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            var res = response.data.result;
            console.log(res);
            $('#txtDate').val(res.date);
            setSelectedOption("cmbFactoryPO", res.order_id);
            $("#lblCustomerPO").text(res.customer_po_no);
            setSelectedOption("cmbReason", res.reason_id);
            $('#txtRemark').val(res.remarks);
        },
        error: function (error) {
            console.log(error);


        },
        complete: function () {

        }

    });
}


function setSelectedOption(id, valueToSelect) {
    let element = document.getElementById(id);
    element.value = valueToSelect;
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