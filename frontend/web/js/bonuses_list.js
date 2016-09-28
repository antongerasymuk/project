
riot.tag2('bonuses-filter-list', '<div class="row"> <div class="h-title"><h1>The UK\'s Top 15 {opts.filter} Sites</h1></div> <div class="col-xs-12"> <table class="table-top-sites"> <thead> <tr> <th class="text-center">Rank</th> <th class="text-left">{opts.filter} Site</th> <th class="text-left">Rating</th> <th class="text-left">Bonus Details</th> <th class="text-center">Compatible with</th> <th class="text-center">Join site</th> </tr> </thead> <tbody> <tr each="{ name, value in bonuses_list }" > <td data-column="Rank"><div class="rank">{value.rank}</div></td> <td data-column="{opts.filter} Site"> <div class="img"><img riot-src="{value.image}" alt=""></div> <a href="#" class="psite">Read Review</a> </td> <td data-column="Rating" class="text-left"><rating-by-stars rating="{value.bonuses_rating}"></rating-by-stars></td><td data-column="Bonus Details" class="text-left"> <div class="details"><raw content="{value.description }"></div> </td> <td data-column="Compatible with" class="text-center"> <compatible-with params="{value.os}"></compatible-with></td> <td data-column="Join site" class="text-center"> <div class="join-btn"><button type="button" class="btn-dft">GET BONUS</button></div> </td> </tr> </tbody> </table> </div>', '', '', function(opts) {
companies_list_old_prices = '\{"casino":"100","sport":200, "bingo":"100", "poker":"100"\}';
bonuses_list=JSON.parse(opts.params);

$.each(bonuses_list, function (index, value) {
  if (value.bonus_category != opts.filter) {
      delete bonuses_list[index];
      console.log(value.bonus_category);
      console.log(index);
  }
  });
});
riot.mount('raw', {});
riot.mount('compatible-with',{});
riot.mount('bonuses-filter-list', {});