
riot.tag2('company-offer', '<div class="item" riot-style="background-color: {opts.bg_color};">' +
    '<div class="img"><a href="{opts.company_url}"><img riot-src="{opts.logo}" alt=""></a></div>'+
    '<h3><a href="{opts.company_url}">{opts.title} Offers</a></h3>'+
    '<p>'+
    '<a each="{ name, value in opts.prices }"  href="/site/review?id={value.review_id}">{name}  {value.price}£</a>' +
    '</p> '+
    '</div>', '', '', function(opts) {
        //console.log(JSON.stringify(opts.title));
        opts.prices = {};

// Search company review
opts.company_url = '';

for (var i = 0; i < opts.reviews.length; i++) {
// 2 - it's company review type

if (opts.reviews[i].type == 2) {
    opts.company_url = '/site/review?id=' + opts.reviews[i].id;
}
}

for (var index = 0; index < opts.reviews.length; index++) {
    //console.log(opts.reviews[index].category);
    if (opts.reviews[index].category) {
        title = opts.reviews[index].category.title;
        title = title.charAt(0).toUpperCase() + title.substr(1); 
    }

    if (opts.reviews[index].bonuses) { 
        for (var bonus_index = 0; bonus_index < opts.reviews[index].bonuses.length; bonus_index++) { 
            if (opts.reviews[index].bonuses[bonus_index].type == 1) {
                //console.log('hello_1');
                opts.prices[ title ] = {price: opts.reviews[index].bonuses[bonus_index].price, review_id: opts.reviews[index].id};
                
            }
        }
    //console.log(JSON.stringify(prices));
    }
}

});

