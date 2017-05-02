riot.tag2('raw', '', '', '', function(opts) {
   
    if (opts.content == 'main_text') {
    	this.root.innerHTML = main_text;
    	return true;
    };

    if (opts.content == 'notes') {
    	this.root.innerHTML = notes;
    	return true;
    };

    this.root.innerHTML = opts.content;
});
