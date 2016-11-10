riot.tag2('bonuses-filter-list', 
    '<tr each="{ bonuses_list }" > ' +
    '<td data-column="Rank">' +
    '<div class="rank">{rank}</div>' +
    '</td> <td data-column="{opts.title} Site">' +
    '<div class="img">' +
    '<img riot-src="{logo}" alt="">' +
    '</div> ' +
    '<a href="/site/review?id={review_id}" class="psite">Read Review</a> ' +
    '</td> <td data-column="Rating" class="text-left">' +
    '<rating-by-stars rating="{rating}">' +
    '</rating-by-stars>' +
    '</td>' +
    '<td data-column="Bonus Details" class="text-left"> ' +
    '<div class="details"><raw content="{description }">' +
    '</raw>' +
    '</div> ' +
    '</td> ' +
    '<td data-column="Compatible with" class="text-center"> ' +
    '<compatible-with params="{oses}"></compatible-with>'+
    '</td> ' +
    '<td data-column="Join site" class="text-center"> ' +
    '<div class="join-btn">' +
    '<a href="{referal_url}">'+
    '<button type="button" class="btn-dft">'+
    'GET BONUS'+
    '</button>'+
    '</a>'+
    '</div>' +
    '<p if={code} class="code">Code: <span>{code}</span></p>'+
    '</td> ' +
    '</tr> ' 
    , '', '', function (opts) 
    {
        os = '\{"mac":"mac","windows":"windows", "android":"android"\}';
        console.log("MY");
        //console.log(opts.filter);
        var self = this;
        self.i = 0;
        self.bonuses_list = [];
        this.on('mount', function () {
            self.trigger('get');
        });
        this.on('get', function () {
            opts.category_filter = '';
            if(opts.category) {
                opts.category_filter = 'category_id='+opts.category;
                opts.category_filter_url = 'id='+opts.category;
            } 
            console.log('/bonus?'+opts.category_filter+opts.filter);
            history.pushState(null, null, '/site/category?'+opts.category_filter_url+opts.filter);
            oboe({
                url: '/bonus?'+opts.category_filter+opts.filter,
                headers:  {Accept: 'application/json'}, 
            })
            .node('!.*', function(data){

                //console.log(JSON.stringify(data.bonuses));
                self.bonuses_list[self.i++] = data;
                //console.log(JSON.stringify(self.bonuses_list));
                self.update();
            })
            .fail(function(error) {
                console.log(error);
            });

        });

    });
riot.mount('raw', {});
riot.mount('compatible-with', {});
riot.mount('bonuses-filter-list', {});