
$(document).ready(function() {

    $('.s-fb,.s-gp,.s-tw').click(function(e) {
        e.preventDefault();
        window.open($(this).attr('href'), 'ShareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
        return false;
    });
    
    $('body').on('click', '.get-bonus', function() {
        $.get("/bonus/number?mode=check"); 
    });

});

/*function check(){
    console.log('hell');
    $.get("http://bonus/bonus/number?mode=check" ); 
}*/

if ($('#bonuses-filter-list').attr('get')) {
    get = JSON.parse($('#bonuses-filter-list').attr('get'));
} else {
    get = '';
}

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

if (key != undefined){
    makeActive($("button[data-type="+key+"][data-filter ="+value+"]"));
}

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
    var desktop =  true;
     $('.close-filters').on('click', function () {
        $('.header-top').css('z-index' , '20');
        console.log("deskpot:"+desktop+$('.hpoker').height());
        var height;
        if (desktop) {
            height = '260';
        } else {
            height = '400';
        }
        if ($('.hpoker').height() == 60) {
            
            //$('.hpoker').removeAttr("style");
            $('.hpoker').animate({ 
            height: height}, 300, function() {$('.hpoker').removeAttr('style') });
            $('.h-filters').slideToggle( 300 );
        } else { 
            if ($('.hpoker').height() == '400') {
               desktop =  false; 
            }
            $('.hpoker').height('auto');
            $('.h-filters').slideToggle( 300 );
            
        }
    });

    $(".f-select").change(function() { 

        country_id = $("#countries option:selected").attr('option');
        deposit_id = $("#banking option:selected").attr('option');
        console.log($(this).attr('id'));
        if ($(this).attr('id') == 'banking') {
            filter_string = makeFilterSelector('deposit_id',deposit_id);
        }
        if ($(this).attr('id') == 'countries') {
            filter_string = makeFilterSelector('country_id',country_id);
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

        get.filter_by = object.attr("data-filter");

        switch(get.filter_by) {
            case '1':
            get.action = '';
            break;
            case '0':
            get.action = 'no-deposit';
            break;
            case '2':
            get.action = 'codes';
            break;
        }
        
        $('#bonuses-filter-list').attr('get', JSON.stringify(get));

        break;
        case 'sort':
        key = "&sort_by=";
        break;
        case 'os':
        key = "&os_id=";
        break;
    }
    console.log('key');
    console.log(key);
    var filter_string = $('#bonuses-filter-list').attr('filter');
    //filter_string = filter_string.replace(new RegExp("&action="+"\\d{0,}&"),''); 
    filter_string = filter_string.replace(new RegExp(key+"\\d+?&"), '&'); 
    filter_string = filter_string.replace(new RegExp(key+"\\d+"), ''); 
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