//$('html, body').animate({ scrollTop: 0 }, 'fast');

//$(window).unbind('scroll');

riot.tag2('companies-list', '<div class="row"> ' +
    '<div class="h-title">' +
    '<h2>UK Betting Sites</h2>' +
    '</div> <div class="betting-sites-items clearfix" >' +
    '<div riot-tag="company-offer"   class="col-md-4 col-sm-6"   id="company-offer_{id}" each="{ companies_list }" style="{style}" bg_color="{bg_color}" title="{title}" logo="{logo_small}" reviews="{reviews}">' +
    '</div>' +
    '</div>' +
    '</div>' +
    '</div>',
    '',
    '',
    function(opts) {


        var self = this;
        self.companies_list = [];
           
        self.rew = { 
        "id": "", "title": "",
        "description": "", 
        "bg_color": "", 
        "logo": "", 
        "site_url": "", 
        "address": "", 
        "rating": "", 
        "director_id": "", 
        "style":"",
        "reviews": undefined };

        var start_limit = 3;
        var persent = 75;
        var limit = 6;
        var auto = true;
        var time = 1000;
        var number = 0;

        if (auto) {
            for (var n = 1; n <= 100; n++) {
                if (200*n > $(window).height()) {
                    number = n*3;
                    break;
                }

            }
            if (number > opts.count) {
                limit = opts.count;
                start_limit = opts.count;
            } else {
                limit = number;
                start_limit = number;
            }

        }
        
        for (i = 0; i < start_limit; i++) {
            self.companies_list.push(self.rew);
        }

        self.update();
        self.index = 0;
        self.preventUpdate = false;
        self.loaded_all = false;

        this.on('mount', function () {
            self.trigger('get');

        });
        
        this.on('get', function () {
                   
            oboe({
                url: '/company?&offset=0&limit='+start_limit,
                headers:  {Accept: 'application/json'},        
            })

            .node('!.*', function(data, path) {
                
                data.style = 'display:none;';
                self.companies_list[parseInt(path.toString())] = data;
                self.index++;
                self.update();
                          
                //time = time + 400;
            
                $('#company-offer_'+data.id).fadeIn(time);
            })
            .done(function(data){
                 self.trigger('get_two');

             })
            .fail(function() {
                console.log('Fail');
            });

            });

            var i = 0;
            var offset = start_limit;
            //var limit = start_limit;
            self.update();
            this.on('get_two', function () {
                $(window).bind("scroll", function() {

                    //console.log('scrolltop: ' +parseInt($(window).scrollTop()*100/persent));
                    //console.log('doc height: ' + $(document).height());
                    //console.log('win height:' + $(window).height());

                    if (($(document).height() - $(window).height() <= parseInt($(window).scrollTop()*100/persent))&& self.loaded_all == false) {
                        self.style = '';
                        self.loaded_all = true;


                        if (parseInt(self.companies_list.length + limit) <= parseInt(opts.count)) {
                            i_last = limit;
                        } else {
                            i_last = parseInt(opts.count) - parseInt(self.companies_list.length);
                        }

                        start_index = self.index;


                        for (i = 0; i < i_last; i++) {

                            self.companies_list.push(self.rew);
                        }

                        self.update();

                        //time = 400;

                        start_index = self.index;
                        console.log('start_index'+start_index);
                        oboe({
                            url: '/company?&offset='+offset+'&limit='+limit,
                            headers:  {Accept: 'application/json'},
                        })
                            .node('!.*', function(data, path){

                                self.loaded_all = false;
                                data.index = self.index;
                                data.style = 'display:none;';
                                self.companies_list[(parseInt(path.toString())+start_index)] = data;

                                self.update();

                                //time = time + 400;

                                $('#company-offer_'+data.id).fadeIn(time);
                                self.index++;

                            }).fail(function() {
                                console.log('Fail');
                            });
                        offset = offset+limit;
                    }
                });
            });
        
        
    });
riot.mount('company-offer');
riot.mount('companies-list', {});

