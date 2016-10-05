riot.tag2('compatible-with', '<div class="compatible" > <span each="{opts.compatibles}" class="flaticon-os-{title} {title}"></span> </div>', '', '', function(opts) {
console.log(opts.params);
    opts.compatibles=opts.params;
});
