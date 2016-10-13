
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
            self.trigger('get');
        });
        this.on('get', function () {
            
            var start_limit = 2;
            var persent = 65;
            var limit = 1;
         
            oboe({
                url: '/company?&offset=0&limit='+start_limit,
                headers:  {Accept: 'application/json'},        
            })
            .node('!.*', function(data,path){

                var itemIndex = path[path.length-1];
                self.companies_list.push(data);
                //if( itemIndex == item_index-1 ) {
                //   this.forget();
                //} 
                self.update();
             }).fail(function() {
                console.log('Fail');
            });

            var current_index = [0];
            var i=0;
            var offset= start_limit;   
            $(window).scroll(function(){ 
            //$('.betting-sites-items').scroll(function(){ 
                
               console.log('scrolltop: ' +parseInt($(window).scrollTop()*100/persent));
               console.log('doc height: ' + $(document).height());
               console.log('win height:' + $(window).height());
               if ($(document).height() - $(window).height() <= parseInt($(window).scrollTop()*100/persent)) {
               //if ( (parseInt($(window).height()*(index)) < parseInt($(window).scrollTop())) && (parseInt($(window).height()*(index+1)) > parseInt($(window).scrollTop()))&& ($.inArray(index, current_index)<0) ){
               
               
                if ($.inArray(i, current_index)>=0) {
                console.log('offset'+offset);
                oboe({
                    url: '/company?&offset='+offset+'&limit='+limit,
                    headers:  {Accept: 'application/json'},        
                })
                .node('!.*', function(data){
                    self.companies_list.push(data);
                    self.update();
                    //console.log(JSON.stringify(self.companies_list[0].reviews));
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
