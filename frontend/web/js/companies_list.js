
riot.tag2('companies-list', '<div class="row"> <div class="h-title"><h2>UK Betting Sites</h2></div> <div class="betting-sites-items clearfix" ><company-offer class="col-md-4 col-sm-6"  each="{ name, value in companies_list }" bg_color="{value.bg_color}" name="{value.name}" image="{value.image}" prices="{value.prices}"></company-offer></div> </div> </div>', '', '', function(opts) {
  companies_list_old_prices = '\{"casino":"100","sport":200, "bingo":"100", "poker":"100"\}';
  companies_list=JSON.parse(opts.params);
  //console.log(companies_list.Ladbrokes.prices);
  //companies_list_array=Object.keys(companies_list).map(function (key) { console.log(companies_list[key]); });
});

riot.mount('companies-list', {})
