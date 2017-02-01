
riot.tag2('bookmaker-bonus', '<div class="item">'+
   '<div class="tit"><a href="{opts.company_url}">{opts.title}</a></div>'+
    '<ul>'+
     '<li each="{ name, value in opts.prices }">'+
     '<a href="{value.url}">{name}</a>: <span>{value.currency}{value.price}</span>'+
     '</li>'+
    '</ul></div>', '', '', function(opts) {
    console.log(JSON.stringify(opts));
    opts.prices = {};
   opts.company_url = '';

   for (var i = 0; i < opts.reviews.length; i++) {
    if (opts.reviews[i].type != 2) {

        if (opts.reviews[i].slug != '') {
            opts.reviews[i].url = '/' + opts.reviews[i].slug.toLowerCase();
        } 
        else {
            opts.reviews[i].url = '/site/review?id=' + opts.reviews[i].id;
        }
    }

    if (opts.reviews[i].type == 2) {
        if (opts.reviews[i].slug != '') {
            console.log('slug'+opts.reviews[i].slug);
            opts.company_url = '/' + opts.reviews[i].slug.toLowerCase();
        } else {
            opts.company_url = '/site/review?id=' + opts.reviews[i].id;
        }
    }
    }  


    opts.title  = "";
    for (var index = 0; index < opts.reviews.length; index++) {
       if (opts.reviews[index].category) {
        opts.title = opts.reviews[index].category.title;
        opts.title = opts.title.charAt(0).toUpperCase() + opts.title.substr(1);
        if (opts.reviews[index].bonuses) { 
             for (var bonus_index = 0; bonus_index < opts.reviews[index].bonuses.length; bonus_index++) { 
                if (opts.reviews[index].bonuses[bonus_index].type == 1) {
                    currency = opts.reviews[index].bonuses[bonus_index].currency;
                    if (currency == '') {
                        currency = '£';
                    } 
                    opts.prices[ opts.title ] = {price: opts.reviews[index].bonuses[bonus_index].price, review_id: opts.reviews[index].id, currency: currency, url: opts.reviews[index].url};
                }
             }
        }
    }
}
});

