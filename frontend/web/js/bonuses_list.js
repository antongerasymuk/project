riot.tag2('bonuses-filter-list', '<div class="row">' +
    '<div class="h-title">' +
    '<h1>The UK\'s Top 15 Poker Sites</h1>' +
    '</div>' +
    '<div class="col-xs-12">' +
    '<table class="table-top-sites">' +
    '<thead>' +
    '<tr>' +
    '<th class="text-center">Rank</th>' +
    '<th class="text-left">Poker Site</th>' +
    '<th class="text-left">Rating</th> ' +
    '<th class="text-left">Bonus Details</th>' +
    '<th class="text-center">Compatible with</th>' +
    '<th class="text-center">Join site</th> ' +
    '</tr> </thead> <tbody> ' +
    '<tr each="{ bonuses_list }" > ' +
    '<td data-column="Rank">' +
    '<div class="rank">{rank}</div>' +
    '</td> <td data-column="Poker Site">' +
    '<div class="img">' +
    '<img riot-src="{logo}" alt="">' +
    '</div> ' +
    '<a href="#" class="psite">Read Review</a> ' +
    '</td> <td data-column="Rating" class="text-left">' +
    '<rating-by-stars rating="{rating}">' +
    '</rating-by-stars>' +
    '</td>' +
    '<td data-column="Bonus Details" class="text-left"> ' +
    '<div class="details"><raw content="{description }">' +
    '</div> ' +
    '</td> ' +
    '<td data-column="Compatible with" class="text-center"> ' +
    '<compatible-with params="{oses}"></compatible-with>'+
    '</td> ' +
    '<td data-column="Join site" class="text-center"> ' +
    '<div class="join-btn">' +
    '<button type="button" class="btn-dft">GET BONUS</button>' +
    '</div>' +
    '</td> ' +
    '</tr> ' +
    '</tbody> ' +
    '</table> ' +
    '</div>', '', '', function (opts) 
    {
        os = '\{"mac":"mac","windows":"windows", "android":"android"\}';
        var self = this;
        self.i = 0;
        self.bonuses_list = [];
        console.log(opts.category);
        this.on('mount', function () {
            console.log(this);
            self.trigger('get');
        });
        this.on('get', function () {
            console.log('Get data');
            oboe({
                url: '/bonuses?='+opts.category,
                headers:  {Accept: 'application/json'}, 

            })
             .node('!.*', function(data){

             console.log(JSON.stringify(data));
             self.bonuses_list[self.i++]= data;
            console.log(JSON.stringify(self.bonuses_list));
            self.update();

            }).fail(function(error) {
                console.log(error);
            });

    });

    /*
     bonuses_list = JSON.parse(opts.params);

<<<<<<< HEAD
$.each(bonuses_list, function (index, value) {
if (value.bonus_category != opts.filter) {
delete bonuses_list[index];
console.log(value.bonus_category);
console.log(index);
}
});*/


});
riot.mount('raw', {});
riot.mount('compatible-with', {});
riot.mount('bonuses-filter-list', {});