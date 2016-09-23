
riot.tag2('company-offer', '<div class="item" riot-style="background-color: {opts.bg_color};"> <div class="img"><a href="#"><img riot-src="{opts.image}" alt=""></a></div> <h3><a href="#">{opts.name}</a></h3> <p><a href="#">Casino {prices.casino}£</a> <a href="#">Sport  {prices.sport}£</a> <a href="#">Bingo  {prices.bingo}£</a> <a href="#">Poker  {prices.poker}£</a></p> </div>', '', '', function(opts) {
//console.log(opts.prices);
prices=JSON.parse(opts.prices);
//console.log(prices.casino);
});
//riot.mount('company-offer')
