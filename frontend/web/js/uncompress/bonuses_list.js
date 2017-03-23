riot.tag2('bonuses-filter-list',
    '<div class="h-title"><h1 style="font-weight:bold; !important;">{ list_title }</h1></div>' +
    '<div class="col-xs-12">' +
    '<table class="table-top-sites"  style="table-layout:fixed;">'+
    '<thead>' +
    '<tr>'+
    '<th class="text-center" style="width:7%;">Rank</th>' +
    '<th class="text-left"   style="width:18%;"><?= ucfirst($title) ?> Site</th>' +
    '<th class="text-left"  style="width:9.5%;">Rating</th>' +
    '<th class="text-left" style="width:28%;">Bonus Details</th>' +
    '<th class="text-center" style="width:17%;">Compatible with</th>' +
    '<th class="text-center" style="width:20.5%;">Join site</th>' +
    '</tr>'+
    '</thead>'+
    '<tbody>' +
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
    '<button type="button"  class="get-bonus btn-dft" url="{encodeURI(referal_url)}" >'+
    'GET BONUS'+
    '</button>'+
    '</div>' +
    '<p if={code} class="code">Code: <span>{code}</span></p>'+
    '</td> ' +
    '</tr> '+
     '</tbody>'+
    '</table>' +
    '</div>' +
    '<div class="clearfix"></div>' +
    '<div class="static-content">' +
    '<p class="text-center" >'+
    '<raw content="{main_text }">' +
    '</raw>'+
    '</p>' +
    '<div class="info-block" if="{notes}" >' +
    '<span><strong>Please Note:</strong></span>' +
    '<ul class="list-disc">' +
    '<raw content="{notes}">' +
    '</raw>'+
    '</ul>' +
    '</div>'
    , '', '', function (opts) 
    {
        os = '\{"mac":"mac","windows":"windows", "android":"android"\}';

        //console.log(opts.filter);
        var self = this;
        self.i = 0;
        self.bonuses_list = [];
        self.list_title = '';
        self.main_text = '';
        self.notes = '';

        get = JSON.parse($('#bonuses-filter-list').attr('get'));
        this.on('mount', function () {
            self.trigger('get');
        });
        this.on('get', function () {
            opts.category_filter = '';
            if(opts.category) {
                opts.category_filter = 'category_id='+opts.category;
                opts.category_filter_url = 'id='+opts.category;
                opts.filter = opts.filter.replace(new RegExp("&v="+"\\d+"), '');
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
                .done(function(data){

                    switch(parseInt(get.filter_by)) {

                        case 0:
                            main_text = texts.no_deposit_main_text;
                            notes = texts.no_deposit_notes;
                            self.list_title = texts.no_deposit_list_title;
                            
                            if (main_text) {
                                self.main_text = 'main_text';
                            }                          
                            
                            if (notes) {
                                self.notes = 'notes';
                            }

                            $("meta[name='title']").attr("content", meta_tags.meta_title_no_deposit);
                            $("meta[name='description']").attr("content", meta_tags.meta_description_no_deposit);
                            $("meta[name='keywords']").attr("content", meta_tags.meta_keywords_no_deposit);

                            break;

                        case 2:
                            main_text = texts.code_main_text;
                            notes = texts.code_notes;
                            self.list_title = texts.code_list_title;
                            
                            if (main_text) {
                                self.main_text = 'main_text';
                            }
                            
                            if (notes) {
                                self.notes = 'notes';
                            }
                            
                            $("meta[name='title']").attr("content", meta_tags.meta_title_code);
                            $("meta[name='description']").attr("content", meta_tags.meta_description_code);
                            $("meta[name='keywords']").attr("content", meta_tags.meta_keywords_code);

                            break;

                        default:
                            main_text = texts.main_text;
                            notes = texts.notes;
                            self.list_title = texts.list_title;
                            
                            if (main_text) {
                                self.main_text = 'main_text';
                            }
                            
                            if (notes) {
                                self.notes = 'notes';
                            }
                            
                            $("meta[name='title']").attr("content", meta_tags.meta_title);
                            $("meta[name='description']").attr("content", meta_tags.meta_description);
                            $("meta[name='keywords']").attr("content", meta_tags.meta_keywords);
                    };

                    self.update();
                    riot.mount('raw', {});

                })
            .fail(function(error) {
                console.log(error);
            });

        });

    });
//riot.mount('raw', {});
riot.mount('compatible-with', {});
riot.mount('bonuses-filter-list', {});