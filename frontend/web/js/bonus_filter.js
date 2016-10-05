
$('.btn-filter').on('click', function () {
    var $button = $(this);
    makeActive($button);

    Filter.start();
});

$('.btn-comp').on('click', function () {
    var $button = $(this);
    makeActive($button);
    Filter.start();
});

function makeActive($button) {
    $button.parent().children().removeClass('active');
    $button.addClass('active');
}
var Filter = {
    params: {
        sort_by: '',
        filter_by: '',
        // country: '',
        category_id: 1,
        // dep_method: ''
    },
    getAllParams: function () {
        this.params.sort_by = $('.active[data-type="sort"]').data('filter');
        this.params.filter_by = $('.active[data-type="filter"]').data('filter');
    },
    start: function () {
        this.getAllParams();
        console.log(this.params);

        $.ajax({
            url: '/bonus?category_id=1&filter_by=2&sort_by=1',
            method: 'GET',
            success: function (response) {
                console.log(response);
            }
        });
    }
};