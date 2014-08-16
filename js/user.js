var User = function () {
	
	// ------------------------------------------------------------------------
	  
    this.__construct = function() {
        console.log('User '+id+' Created, my id: ' + myID, ", my role: " + myRole + ", my status: " + myStatus + ", my privacy: " + myPrivacy);
        UserTemplate = new UserTemplate();
        UserEvent = new UserEvent();
        info();
        friends();
        family();
        collegues();
        owned_groups();
        member_groups();
        check_relationship();
    };
    
    var base_url = window.location.origin;
    var pathArray = window.location.pathname.split( '/' );
    
    // ------------------------------------------------------------------------
    
    var info = function() {
    	
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_user_info/';
    	var postData = {user_id: $(this).attr('id')};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('here');
        	for (var i = 0; i < o.length; i++ ) {
        		output += UserTemplate.user(o[i]);
        	}
        	
        	$("#user_info").html(output);
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var friends = function() {
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_relationship/';
    	var postData = {userID1: $(this).attr('id'),
    					status: 'friends'};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('friends');
        	for (var i = 0; i < o.length; i++ ) {
        		output += UserTemplate.member_list(o[i], "friend");
        	}
        	
        	$("#user_friends").html(output);
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var family = function() {
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_relationship/';
    	var postData = {userID1: $(this).attr('id'),
    					status: 'family'};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('family');
        	for (var i = 0; i < o.length; i++ ) {
        		output += UserTemplate.member_list(o[i], "family");
        	}
        	
        	$("#user_family").html(output);
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var collegues = function() {
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_relationship/';
    	var postData = {userID1: $(this).attr('id'),
    					status: 'collegues'};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('collegues');
        	for (var i = 0; i < o.length; i++ ) {
        		output += UserTemplate.member_list(o[i], "collegue");
        	}
        	
        	$("#user_collegues").html(output);
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var owned_groups = function() {
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_membership/';
    	var postData = {userID: $(this).attr('id'),
    					role: 'owner'};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('owned');
        	for (var i = 0; i < o.length; i++ ) {
        		output += UserTemplate.group(o[i]);
        	}
        	
        	$("#user_groups_owned").html(output);
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var member_groups = function() {
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_membership/';
    	var postData = {userID: $(this).attr('id'),
    					role: 'member'};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('member');
        	for (var i = 0; i < o.length; i++ ) {
        		output += UserTemplate.group(o[i]);
        	}
        	
        	$("#user_groups_member").html(output);
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var check_relationship = function() {
    	
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/check_relationship/';
    	var postData = {myUserID: myID,
    					pageUserID: id};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	
        	if (id != myID) {
        		UserTemplate.addAsFriend();
        		UserTemplate.addAsFamily();
        		UserTemplate.addAsCollegue();
        	}
        	
        	if (id == myID) {
        		UserTemplate.addPost();
        	}
        	
    		for (var i = 0; i < o.length; i++ ) {
    			if (o[i].status == 'friends') {
    				UserTemplate.removeFriend();
    				UserTemplate.addPost();
    			} else if (o[i].status == 'family') {
    				UserTemplate.removeFamily();
    				UserTemplate.addPost();
    			} else if (o[i].status == 'collegues') {
    				UserTemplate.removeCollegue();
    				UserTemplate.addPost();
    			} else if (o[i].status == 'friends pending') {
    				UserTemplate.removeFriendRequest();
    			} else if (o[i].status == 'family pending') {
    				UserTemplate.removeFamilyRequest();
    			} else if (o[i].status == 'collegues pending') {
    				UserTemplate.removeCollegueRequest();
    			}
    			
    		}
        	
        }, 'json');
    	
    };
    
    // ------------------------------------------------------------------------
    
    this.__construct();
    
};
