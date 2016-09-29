
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
    function(opts) {
           console.log('Here');
           var self = this;
           self.companies_list = [] ;
               this.on('mount', function () {
               console.log(this);
               self.trigger('get');
           });

          this.on('get', function () {
               console.log('Get data');
               oboe('/company')
                .node('!.*', function(data){
                   //.done(function(data) {
                   console.log('here');
                     //  console.log(JSON.stringify(data[0]));
                    //self.companies_list = data;
                  //  index =data[0].title;

                     self.companies_list.push(data);
                     console.log(JSON.stringify(self.companies_list));
                     self.update();
                     console.log(JSON.stringify(self.companies_list));
                   })
                   .fail(function() {
                       console.log('Fail');
                   });

});
        console.log(JSON.stringify(companies_list));
   });


riot.mount('companies-list', {})
