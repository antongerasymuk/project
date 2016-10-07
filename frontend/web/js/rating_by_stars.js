
riot.tag2('rating-by-stars', '<div class="rating" > <span class="star flaticon-star-{name}" each="{ name, i in opts.rating_array }"></span> </div>', '', '', function(opts) {
opts.rating_array =  ['empty','empty','empty','empty','empty'];
for( var i=0; i<parseInt(opts.rating/2);i++) {
opts.rating_array[i] = 'full';
}
if (opts.rating%2!=0) {
opts.rating_array[parseInt(opts.rating/2)] ='half';
}
//console.log(opts.rating_array);
});
riot.mount('rating-by-stars', {})
