$('#review-create').on('click', function (e) {
    "use strict";
    e.preventDefault();
    var form = $('#review-create-form');
    // return false if form still have some validation errors
    if (form.find('.has-error').length) {
        console.log('Has error');
        return false;
    }
    // submit form
    $.ajax({
        url: '/backend/review/create',
        type: 'post',
        data: form.serialize(),
        success: function (response) {
            console.log(response);
            // do something with response
        }
    });
    return false;
});