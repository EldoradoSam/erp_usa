$(document).ready(function () {

});


function submitThread(order_id) {

    if ($('#txtOrderThread').val().trim().length == 0) {
        showWarningMessage('Please enter message.');
        return;
    }
    if (!checkStringLength($('#txtOrderThread').val(), 500)) {
        showWarningMessage('Data too long for "Message".');
        return;
    }
    $.ajax({
        type: "POST",
        url: '/customerOrderThread/submit',
        data: {
            'order_id': order_id,
            'text': $('#txtOrderThread').val(),
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
                toastr.success('Your text saved successful...!');
                $('#txtOrderThread').val('');
                loadCustomerOrderThread(order_id);

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



function loadCustomerOrderThread(order_id) {
    $.ajax({
        type: "GET",
        url: "/customerOrderThread/loadCustomerOrderThread/" + order_id,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 800000,
        beforeSend: function () {
            progress(true);
        },
        success: function (response) {
            console.log(response);
            $('#threadParent').empty();
            for (var i = 0; i < response.data.result.length; i++) {
                var section = loadSection(response.data.result[i].text, response.data.result[i].img, response.data.result[i].data);
                $('#threadParent').append(section);
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



function loadSection(text, img, data) {
    var section = '<div class="row mb-5">';
    section += '<div class="col-md-12">';
    section += '<div class="border">';
    section += '<p style="margin:5px;background-color: lightgray;padding:5px;">' + text + '</p>';
    section += '<hr style="margin: 0px;">';
    section += '<div class="row">';
    section += '<div class="col-md-2" style="margin-top: 0px;">';
    section += '<img class="img img-thumbnail" src="' + img + '" id="imgEmployee" style="max-width: 50px;max-height: 50px;" alt="image/">';
    section += '</div>';
    section += '<div class="col-md-8" style="margin: 0px;">';
    section += '<p style="font-size: 10px;">' + data + '</p>';
    section += '</div>';
    section += '</div>';
    section += '</div>';
    section += '</div>';
    section += '</div>';
    return section;
}

function checkStringLength(string, maxLength) {

    if (string.length > maxLength) {
        return false;
    }
    return true;

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