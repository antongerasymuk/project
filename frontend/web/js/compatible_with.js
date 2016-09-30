riot.tag2('compatible-with', '<div class="compatible" > <span each="{compatibles}" class="flaticon-os-{title} {title}"></span> </div>', '', '', function(opts) {
console.log(opts.params);
    compatibles=opts.params;
});
