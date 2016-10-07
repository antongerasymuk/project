

get = JSON.parse($('#bonuses-filter-list').attr('get'));
$.each(get , function( index, value ) {
   var key;
   switch (index) {
    case 'filter_by':
    key = "filter";
    break;
    case 'sort_by':
    key = "sort";
    break;
    case 'os_id':
    key = "os";
    break;
}

if (index == 'country_id' ) {
    $("#countries option[option='"+value+"']").prop('selected', true);

}

if (index == 'deposit_id' ) {
  $("#banking option[option='"+value+"']").prop('selected', true);
}

makeActive($("button[data-type="+key+"][data-filter ="+value+"]"));

});


$('.btn-filter').on('click', function () {
    var $button = $(this);
    makeActive($button);
});

$('.btn-comp').on('click', function () {
    var $button = $(this);
    makeActive($button);
});
function makeActive($button) {
    $button.parent().children().removeClass('active');
    $button.addClass('active');
}

$(document).ready(function() {

    $('.close-filters').on('click', function () {
       $('.h-filters').toggle();
    });

    $(".f-select").change(function() { 

        country_id = $("#countries option:selected").attr('option');
        deposit_id = $("#banking option:selected").attr('option');
        console.log($(this).attr('id'));
        if ($(this).attr('id') == 'banking') {
            filter_string = makeFilterSelector('deposit_id',deposit_id);
        }
        if ($(this).attr('id') == 'countries') {
            filter_string = makeFilterSelector('country_id',deposit_id);
        }

        $('#bonuses-filter-list').attr("filter" , filter_string);
        riot.mount('bonuses-filter-list', {});
    });   

    $(".filter-gp button").click(function() { 

        filter_string = makeFilter($(this)) ;

        $('#bonuses-filter-list').attr("filter" , filter_string);
        riot.mount('bonuses-filter-list', {});
    });

});
function makeFilter(object) {
  var key = "";
  if (object.attr("data-type")) {
      switch (object.attr("data-type")) {
        case 'filter':
        key = "&filter_by=";
        break;
        case 'sort':
        key = "&sort_by=";
        break;
        case 'os':
        key = "&os_id=";
        break;
    }
    var filter_string = $('#bonuses-filter-list').attr('filter');
    filter_string = filter_string.replace(new RegExp("&"+key+"\\d+?&"), '&'); 
    filter_string = filter_string.replace(new RegExp("&"+key+"\\d+"), ''); 
    filter_string = filter_string + key + object.attr("data-filter");
    return filter_string;
}
}
function makeFilterSelector(key,value) {
 var current_filter_string = $('#bonuses-filter-list').attr('filter'); 
 current_filter_string = current_filter_string.replace(new RegExp("&" + key + "=\\d+?&"), '&'); 
 current_filter_string = current_filter_string.replace(new RegExp("&" + key + "=\\d+"), ''); 
 current_filter_string = current_filter_string + "&" + key + "=" + value;
 return current_filter_string;

}