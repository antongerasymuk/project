$('#review-create').on('click', function (e) {
    e.preventDefault();

    // get review create form
    $.ajax({
        url: '/backend/review/create',
        method: 'GET',
        success: function (data) {
            swal({
                title: "Create review",
                text: data,
                showCancelButton: true,
                showConfirmButton: true,
                html: true
            });
        },
        error: function () {
            // error message
        }
    });
});