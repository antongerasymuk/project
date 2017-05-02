
riot.tag2('company-offer', '<div class="item" riot-style=" background-color: {opts.bg_color};">' +
    '<virtual if="{opts.reviews}">' +
    '<div class="img"><a href="{opts.company_url}"><img riot-src="{opts.logo}" alt=""></a></div>' +
    '<h3><a href="{opts.company_url}">{opts.title} Offers</a></h3>' +
    '<p>' +
    '<a each="{ name, value in opts.prices }"  href="{value.url}">{name}  {value.currency}{value.price}</a>' +
    '</p>' +
    '</virtual>' +

    '<virtual if="{opts.reviews === undefined }">' +
      
    '<div class="spinner">' +
    '<div class="dot1"></div>' +
    '<div class="dot2"></div>' +
    '</div>' +

    '</virtual>' +

    '</div>', '', '', function(opts) {
        //console.log(JSON.stringify(opts.title));
        opts.prices = {};

// Search company review
opts.company_url = '';
console.log('reviews'+(typeof opts.reviews));
console.log(opts.reviews);
if ( opts.reviews != undefined) {
for (var i = 0; i < opts.reviews.length; i++) {
// 2 - it's company review type

if (opts.reviews[i].type != 2) {

if (opts.reviews[i].slug != '') {
        opts.reviews[i].url = '/'+opts.reviews[i].category.title.toLowerCase() +'/'+ opts.reviews[i].slug.toLowerCase();
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

for (var index = 0; index < opts.reviews.length; index++) {
    if (opts.reviews[index].category) {
        title = opts.reviews[index].category.title;
        title = title.charAt(0).toUpperCase() + title.substr(1); 
    }

    if (opts.reviews[index].bonuses) { 
        for (var bonus_index = 0; bonus_index < opts.reviews[index].bonuses.length; bonus_index++) { 
            if (opts.reviews[index].bonuses[bonus_index].type == 1) {
                currency = opts.reviews[index].bonuses[bonus_index].currency;
                if (currency == '') {
                    currency = '£';
                } 
                opts.prices[ title ] = {price: opts.reviews[index].bonuses[bonus_index].price, review_id: opts.reviews[index].id, currency: currency, url: opts.reviews[index].url};
                
            }
        }
    //console.log(JSON.stringify(prices));
    }
}
}
});

