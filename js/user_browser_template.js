var UserBrowserTemplate = function() {

	// ------------------------------------------------------------------------

	this.__construct = function() {
		console.log('Group Browser Template Created');
	};

	var base_url = window.location.origin;
	var pathArray = window.location.pathname.split('/');

	// ------------------------------------------------------------------------

	this.user = function(obj) {
		console.log(obj);
		var output = '';

		// output += '<div id=group_id_'+obj.clubID+'>';

		// output += 'Group ID: ' + obj.clubID + '<br>';
		output += '<a id=user_id_' + obj.userID + ' href="' + base_url + "/"
				+ pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/user/show/' + obj.userID + '"> '
				+ obj.firstName + " " + obj.lastName + '</a>';
		// output += 'Description: ' + obj.description + '<br>';

		// output += '</div>';
		return output;
	};

	// ------------------------------------------------------------------------

	this.filter = function(obj) {
		console.log(obj);
		var output = '';

		// output += '<div id=tag_id_' + obj.tagID + '>';

		// output += 'Tag ID: ' + obj.tagID + '<br>';
		output += '<a id=filter_name_' + obj + ' class="filter_click" ';
		output += 'data-name="' + obj + '" ';
		output += 'href="#">';
		output += '<button type="button" class="btn btn-primary btn-xs">';
	    output += obj;
	    output += '</button>';
	    output += ' </a>';

		// output += '</div>';
		return output;
	};

	this.__construct();
};
