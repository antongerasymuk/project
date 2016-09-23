$('#review-create').on('click', function (e) {
    e.preventDefault();
    var form = $('#review-create-form');
    var validated = form.yiiActiveForm('submitForm');

    if (validated) {
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
                    Select2.appendItem('#company-reviewids', response.item);
                    var form = document.getElementById('review-create-form');

                    Preloader.hide();
                    Swalt.success('Success', 'Review created');
                    form.reset();
                    // clear file input
                    $(form).find('.filename').text('No file selected');
                    $('#review-create-modal').modal('hide');
                }
            },
            error: function (response) {
                console.log(response);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
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
    alert: function (title, text, type) {
        type = type || "success";

        swal(title, text, type);
    },
    warning: function (title, text) {
        this.alert(title, text, "error");
    },
    success: function (title, text) {
        this.alert(title, text, "success");
    }
};

var Select2 = {
  appendItem: function (blockId, options) {
      var element = '<option value="'+ options.id +'">' + options.value + '</option>';
      $(blockId).append(element);
  }
};