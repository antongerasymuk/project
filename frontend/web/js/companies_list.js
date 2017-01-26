
riot.tag2('companies-list', '<div class="row"> ' +
    '<div class="h-title">' +
    '<h2>UK Betting Sites</h2>' +
    '</div> <div class="betting-sites-items clearfix" >' +
    '<company-offer  style="display:none;" class="col-md-4 col-sm-6"  style="display:none;" each="{ companies_list }" id="company-offer_{index}" bg_color="{bg_color}" title="{title}" logo="{logo_small}" reviews="{reviews}">' +
    '</company-offer></div>' +
    '</div>' +
    '</div>',
    '',
    '',
    function(opts) {
        console.log('Here');
        var self = this;
        self.companies_list = [];
        self.index = 0;
        
        self.loaded_all = false;
        this.on('mount', function () {
            self.trigger('get');
        });
        this.on('get', function () {
            
            var start_limit = 6;
            var persent = 75;
            var limit = 6;
            var auto = true;

            
            var number = 0;
            if (auto) {
                for (var n = 1; n <= 100; n++) {
                  if (200*n > $(window).height()) {
                    number = n*3; 
                    break;
                }
            }
            console.log('number:'+number);

            limit = number;
            start_limit = number;
            }
         
            oboe({
                url: '/company?&offset=0&limit='+start_limit,
                headers:  {Accept: 'application/json'},        
            })
            .node('!.*', function(data,path){

                var itemIndex = path[path.length-1];
                data.index = self.index;
                self.companies_list.push(data);
   
                self.update();
                $('#company-offer_'+self.index).fadeIn(900);
                console.log('#company-offer_'+self.index);
                self.index++;
      
                
             })
            .fail(function() {
                console.log('Fail');
            });

            var current_index = [0];
            var i=0;
            var offset= start_limit;   
            $(window).scroll(function(){ 
                
               console.log('scrolltop: ' +parseInt($(window).scrollTop()*100/persent));
               console.log('doc height: ' + $(document).height());
               console.log('win height:' + $(window).height());
               if (($(document).height() - $(window).height() <= parseInt($(window).scrollTop()*100/persent))&& self.loaded_all == false) {
       
                self.loaded_all = true;
                if ($.inArray(i, current_index)>=0) {
                console.log('offset'+offset);
                oboe({
                    url: '/company?&offset='+offset+'&limit='+limit,
                    headers:  {Accept: 'application/json'},        
                })
                .node('!.*', function(data){
                    self.loaded_all = false;
                    data.index = self.index;
                    self.companies_list.push(data);
 
                    self.update();
                    $('#company-offer_'+self.index).fadeIn(900);
                    console.log('#company-offer_'+self.index);
                    self.index++;
                   
                }).fail(function() {
                    console.log('Fail');
                });
                console.log("index:"+i)
                offset = offset+limit;
                i++;
                current_index.push(i);
                }
           
            }
                
           // }
            });
        });
        //console.log(JSON.stringify(companies_list));
    });
riot.mount('company-offer');
riot.mount('companies-list', {});
