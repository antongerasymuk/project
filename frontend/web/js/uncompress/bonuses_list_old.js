riot.tag2('bonuses-filter-list', 
    '<tr each="{ bonuses_list }" > ' +
    '<td data-column="Rank">' +
    '<div class="rank">{rank}</div>' +
    '</td> <td data-column="{opts.title} Site">' +

    '<div class="img">' +

    '<div class="img-item" style="background-color:{bg_color}; background-image:url({logo}); background-repeat: no-repeat; background-position: center; margin-left:0px;">' +
    '</div>' +
     //background-color:<?= $companyReview->bg_color ?>; background-image:url(<?= $companyReview->logo ?>);background-repeat: no-repeat; background-position: center;
    //'<img riot-src="{logo}" alt="">' +
    '</div> ' +
    '<a href="{href}" class="psite">Read Review</a> ' +
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
    '<a href="{encodeURI(referal_url)}">'+
    '<button type="button"  class="get-bonus btn-dft">'+
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
                opts.filter = opts.filter.replace(new RegExp("&v="+"\\d+"), '');
                get = JSON.parse($('#bonuses-filter-list').attr('get'));
                console.log(get.action);
                opts.time = Math.floor(Date.now() / 1000);
            } 
            console.log('/bonus?'+opts.category_filter+opts.filter);

            if (get.action != undefined) {
                history.pushState(null, null, '/'+get.controller+'/'+get.action);
            }
            oboe({
                url: '/bonus?'+opts.category_filter+opts.filter+'&v='+opts.time,
                headers:  {Accept: 'application/json'}, 
            })
            .node('!.*', function(data){

                //console.log(JSON.stringify(data.bonuses));
                if (data.slug.length) {
                    data.href = '/'+opts.title.toLowerCase()+'/'+data.slug.toLowerCase();
                } else {
                    data.href = '/site/review?id='+data.review_id;
                }
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