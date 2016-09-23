$('#review-create').on('click', function (e) {
    // "use strict";
    e.preventDefault();
    var form = $('#review-create-form');
    // return false if form still have some validation errors
    if (form.find('.has-error').length) {
        console.log('Has error');
        return false;
    }

    // !!!!!don't saved without this line
    tinyMCE.triggerSave();

    var formData = new FormData($('form')[1]);
    console.log(formData);
    // submit form - saving file form via ajax
    $.ajax({
        url: '/backend/review/create',
        type: 'POST',
        beforeSend: beforeSendHandler,
        data: formData,
        success: function (response) {
            console.log(response);
            if (response.success) {
                Preloader.hide();
            } else {

            }
        },
        error: function (response) {
            console.log(response);
        },
        cache: false,
        contentType: false,
        processData: false
    });
    return false;
});

function beforeSendHandler() {
    Preloader.show();
}

var Preloader = {
    preloader: '#preloader',
    show: function () {
        $(this.preloader).show();
    },
    hide: function () {
        $(this.preloader).hide();
    },
    toggle: function () {
        $(this.preloader).toggle();
    }
};

var Swalt = {

};