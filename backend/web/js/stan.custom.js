// Create bonus event
$('#bonus-create').on('click', function (e) {
    e.preventDefault();

    Model.create({
        formId: 'bonus-create-form',
        formIndex: 2,
        createActionUrl: '/backend/bonus/create',
        select2Selector: '#review-bonusids',
        modalSelector: '#bonus-create-modal'
    });
});

$('#rating-create').on('click', function (e) {
    e.preventDefault();

    Model.create({
        formId: 'rating-create-form',
        formIndex: 3,
        createActionUrl: '/backend/rating/create',
        select2Selector: '#review-ratingids',
        modalSelector: '#rating-create-modal'
    });
});

$('#plus-create').on('click', function (e) {
    e.preventDefault();

    Model.create({
        formId: 'plus-create-form',
        formIndex: 3,
        createActionUrl: '/backend/plus/create',
        select2Selector: '#review-plusids',
        modalSelector: '#plus-create-modal'
    });
});

// Create review event
$('#review-create').on('click', function (e) {
    e.preventDefault();

    Model.create({
        formId: 'review-create-form',
        formIndex: 1,
        createActionUrl: '/backend/review/create',
        select2Selector: '#company-reviewids',
        modalSelector: '#review-create-modal'
    });
});

function beforeSendHandler() {
    Loader.show();
}

var Model = {
    create: function (options) {
        options.fileSelector = options.fileSelector || '.filename';

        var $form = $('#' + options.formId);
        var validated = $form.yiiActiveForm('submitForm');

        if (validated) {
            // !!!!!don't saved without this line
            var form = document.getElementById(options.formId);
            tinyMCE.triggerSave();
            var formData = new FormData(form);
            console.log(formData);
            // submit form - saving file form via ajax
            $.ajax({
                url: options.createActionUrl,
                type: 'POST',
                beforeSend: beforeSendHandler,
                data: formData,
                success: function (response) {
                    console.log(response);
                    Loader.hide();

                    if (response.success) {
                        Select2.appendItem(options.select2Selector, response.item);
                        form.reset();

                        Swalt.success('Success', 'Review created');
                        // clear file input
                        $form.find(options.fileSelector).text('No file selected');
                        $(options.modalSelector).modal('hide');
                    } else {
                        Swalt.warning('Ops!', 'Not saved');
                    }
                },
                error: function (response) {
                    console.log(response);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        } else {
            Swalt.warning('Oops!', 'Please, check review fields and try again');
        }
    }
};

var Loader = {
    loaderSelector: '#preloader',
    submitBtnSelector: '#review-create',
    append: function () {
        $(this.submitBtnSelector).parent().append('<div id="preloader" class="preloader" style="display: none;"></div>')
    },
    show: function () {
        this.append();
        $(this.loaderSelector).show();
    },
    hide: function () {
        $(this.loaderSelector).hide();
        $(this.loaderSelector).remove();
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