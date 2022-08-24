console.log('gn_customer.js loading')

var customerid;

$(document).ready(function () {
    $('#myTable').DataTable({
        responsive: true,
        "order": [],
        "columns": [
            { "data": "thdesignation" },
            { "data": "themail" },
            { "data": "thMobile" },
            { "data": "thFixedMobile" },
            { "data": "edit" },
            { "data": "delete" },
        ],
    });

    $('#myTable2').DataTable({
        responsive: true,
        "order": [],
        "columns": [
            { "data": "thTitle" },
            { "data": "thView" },
            { "data": "thDownload" },
            { "data": "thDelete" },
        ],
    });

    /*$('#btnSaveCustomer').on('click', function (event) {
        event.preventDefault();
        var form = $('#customerForm').get(0);
        var data = new FormData(form);
        console.log(data);

        if ($('#btnSaveCustomer').text() == "Save") {
            Save(data);
        } else if ($('#btnSaveCustomer').text() == "Update") {

        }
    });*/

    LoadCountry();
    LoadGLPostData();
    loadcustomers();
    // setcustomerId();


})
//this function set customerid variable on change of the customer id input field
function setcustomerId() {
    var id = $('#txtCustomerId').val()
    if (!id == '') {
        $.ajax({
            type: 'GET',
            url: '/Customer/checkcustomerID/' + id,
            success: function (response) {
                console.log(response.data.result);
                if (response.data.result == null) {
                    customerid = $('#txtCustomerId').val();
                    $('#hidecustomerId').val(customerid);
                    console.log(customerid);
                }
                else {
                    toastr.options = {
                        "closeButton": true,
                        "newestOnTop": false,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "extendedTimeOut": "1000",
                    }
                    toastr.warning('customerid alredy Excist!!!');
                    $('#txtCustomerId').val('');
                    $('#hidecustomerId').val('');
                }
            }, error: function (data) {
                // console.log('something went wrong');
            }
        });
    }

}
$('#btnSaveCustomer').on('click', function (event) {
    event.preventDefault();
    var form = $('#customerForm').get(0);
    var data = new FormData(form);
    console.log(data);

    if ($('#btnSaveCustomer').text() == "Save") {
        Save(data);
    } else if ($('#btnSaveCustomer').text() == "Update") {
        updateCustomer(data);
    }
});
function Save(data) {
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '/Customer/saveCustomer',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                Reset();
                toastr.success('Record Added Successfully!!!');
            }
        }, error: function (data) {
            console.log('Something went wrong!');
        }
    });
}
// This function is use to get all gl posting data
function LoadGLPostData() {
    $.ajax({
        type: 'GET',
        url: '/supplier/GLPostingData',
        success: function (response) {
            console.log(response);
            $.each(response.data.result, function (index, value) {
                $('#selectAccountgroup_id').append('<option value=" ' + value['gl_post_id'] + ' ">' + value['gl_post'] + '</option>');
            });
        }
    });
}
// This function is use to get country data
function LoadCountry() {
    $.ajax({
        type: 'GET',
        url: '/supplier/settings/allCountry',
        success: function (response) {
            console.log(response);
            $('#selectCountry').empty();
            $.each(response.data.result, function (index, value) {
                $('#selectCountry').append('<option value="' + value.country_id + '">' + value.country_name + '</option>');
            });
        }, error: function (data) {
            console.log('Something went wrong!');
        }
    });
}
// This function is use to get all gl posting data
function LoadGLPostData() {
    $.ajax({
        type: 'GET',
        url: '/supplier/allGLPostingData',
        success: function (response) {
            console.log(response);
            $.each(response.data.result, function (index, value) {
                $('#selectAccountgroup_id').append('<option value=" ' + value['gl_post_id'] + ' ">' + value['gl_post'] + '</option>');
            });
        }
    });
}
function Reset() {
    $('#txtCustomerId').val('');
    $('#txtCustomerName').val('');
    $('#txtAddress').val('');
    $('#txtWebAddress').val('');
    $('#textNotes').val('');
    $('#txtStatus').val('');


    // $('#txtEmail').val('');
    // $('#txtDesignation').val('');
    // $('#txtMobile').val('');
    // $('#txtFixedMobile').val('');

    $('#selectCountry').val('');
    $('#selectAccountgroup_id').val('');

    $('#checkPrimaryContact').prop('checked', false);
    $('#checkSMSAlert').prop('checked', false);
    $('#checkEmailAlert').prop('checked', false);
}
$('#btncontactsmodal').on('click', function () {

    $('#contactsmodal').modal('show');

});
$('#btnSaveContact').on('click', function () {
    if ($('#btnSaveContact').text() == 'update') {
        var form = $('#contactfrm').get(0);
        var data = new FormData(form);
        updatecontacts(data);
    } else {
        var form = $('#contactfrm').get(0);
        var data = new FormData(form);
        savecontacts(data);
    }
});
function savecontacts(data) {
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '/Customer/savecontacts',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        success: function (response) {
            console.log(response);
            if (response.data.success) {

                $('#contactsmodal').modal('hide');

                loadcontacts(customerid);

                toastr.success('Record Added Successfully!!!');

            }
        }, error: function (data) {
            console.log('Something went wrong!');
        }
    });

}
function updatecontacts(data) {
    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '/Customer/updatecontacts',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        success: function (response) {
            console.log(response);
            if (response.data.success) {

                $('#contactsmodal').modal('hide');

                loadcontacts(customerid);

                toastr.success('Record Updated Successfully!!!');

            }
        }, error: function (data) {
            console.log('Something went wrong!');
        }
    });

}
function loadcontacts(id) {
    $.ajax({
        type: 'GET',
        url: '/Customer/loadcontacts/' + id,
        success: function (response) {
            console.log(response)
            if (response.data.success) {

                var data = [];
                for (i = 0; i < response.data.result.length; i++) {
                    var designation = response.data.result[i]['designation'];
                    var email = response.data.result[i]['email'];
                    var Mobile = response.data.result[i]['mobile'];
                    var FixedMobile = response.data.result[i]['fixed'];
                    var contactID = response.data.result[i]['contact_id'];


                    data.push({
                        "thdesignation": designation,
                        "themail": email,
                        "thMobile": Mobile,
                        "thFixedMobile": FixedMobile,
                        "edit": '<button type="button" class="btn btn-primary" onclick="edit(' + contactID + ')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>',
                        "delete": '<button type="button" class="btn btn-danger" onclick="_delete(' + contactID + ')"><i class="fa fa-trash" aria-hidden="true"></i></button>',
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
        url: '/Customer/deletecontacts/' + id,
        success: function (response) {
            console.log(response);
            loadcontacts(customerid);

        }, error: function (data) {
            // console.log('something went wrong');
        }
    });
}
function edit(id) {
    $.ajax({
        type: 'GET',
        url: '/Customer/EditContct/' + id,
        success: function (response) {

            console.log(response.data.result);

            $('#contactsmodal').modal('show');
            $('#txtDesignation').val(response.data.result.designation);
            $('#txtEmail').val(response.data.result.email);
            $('#txtMobile').val(response.data.result.mobile);
            $('#txtFixedMobile').val(response.data.result.fixed);
            $('#hidecontactId').val(response.data.result.contact_id);


            if (response.data.result.sms_alert == true) {
                $('#checkSMSAlert').prop('checked', true);
            }
            if (response.data.result.email_alert == true) {
                $('#checkEmailAlert').prop('checked', true);
            }
            if (response.data.result.primary == true) {
                $('#checkPrimaryContact').prop('checked', true);
            }

            $('#btnSaveContact').text('update')

        }, error: function (data) {
            // console.log('something went wrong');
        }
    });
}
function loadcustomers() {
    if (window.location.search.length > 0) {
        $('#btnResetProduct').show();
        var pageURL = window.location.search.substring(1);
        var param = pageURL.split('&');

        if (param.length == 2) {
            console.log('view');
            $('#btnSaveCustomer').hide();
            $('#btncontactsmodal').hide();

        } else {
            console.log('edit');

            $('#btnSaveCustomer').show();
        }

        var id = param[0];
        console.log(id);
        $('#hideProductId').val(id);
        $.ajax({
            type: 'GET',
            url: '/Customer/EditCustomer/' + id,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 800000,
            success: function (response) {
                var result = response.data.result;
                console.log(result);

                $('#hiddenCustomerId').val(result.customer_id);
                $('#hidecustomerId').val(result.customer_id);
                $('#txtCustomerId').val(result.customer_id);
                $('#txtCustomerName').val(result.customer_name);
                $('#txtAddress').val(result.address);
                $('#txtDeliveryAddress').val(result.delivery_address);
                $('#txtCosigneeDetails').val(result.cosignee_details);
                $('#txtPartyDetails').val(result.party_details);
                $('#txtWebAddress').val(result.web);
                $('#textNotes').val(result.notes);
                $('#selectCountry').val(result.country_id);
                $('#txtStatus').val(result.status_id);
                $('#accountgroup_id').val(result.selectAccountgroup_id);

                $('#btnSaveCustomer').text('Update');

                loadcontacts(result.customer_id);
                loadAttachment(result.customer_id);
          }
        });
    }
}
function updateCustomer(data) {

    $.ajax({
        type: 'POST',
        enctype: 'multipart/form-data',
        url: '/Customer/updateCustomer',
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                Reset();
                toastr.success('Record Updated Successfully!!!');
            }
        }, error: function (data) {
            console.log('Something went wrong!');
        },
        complete: function () {
            location.href = "/customerList";
        }
    });
}

function loadAttachment(id) {
    //resetAttachment();
    $.ajax({
        type: "GET",
        url: "/CustomerAttachment/allFiles/" + id,
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
                for (i = 0; i < response.data.result.length; i++) {
                    var title = response.data.result[i]['file_path'];
                    var id = response.data.result[i]['id'];
                    var file = "'" + title + "'";
                    var string_id = "'" + id + "'";
                    data.push({
                        "thTitle": title,
                        "thView": '<button class="btn btn-success" type="button" onclick="viewAttachment(' + file + ')"><i class="fa fa-eye" aria-hidden="true"></i></button>',
                        "thDownload": '<button class="btn btn-primary" type="button" onclick="downloadAttachment(' + file + ')"><i class="fa fa-download" aria-hidden="true"></i></button>',
                        "thDelete": '<button class="btn btn-danger" type="button" onclick="attachmentDelete(' + string_id + ')"><i class="fa fa-trash" aria-hidden="true"></i></button>',
                    });
                }


                var table = $('#myTable2').DataTable();
                table.clear();
                table.rows.add(data).draw();

            } else {

            }

        },
        error: function (error) {
            console.log(error);

        },
        complete: function () {

        }
    });

}
function viewAttachment(file) {

    window.open('/customer/' + file);

}
function downloadAttachment(file) {

    var link = document.createElement("a");
    link.download = file;
    link.href = "/customer/" + file;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    delete link;

}
function attachmentDelete(attachment_id) {

    $.ajax({
        type: "GET",
        url: "/CustomerAttachment/delete/" + attachment_id,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {

        },
        success: function (response) {
            console.log(response);
            if (response.data.success) {
                showSuccessMessage("Attachment has been deleted successfully...");
                var id = $('#hiddenCustomerId').val();
                loadAttachment(id);
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