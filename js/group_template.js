var GroupTemplate = function() {

	// ------------------------------------------------------------------------

	this.__construct = function() {
		console.log('Group Template Created');
	};

	var base_url = window.location.origin;
	var pathArray = window.location.pathname.split('/');

	// ------------------------------------------------------------------------

	this.group = function(obj) {
		console.log(obj);
		var output = '';
		output += '<br>';
		output += '<div id=group_id_'+obj.clubID+'>';
		
//		output += 'Group ID: ' + obj.clubID + '<br>';
		output += '<h4>Name: ' + obj.name + '</h4>';
		output += '<h4>Description: ' + obj.description + '</h4><br>';
//		output += 'Owner: ' + obj.founderID + '<br>';
//		output += 'Posting Allowed: ' + obj.posts_allowed_by_members + '<br>';
		output += '</div>';
		return output;
	};

	// ------------------------------------------------------------------------
	
	this.member = function(obj) {
		console.log(obj);
		var output = '';
		
		output += '<div id=user_id_'+obj.userID+'>';
		
//		output += 'Member ID: ' + obj.userID + '<br>';
		output += 'Name: ' + '<a href="' + base_url + "/" + pathArray[1] 
			+ '/user/show/'+obj.userID+'">' + obj.firstName + ' ' + obj.lastName + '</a><br>';
		
		output += '</div>';
		return output;
	};

	// ------------------------------------------------------------------------
	
	this.tag = function(obj) {
		console.log(obj);
		var output = '';
		
//		output += '<div id=tag_id_' + obj.tagID + '>';
//		output += 'Tag ID: ' + obj.tagID + '<br>';
//		output += 'Tag Name: ' + obj.name + '<br>';
//		output += '</div>';
		
		output += '<a id=tag_id_' + obj.tagID + ' class="filter_click" '; 
		output += 'data-id="' + obj.tagID + '" data-name="'+obj.name+'" ';
		output += 'href="#"> ';
		output += '<button type="button" class="btn btn-primary btn-xs">';
	    output += obj.name;
	    output += '</button>';
	    output += ' </a>';
		
		
		return output;
	};
	
	// ------------------------------------------------------------------------

	this.joinGroup = function() {
		family_button = '<a id="join_group" href="#"><button type="button" class="btn btn-primary">Join Group</button></a>';
		$('#join_button').html(family_button);
	};
	
	// ------------------------------------------------------------------------

	this.leaveGroup = function() {
		family_button = '<a id="leave_group" href="#"><button type="button" class="btn btn-danger">Leave Group</button></a>';
		$('#join_button').html(family_button);
	};
	
	// ------------------------------------------------------------------------

	this.requestGroup = function() {
		family_button = '<a id="cancel_request" href="#"><button type="button" class="btn btn-danger">Cancel Join Request</button></a>';
		$('#join_button').html(family_button);
	};
	
	// ------------------------------------------------------------------------

	this.deniedGroup = function() {
		family_button = 'Sorry you were denied membership to this group';
		$('#join_button').html(family_button);
	};
	
	// ------------------------------------------------------------------------

	this.deleteGroup = function() {
		family_button = '<a id="delete_group_button" href="#"><button type="button" class="btn btn-danger">Delete Group</button></a>';
		$('#delete_group').html(family_button);
	};
	
	// ------------------------------------------------------------------------
	
	this.addPost = function() {
		post_button = '<button type="button" id="add_post" class="btn btn-primary">Add Post</button>';;
		$('#post_button').html(post_button);
	};
	
	// ------------------------------------------------------------------------
	
	this.removePost = function() {
		$('#post_button').html("");
	};
	
	// ------------------------------------------------------------------------
	
	
	
	
	
	
	
	
	this.__construct();
};
