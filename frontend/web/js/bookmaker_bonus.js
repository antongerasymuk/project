
riot.tag2('bookmaker-bonus', '<div class="item">'+
   '<div class="tit"><a href="#">{opts.title}</a></div>'+
    '<ul>'+
     '<li each="{ name, value in opts.prices }">'+
     '<a href="/site/review?id={value.review_id}">{name}</a>: <span>£{value.price}</span>'+
     '</li>'+
    '</ul></div>', '', '', function(opts) {
    console.log(JSON.stringify(opts));
    opts.prices = {};
    opts.title  = "";
    for (var index = 0; index < opts.reviews.length; index++) {
       if (opts.reviews[index].category) {
        opts.title = opts.reviews[index].category.title;
        opts.title = opts.title.charAt(0).toUpperCase() + opts.title.substr(1);
        if (opts.reviews[index].bonuses) { 
             for (var bonus_index = 0; bonus_index < opts.reviews[index].bonuses.length; bonus_index++) { 
                if (opts.reviews[index].bonuses[bonus_index].type == 1) {
                   opts.prices[ opts.title ] = {price: opts.reviews[index].bonuses[bonus_index].price, review_id: opts.reviews[index].id};
                }
             }
        }
    }
}
});

