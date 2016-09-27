riot.tag2('compatible-with', '<div class="compatible" > <span each="{name, value in compatibles}" class="flaticon-os-{value} {value}"></span> </div>', '', '', function(opts) {
compatibles=JSON.parse(opts.params);
});
