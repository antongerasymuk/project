riot.tag2('companies-list', '<div class="row"> ' +
    '<div class="h-title">' +
    '<h2>UK Betting Sites</h2>' +
    '</div> <div class="betting-sites-items clearfix" >' +
    '<company-offer class="col-md-4 col-sm-6"  each="{ companies_list }" bg_color="{bg_color}" title="{title}" logo="{logo}" prices="{prices}">' +
    '</company-offer></div>' +
    '</div>' +
    '</div>',
    '',
    '',
    function (opts) {
        console.log('Here');
        var self = this;
        self.companies_list = [];
        this.on('mount', function () {
            console.log(this);
            self.trigger('get');
        });

        this.on('get', function () {
            console.log('Get data');
            oboe({
                url: 'http://bonus.loc/company', method: 'GET', headers: {
                    Accept: 'application/json'
                }
            })
                .node('!.*', function (data) {
                    console.log('Node');
                    console.log(data);
                })
                .done(function (data) {
                    console.log('Done');
                    console.log(data);
                })
                .fail(function (data) {
                    console.log(this.headers);
                });

        });
        console.log(JSON.stringify(companies_list));
    });


riot.mount('companies-list', {})
