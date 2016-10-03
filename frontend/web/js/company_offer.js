
riot.tag2('company-offer', '<div class="item" riot-style="background-color: {opts.bg_color};">' +
    '<div class="img"><a href="#"><img riot-src="{opts.logo}" alt=""></a></div>'+
    '<h3><a href="#">{opts.title} Offers</a></h3>'+
    '<p>'+
    '<a each="{ name, value in prices }"  href="/site/review?id={value.review_id}">{name}  {value.price}£</a>' +
    '</p> '+
    '</div>', '', '', function(opts) {
    //console.log(JSON.stringify(opts));
    prices = {};

    for (var index = 0; index < opts.reviews.length; index++) {
        title = opts.reviews[index].category.title;
        title = title.charAt(0).toUpperCase() + title.substr(1);
        if (opts.reviews[index].bonuses) { 
             for (var bonus_index = 0; bonus_index < opts.reviews[index].bonuses.length; bonus_index++) { 
                if (opts.reviews[index].bonuses[bonus_index].type == 1) {
                    prices[ title ] = {price: opts.reviews[index].bonuses[bonus_index].price, review_id: opts.reviews[index].id};
                }
             }
        }
    }
});

