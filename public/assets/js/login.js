var redirect = null;

$(document).ready(function () {

    redirect = getUrlParameter('redirect');
    if (user != '' && redirect != '') {
        location.href = redirect;
    }

    toastr.options = {
        timeOut: 4000,
        progressBar: true,
        showMethod: "slideDown",
        hideMethod: "slideUp",
        showDuration: 200,
        hideDuration: 200
    };


    //


    $('#btnLogIn').on('click', function (event) {
        event.preventDefault();
        var data = $('#loginForm').serialize();
        // var data = new FormData(form);

        $.ajax({
            type: "POST",
            url: "/login",
            data: data,
            beforeSend: function () {

            },
            success: function (response) {
                console.log(response);
                if (response == '200') {
                    // window.location.replace("/welcome");
                    if (redirect == '') {
                        location.href = '/dashboard';
                    } else {
                        location.href = redirect;
                    }

                } else {
                    toastr.error('Wrong Login Details....');
                }
            },
            error: function (error) {
                console.log(error);

            },
            complete: function () {

            }

        });

    });

});


function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};