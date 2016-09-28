
riot.tag2('company-offer', '<div class="item" riot-style="background-color: {opts.bg_color};"> <div class="img"><a href="#"><img riot-src="{opts.logo}" alt=""></a></div> <h3><a href="#">{opts.title} Offers</a></h3> <p><a if="{ prices.casino }" href="#">Casino {prices.casino}£</a> <a if="{ prices.sport }" href="#">Sport  {prices.sport}£</a> <a if="{ prices.bingo }" href="#">Bingo  {prices.bingo}£</a> <a if="{ prices.poker }"  href="#">Poker  {prices.poker}£</a></p> </div>', '', '', function(opts) {
console.log(opts);
prices=JSON.parse(opts.prices);
//console.log(prices.casino);
});
//riot.mount('company-offer')
