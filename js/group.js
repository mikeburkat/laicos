var Group = function (i) {
	
	// ------------------------------------------------------------------------
	  
    this.__construct = function() {
        console.log('Group '+id+' Created');
        GroupTemplate = new GroupTemplate();
        GroupEvent = new GroupEvent();
        info();
        list_tags();
        show_owner();
        list_members();
        check_membership();
    };
    
    var base_url = window.location.origin;
    var pathArray = window.location.pathname.split( '/' );
    
    // ------------------------------------------------------------------------
    
    var info = function() {
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_group_info/';
    	var postData = {clubID: $(this).attr('id')};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('group info');
        	for (var i = 0; i < o.length; i++ ) {
        		output += GroupTemplate.group(o[i]);
        	}
        	
        	$("#group_info").html(output);
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var list_tags = function() {
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_group_tags/';
    	var postData = {clubID: $(this).attr('id')};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('get group tags');
        	for (var i = 0; i < o.length; i++ ) {
        		output += GroupTemplate.tag(o[i]);
        	}
        	
        	$("#tags").html(output);
        }, 'json');
    };
    
    
    // ------------------------------------------------------------------------
    
    var show_owner = function() {
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_group_owner/';
    	var postData = {clubID: $(this).attr('id')};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('get group owner');
        	for (var i = 0; i < o.length; i++ ) {
        		output += GroupTemplate.member(o[i]);
        	}
        	
        	$("#group_owner").html(output);
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var list_members = function() {
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_group_members/';
    	var postData = {clubID: $(this).attr('id')};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('get group members');
        	for (var i = 0; i < o.length; i++ ) {
        		output += GroupTemplate.member(o[i]);
        	}
        	
        	$("#group_members").html(output);
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var check_membership = function() {
    	
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/check_membership/';
    	var postData = {userID: myID,
    					groupID: id};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	
        	GroupTemplate.joinGroup();
        	
    		for (var i = 0; i < o.length; i++ ) {
    			if (o[i].role == 'owner') {
    				GroupTemplate.addPost();
    				GroupTemplate.deleteGroup();
    			} else if (o[i].role == 'member') {
    				GroupTemplate.addPost();
    				GroupTemplate.leaveGroup();
    			} else if (o[i].role == 'member pending') {
    				GroupTemplate.requestGroup();
    			} else if (o[i].role == 'denied') {
    				GroupTemplate.deniedGroup();
    			} 
    		}
        	
        }, 'json');
    	
    };
    
    // ------------------------------------------------------------------------
    
    // ------------------------------------------------------------------------
    
    this.__construct();
    
};
