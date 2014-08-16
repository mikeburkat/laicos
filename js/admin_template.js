var AdminTemplate = function() {

	// ------------------------------------------------------------------------

	this.__construct = function() {
		console.log('Admin Template Created');
	};

	var base_url = window.location.origin;
	var pathArray = window.location.pathname.split('/');

	// ------------------------------------------------------------------------

	this.adminUser = function(user) {
		var output = '';
		
		output += '<tr>' 
			+ '<td>' + user.firstName + " " + user.lastName + '</td>'
			+ '<td>' + user.status + '</td>'
			+ '<td>';
			
			if (user.status == 'active') {
				output += '<button id="suspend" type="button" data-userID="' + user.userID + '" class="btn btn-danger">Suspend</button>'
				+ '  '
				+ '<button id="inactivate" type="button" data-userID="' + user.userID + '" class="btn btn-default">Inactivate</button>';
			}
			
			else if (user.status == 'inactive') {
				output += '<button id="suspend" type="button" data-userID="' + user.userID + '" class="btn btn-danger">Suspend</button>'
				+ '  '
				+ '<button id="activate" type="button" data-userID="' + user.userID + '" class="btn btn-success">Activate</button>';
			} 
			
			else if (user.status == 'suspended') {
				output += '<button id="activate" type="button" data-userID="' + user.userID + '" class="btn btn-success">Activate</button>'
				+ '  '
				+ '<button id="inactivate" type="button" data-userID="' + user.userID + '" class="btn btn-default">Inactivate</button>';
			}
			
			output += '</td>'
			+ '</tr>';
		
		return output;
	};
	
	// ------------------------------------------------------------------------

	this.seniorityRequest = function() {
		var output = '';
		output += 'You may request to be made a Senior member of Laicos ' 
			+ '<button id="request_senior_button" type="button" class="btn btn-success">Request</button>';
		return output;
	};
	
	// ------------------------------------------------------------------------

	this.adminRequest = function() {
		var output = '';
		output += 'You may request to be made an Administrator of Laicos ' 
			+ '<button id="request_admin_button" type="button" class="btn btn-success">Request</button>';
		return output;
	};
	
	// ------------------------------------------------------------------------
	
	this.activeButtons = function(i) {
		return '<button id="suspend" type="button" data-userID="' + i + '" class="btn btn-danger">Suspend</button>'
		+ '  '
		+ '<button id="inactivate" type="button" data-userID="' + i + '" class="btn btn-default">Inactivate</button>';
	};
	
	// ------------------------------------------------------------------------
	
	this.inactiveButtons = function(i) {
		return '<button id="suspend" type="button" data-userID="' + i + '" class="btn btn-danger">Suspend</button>'
		+ '  '
		+ '<button id="activate" type="button" data-userID="' + i + '" class="btn btn-success">Activate</button>';
	};
	
	// ------------------------------------------------------------------------
	
	this.suspendedButtons = function(i) {
		return '<button id="activate" type="button" data-userID="' + i + '" class="btn btn-success">Activate</button>'
		+ '  '
		+ '<button id="inactivate" type="button" data-userID="' + i + '" class="btn btn-default">Inactivate</button>';
	};
	
	// ------------------------------------------------------------------------
	
	
	// ------------------------------------------------------------------------
	
	
	// ------------------------------------------------------------------------

	
	// ------------------------------------------------------------------------
	
	
	
	// ------------------------------------------------------------------------
	
	
	// ------------------------------------------------------------------------
	
	
	
	// ------------------------------------------------------------------------
	
	
	// ------------------------------------------------------------------------

	

	// ------------------------------------------------------------------------

	
	
	// ------------------------------------------------------------------------
	
	
	
	// ------------------------------------------------------------------------


	// ------------------------------------------------------------------------
	
	
	// ------------------------------------------------------------------------

	this.__construct();
};