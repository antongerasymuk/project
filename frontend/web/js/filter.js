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
        $(".filter-gp button").click(function() { 
        makeFilter($(this)) ;
         //console.log('here');
         //console.log($('#bonuses-filter-list').attr('category'));
         //console.log('data-filter:');
         //console.log($(this).attr("data-filter")); 
        /* filter_string = $('#bonuses-filter-list').attr('filter');
         if ($(this).attr("data-type") == 'filter') {
         filter_string = filter_string.replace(new RegExp("&filter_by=\\d+?&"), '&'); 
         filter_string = filter_string.replace(new RegExp("&filter_by=\\d+"), ''); 
         filter_string = filter_string + "&filter_by="+ $(this).attr("data-filter");
     }
             if ($(this).attr("data-type") == 'sort') {
         filter_string = filter_string.replace(new RegExp("&sort_by=\\d+?&"), '&'); 
         filter_string = filter_string.replace(new RegExp("&sort_by=\\d+"), ''); 
         filter_string = filter_string + "&sort_by="+ $(this).attr("data-filter");
     }
        if ($(this).attr("data-type") == 'os') {
         filter_string = filter_string.replace(new RegExp("&os_id=\\d+?&"), '&'); 
         filter_string = filter_string.replace(new RegExp("&os_id=\\d+"), ''); 
         filter_string = filter_string + "&os_id="+ $(this).attr("data-filter");
     }

         $('#bonuses-filter-list').attr("filter" , filter_string);
          riot.mount('bonuses-filter-list', {});
     });*/

  });
  function makeFilter(object) {
  var key = "";
  if (object.attr("data-type")) {
  switch (object) {
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
    }