riot.tag2('companies-list', '<div class="row"> ' +
    '<div class="h-title">' +
    '<h2>UK Betting Sites</h2>' +
    '</div> <div class="betting-sites-items clearfix" >' +
    '<company-offer class="col-md-4 col-sm-6"  each="{ companies_list }" bg_color="{bg_color}" title="{title}" logo="{logo}" reviews="{reviews}">' +
    '</company-offer></div>' +
    '</div>' +
    '</div>',
    '',
    '',
    function(opts) {
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
                url: '/company',
                headers:  {Accept: 'application/json'},        

            })
            .node('!.*', function(data){
//.done(function(data) {

    console.log('here');
    self.companies_list.push(data);
console.log(JSON.stringify(self.companies_list));
self.update();
//console.log(JSON.stringify(self.companies_list[0].reviews));
}).fail(function() {
    console.log('Fail');
});

});
//console.log(JSON.stringify(companies_list));
});

riot.mount('company-offer');
riot.mount('companies-list', {});
