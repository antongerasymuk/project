
riot.tag2('companies-list', '<div class="row"> ' +
    '<div class="h-title">' +
    '<h2>UK Betting Sites</h2>' +
    '</div> <div class="betting-sites-items clearfix" >' +
    '<company-offer class="col-md-4 col-sm-6"  each="{ name, value in companies_list }" bg_color="{value.bg_color}" title="{value.title}" logo="{value.logo}" prices="{value.prices}">' +
    '</company-offer></div>' +
    '</div>' +
    '</div>',
    '',
    '',
    function(opts) {
        console.log('Here');
        var self = this;

        this.on('mount', function () {
            console.log('Mounted');
            self.trigger('get');
        });

        this.on('get', function () {
            console.log('Get data');
            oboe('/company')
                .done(function(data) {
                    console.log(data);
                    self.companies_list = data;
                    self.update();
                })
                .fail(function() {
                    console.log('Fail');
                });
        });
        // companies_list_old_prices = '\{"casino":"100","sport":200, "bingo":"100", "poker":"100"\}';
        //console.log(opts.params);
        // companies_list=opts.params;
        // console.log(JSON.stringify(companies_list));
        // console.log(companies_list['Ladbrokes']);
        //companies_list_array=Object.keys(companies_list).map(function (key) { console.log(companies_list[key]); });
});

var CompaniesController = function () {
    riot.observable(this);
};

var companiesController = new CompaniesController();

riot.mount('companies-list', {})

