riot.tag2('bookmaker-bonuses-list' ,
    
    '<h1>Gambling Bonuses</h1>'+
    '<div class="bonuses-items"> ' +
    '<bookmaker-bonus each="{ companies_list }" bg_color="{bg_color}" title="{title}" logo="{logo}" reviews="{reviews}">' +
    '</bookmaker-bonus>',
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
//console.log(JSON.stringify(self.companies_list));
self.update();
//console.log(JSON.stringify(self.companies_list[0].reviews));
}).fail(function() {
    console.log('Fail');
});

});
//console.log(JSON.stringify(companies_list));
});

riot.mount('bookmaker-bonus');
riot.mount('bookmaker-bonuses-list', {})
