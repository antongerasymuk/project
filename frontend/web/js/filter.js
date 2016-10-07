
//console.log($('#bonuses-filter-list').attr('get'));

  //$("#countries option").attr('option', '2');
 // $("#banking option[option='2']").prop('selected', true);
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
  console.log( $("button[data-type="+key+"][data-filter ="+value+"]").attr('data-filter'));
  console.log(key);
  console.log( index + ": " + value );
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
   
  
    $(".f-select").change(function() { 

        country_id = $("#countries option:selected").attr('option');
        console.log('country_id');
        console.log($("#countries option:selected").attr('option'));
        deposit_id = $("#banking option:selected").attr('option');

        filter_string = $('#bonuses-filter-list').attr('filter');
        filter_string = filter_string.replace(new RegExp("&deposit_id=\\d+?&"), '&'); 
        filter_string = filter_string.replace(new RegExp("&deposit_id=\\d+"), ''); 
        filter_string = filter_string + "&deposit_id=" + deposit_id;

        filter_string = filter_string.replace(new RegExp("&country_id=\\d+?&"), '&'); 
        filter_string = filter_string.replace(new RegExp("&country_id=\\d+"), ''); 
        filter_string = filter_string + "&country_id=" + country_id;
        $('#bonuses-filter-list').attr("filter" , filter_string);
        riot.mount('bonuses-filter-list', {});
    });   

    $(".filter-gp button").click(function() { 
        filter_string = $('#bonuses-filter-list').attr('filter');
        filter_string = makeFilter($(this), filter_string) ;

        $('#bonuses-filter-list').attr("filter" , filter_string);
        riot.mount('bonuses-filter-list', {});
    });

});
function makeFilter(object,filter_string) {
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

    filter_string = filter_string.replace(new RegExp("&"+key+"\\d+?&"), '&'); 
    filter_string = filter_string.replace(new RegExp("&"+key+"\\d+"), ''); 
    filter_string = filter_string + key + object.attr("data-filter");
    return filter_string;
}
}