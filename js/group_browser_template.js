var GroupBrowserTemplate = function() {
	
	var base_url = window.location.origin;
    var pathArray = window.location.pathname.split( '/' );

	// ------------------------------------------------------------------------

	this.__construct = function() {
		console.log('Group Browser Template Created');
	};

	// ------------------------------------------------------------------------

	this.group = function(obj) {
		console.log(obj);
		var output = '';
		
//		output += '<div id=group_id_'+obj.clubID+'>';
		
//		output += 'Group ID: ' + obj.clubID + '<br>';
		output += '<a id=group_id_'+obj.clubID+' href="'+base_url + "/" + pathArray[1] 
			+ '/group/show/'+obj.clubID+'"> ' + obj.name + ' </a>';
//		output += 'Description: ' + obj.description + '<br>';
	
//		output += '</div>';
		return output;
	};

	// ------------------------------------------------------------------------
	
	this.tag = function(obj) {
		console.log(obj);
		var output = '';
		
//		output += '<div id=tag_id_' + obj.tagID + '>';
		
//		output += 'Tag ID: ' + obj.tagID + '<br>';
		output += '<a id=tag_id_' + obj.tagID + ' class="filter_click" '; 
		output += 'data-id="' + obj.tagID + '" data-name="'+obj.name+'" ';
		output += 'href="#"> ';
		output += '<button type="button" class="btn btn-primary btn-xs">';
	    output += obj.name;
	    output += '</button>';
	    output += ' </a>';
		
//		output += '</div>';
		return output;
	};
	
	this.__construct();
};
