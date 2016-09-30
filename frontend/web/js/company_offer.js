
riot.tag2('company-offer', '<div class="item" riot-style="background-color: {opts.bg_color};">' +
    '<div class="img"><a href="#"><img riot-src="{opts.logo}" alt=""></a></div>'+
    '<h3><a href="#">{opts.title} Offers</a></h3>'+
    '<p>'+
    '<a each="{ name, value in prices }"  href="#">{name}  {value}£</a>' +
    '</p> '+
    '</div>', '', '', function(opts) {
    //console.log(JSON.stringify(opts));
    prices = {};
    for (i = 0; i < opts.reviews.length; i++) {
        index = opts.reviews[i].category.title;
        index = index.charAt(0).toUpperCase() + index.substr(1);
        prices[ index ] = opts.reviews[i].bonuses[0].price;
    }
    console.log(prices);
});

