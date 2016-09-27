
riot.tag2('rating-by-stars', '<div class="rating" > <span class="star flaticon-star-{rating_array[i]}" each="{ name, i in rating_array }"></span> </div>', '', '', function(opts) {
rating_array =  ['empty','empty','empty','empty','empty'];
for( var i=0; i<parseInt(opts.rating/2);i++) {
rating_array[i] = 'full';
}
if (opts.rating%2!=0) {
rating_array[parseInt(opts.rating/2)] ='half';
}
});
riot.mount('rating-by-stars', {})
