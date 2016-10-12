// Create bonus event
$('#bonus-create-form').on('beforeSubmit', function (e) {
    console.log('Create bonus');return false;
    Model.create({
        validated: $(this).data('yiiActiveForm').validated,
        formId: 'bonus-create-form',
        formIndex: 2,
        createActionUrl: '/backend/bonus/create',
        select2Selector: '#review-bonusids',
        modalSelector: '#bonus-create-modal'
    });

    return false;
}).on('submit', function (e) {
    e.preventDefault();
});

$('#rating-create-form').on('beforeSubmit', function (e) {
    Model.create({
        validated: $(this).data('yiiActiveForm').validated,
        formId: 'rating-create-form',
        formIndex: 3,
        createActionUrl: '/backend/rating/create',
        select2Selector: '#review-ratingids',
        modalSelector: '#rating-create-modal'
    });

    return false;
}).on('submit', function (e) {
    e.preventDefault();
});

$('#plus-create-form').on('beforeSubmit', function (e) {
    Model.create({
        validated: $(this).data('yiiActiveForm').validated,
        formId: 'plus-create-form',
        formIndex: 3,
        createActionUrl: '/backend/plus/create',
        select2Selector: '#review-plusids',
        modalSelector: '#plus-create-modal'
    });

    return false;
});

$('#director-create-form').on('beforeSubmit', function(event) {
    Model.create({
        validated: $(this).data('yiiActiveForm').validated,
        formId: 'director-create-form',
        formIndex: 6,
        createActionUrl: '/backend/director/create',
        select2Selector: '#company-director_id',
        modalSelector: '#director-create-modal'
    });

    return false;
}).on('submit', function(e){
    e.preventDefault();
});


$('#license-create-form').on('beforeSubmit', function (e) {
    Model.create({
        validated: $(this).data('yiiActiveForm').validated,
        formId: 'license-create-form',
        formIndex: 7,
        createActionUrl: '/backend/license/create',
        select2Selector: '#company-licenseids',
        modalSelector: '#license-create-modal'
    });

    return false;
}).on('submit', function (e) {
    e.preventDefault();
});

$('#minus-create-form').on('beforeSubmit', function (e) {
    Model.create({
        validated: $(this).data('yiiActiveForm').validated,
        formId: 'minus-create-form',
        formIndex: 4,
        createActionUrl: '/backend/minus/create',
        select2Selector: '#review-minusids',
        modalSelector: '#minus-create-modal'
    });

}).on('submit', function (e) {
    e.preventDefault();
});

$('#deposit-create-form').on('beforeSubmit', function (e) {
    Model.create({
        validated: $(this).data('yiiActiveForm').validated,
        formId: 'deposit-create-form',
        formIndex: 5,
        createActionUrl: '/backend/deposit/create',
        select2Selector: '#review-depositids',
        modalSelector: '#deposit-create-modal'
    });

    return false;
}).on('submit', function (e) {
    e.preventDefault();
});

// Create review event
$('#review-create-form').on('beforeSubmit', function (e) {
    Model.create({
        validated: $(this).data('yiiActiveForm').validated,
        formId: 'review-create-form',
        formIndex: 1,
        createActionUrl: '/backend/review/create',
        select2Selector: '#company-reviewids',
        modalSelector: '#review-create-modal'
    });

    return false;
}).on('submit', function (e) {
    e.preventDefault();
});

function beforeSendHandler() {
    Loader.show();
}

var Model = {
    create: function (options) {
        if (options.validated) {
            options.fileSelector = options.fileSelector || '.filename';

            var $form = $('#' + options.formId);

            tinyMCE.triggerSave();
            // !!!!!don't saved without this line
            var form = document.getElementById(options.formId);
            var formData = new FormData(form);
            console.log($form.find('button[type="submit"]').selector);
            Loader.submitBtnSelector = $form.find('button[type="submit"]').selector;
            // submit form - saving file form via ajax
            $.ajax({
                url: options.createActionUrl,
                type: 'POST',
                beforeSend: beforeSendHandler,
                data: formData,
                success: function (response) {
                    Loader.hide();

                    if (response.success) {
                        Select2.appendItem(options.select2Selector, response.item);
                        form.reset();

                        Swalt.success('Success', 'Created');
                        // clear file input
                        $form.find(options.fileSelector).text('No file selected');
                        $(options.modalSelector).modal('hide');
                    } else {
                        Swalt.warning('Ops!', 'Not saved');
                    }
                },
                error: function (response) {
                    Swalt.warning('Oops!', 'Please, check review fields and try again');
                },
                cache: false,
                contentType: false,
                processData: false
            });
        } else {
            Swalt.warning('Oops!', 'Please, check fields and try again');
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
      console.log(options);
      var element = '<option value="'+ options.id +'">' + options.value + '</option>';
      $(blockId).append(element);
  }
};

function reviewAddressCallback(Editor) {
    Editor.on('NodeChange', function(e){
        tinyMCE.triggerSave();
    });
}