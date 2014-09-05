var UserTemplate = function() {

	// ------------------------------------------------------------------------

	this.__construct = function() {
		console.log('User Template Created');
	};

	var base_url = window.location.origin;
	var pathArray = window.location.pathname.split('/');

	// ------------------------------------------------------------------------

	var editOptions = function() {
		edit_button = '<a href="' + base_url + '/' + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/user/settings' + '" >'
			+ '<button type="button" class="btn btn-primary">Edit My Profile</button>'
			+ '</a>';
		$('#edit_profile').html(edit_button);

		if (myRole == 'senior' || myRole == 'administrator') {
			create_group_button = '<a href="' + base_url + '/' + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?"
					+ '/group/create">';
			create_group_button += '<button type="button" class="btn btn-primary">Create Group</button>';
			create_group_button += '</a>';
			$('#create_new_group').html(create_group_button);
		}
	};

	// ------------------------------------------------------------------------

	this.addAsFriend = function() {
		friend_button = '<a id="add_as_friend" href="#"><button type="button" class="btn btn-primary">Add as Friend</button></a>';
		$('#frind_button').html(friend_button);
	};

	// ------------------------------------------------------------------------
	
	this.removeFriend = function() {
		friend_button = '<a id="remove_friend" href="#"><button type="button" class="btn btn-danger">Remove from Friend</button></a>';
		$('#frind_button').html(friend_button);
	};
	
	// ------------------------------------------------------------------------
	
	this.removeFriendRequest = function() {
		friend_button = '<a id="remove_friend_request" href="#"><button type="button" class="btn btn-danger">Cancel Friend Request</button></a>';
		$('#frind_button').html(friend_button);
	};
	
	// ------------------------------------------------------------------------

	this.addAsFamily = function() {
		family_button = '<a id="add_as_family" href="#"><button type="button" class="btn btn-primary">Add as Family</button></a>';
		$('#family_button').html(family_button);
	};

	// ------------------------------------------------------------------------
	
	this.removeFamily = function() {
		family_button = '<a id="remove_family" href="#"><button type="button" class="btn btn-danger">Remove from Family</button></a>';
		$('#family_button').html(family_button);
	};
	
	// ------------------------------------------------------------------------
	
	this.removeFamilyRequest = function() {
		family_button = '<a id="remove_family_request" href="#"><button type="button" class="btn btn-danger">Cancel Family Request</button></a>';
		$('#family_button').html(family_button);
	};
	
	// ------------------------------------------------------------------------

	this.addAsCollegue = function() {
		collegue_button = '<a id="add_as_collegue" href="#"><button type="button" class="btn btn-primary">Add as Collegue</button></a>';
		$('#collegue_button').html(collegue_button);
	};

	// ------------------------------------------------------------------------
	
	this.removeCollegue = function() {
		collegue_button = '<a id="remove_collegue" href="#"><button type="button" class="btn btn-danger">Remove from Collegue</button></a>';
		$('#collegue_button').html(collegue_button);
	};
	
	// ------------------------------------------------------------------------
	
	this.removeCollegueRequest = function() {
		collegue_button = '<a id="remove_collegue_request" href="#"><button type="button" class="btn btn-danger">Cancel Collegue Request</button></a>';
		$('#collegue_button').html(collegue_button);
	};
	
	// ------------------------------------------------------------------------
	
	this.addPost = function() {
		post_button = '<button type="button" id="add_post" class="btn btn-primary">Add Post</button>';
		$('#post_button').html(post_button);
	};
	
	// ------------------------------------------------------------------------
	
	this.removePost = function() {
		$('#post_button').html("");
	};

	// ------------------------------------------------------------------------

	this.user = function(obj) {
		console.log(obj);
		var output = '';
		
		if (myID == obj.userID) {
			editOptions();
		} 
		var uN = '<div id="userName">'+obj.firstName+" "+obj.lastName+'</div>';
		$("#user_name").html(uN);
		
		output += '<div id=user_id_' + obj.userID + '>';
		
		output += 'ID: ' + obj.userID + '<br>';
		output += 'Role: ' + obj.role + '<br>';
		output += 'Status: ' + obj.status + '<br>';
		output += 'Privacy: ' + obj.privacy + '<br>';
		output += 'First Name: ' + obj.firstName + '<br>';
		output += 'Last Name: ' + obj.lastName + '<br>';
		output += 'Address: ' + obj.address + '<br>';
		output += 'Email: ' + obj.email + '<br>';
		output += 'Country: ' + obj.country + '<br>';
		output += 'Date of Birth: ' + obj.dateOfBirth + '<br>';
		output += 'Date Created: ' + obj.dateCreated + '<br>';

		output += '</div>';
		return output;
	};

	// ------------------------------------------------------------------------

	this.member = function(obj) {
		console.log(obj);
		var output = '';

		output += '<div id=user_id_' + obj.userID2 + '>';

		// output += 'My ID: ' + obj.userID1 + '<br>';
		output += 'Friend ID: ' + obj.userID2 + '<br>';
		output += 'Name: ' + '<a href="' + base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?"
				+ '/user/show/' + obj.userID2 + '">' + obj.firstName + ' '
				+ obj.lastName + '</a><br>';
		
		// output += 'Status: ' + obj.status + '<br>';
		
		output += '</div>';
		return output;
	};
	
	// ------------------------------------------------------------------------
	
	this.member_list = function(obj, type) {
		console.log(obj);
		var output = '';

		output += '<div id=user_id_' + obj.userID2 + ' class="col-md-3" >';
		
		if (type) {
			output += '<div class="user-box ' + type + '" >';
			output += '<a href="' + base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?";
			output += '/user/show/' + obj.userID2 + '">' + obj.firstName + '<br>'
			output += obj.lastName + '</a>';
			output += '</div>';
		}
		
		output += '</div>';
		return output;
	};
	
	// ------------------------------------------------------------------------

	this.group = function(obj) {
		console.log(obj);
		var output = '';

		output += '<div id=group_id_' + obj.clubID + '>';

		// output += 'My ID: ' + obj.userID + '<br>';
		output += 'Group ID: ' + obj.clubID + '<br>';
		output += 'Name: ' + '<a href="' + base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?"
				+ '/group/show/' + obj.clubID + '">' + obj.name + '</a><br>';
		// output += 'Role: ' + obj.role + '<br>';

		output += '</div>';
		return output;
	};

	// ------------------------------------------------------------------------
	
	
	// ------------------------------------------------------------------------

	this.__construct();
};
