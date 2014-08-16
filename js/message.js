var Message = function() {

	// ------------------------------------------------------------------------

	this.__construct = function() {
		console.log('Message System Created');
	};

	// ------------------------------------------------------------------------

	this.success = function(msg) {

		console.log(msg);
		var dom = $("#success");
		dom.html(msg);

		dom.fadeIn();

		setTimeout(function() {
			dom.fadeOut();
		}, 5000);
	};

	// ------------------------------------------------------------------------

	this.error = function(msg) {

		console.log(msg);
		var dom = $("#error");
		dom.html(msg);

		dom.fadeIn();

		setTimeout(function() {
			dom.fadeOut();
		}, 5000);
	};

	// ------------------------------------------------------------------------

	this.__construct();

};