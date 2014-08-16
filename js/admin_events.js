

var AdminEvents = function () {
	
	// ------------------------------------------------------------------------
	  
    this.__construct = function() {
        console.log('Admin Events'+id+' Created, my id: ' + myID, ", my role: " + myRole + ", my status: " + myStatus + ", my privacy: " + myPrivacy);

        show_hide();
        create_group();
        request_senior_pressed();
        request_admin_pressed();
        role_request_pressed();
        generate_link();
        
        suspend_pressed();
        inactivate_pressed();
        activate_pressed();
        
    };
    
    var base_url = window.location.origin;
    var pathArray = window.location.pathname.split( '/' );
    
    // ------------------------------------------------------------------------
    
    var show_hide = function() {
    	$("body").on('click', '#show_hide', function(e) {
			e.preventDefault();
			
			var button = $(this);
	    	text = button.html();
	    	if (text == "Show") {
	    		button.html("Hide");
	    	} else {
	    		button.html("Show");
	    	}
			
			$("." + button.data('button')).toggle();
	    	
		});
    };
    
    
    // ------------------------------------------------------------------------
    
    var create_group = function() {
    	$('#create_group_submit').submit(function(e) {
    		e.preventDefault();
    		
    		var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/create_group/';
    		
        	var input = $('form').serializeArray();
        	
        	console.log(input);
        	
        	var postData = {};
        	postData['userID'] = myID;
        	postData['name'] = input[0]['value'];
        	postData['description'] = input[1]['value'];
        	postData['posting'] = input[2]['value'];
        	
        	console.log(postData);
        	
            $.post(url, postData, function(o) {
            	var output = '';
            	console.log('group created? ' + o);
            	
            	if (o == 0) {
            		Message.error("This group name is already used, choose a different name.");
            	} else {
            		$("#create_group_submit")[0].reset();
            		window.location.href = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + "/group/show/" + o;
            	}
            	
            }, 'json');
        });
    };
    
    // ------------------------------------------------------------------------
    
    var request_senior_pressed = function() {
    	$("body").on('click', '#request_senior_button', function(e) {
    		e.preventDefault();
    		
    		var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/add_request_role/';
    		
        	var postData = {userID : myID, role : 'senior'};
      
            $.post(url, postData, function(o) {
            	var output = '';
            	
            	if (o != "success") {
            		Message.error("Request failed");
            	} else {
            		Message.success("Request was made succesfuly, you must wait for a reply.");
            		var output = '<h5>Your request to be a Senior member is pending.</h5>';
            		$(".request_seniority").html(output);
            	}
            	
            }, 'json');
        });
    };
    
    // ------------------------------------------------------------------------
    
    var request_admin_pressed = function() {
    	$("body").on('click', '#request_admin_button', function(e) {
    		e.preventDefault();
    		
    		var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/add_request_role/';
    		
        	var postData = {userID : myID, role : 'administrator'};
      
            $.post(url, postData, function(o) {
            	var output = '';
            	
            	if (o != "success") {
            		Message.error("Request failed");
            	} else {
            		Message.success("Request was made succesfuly, you must wait for a reply.");
            		var output = '<h5>Your request to be an Administrator is pending.</h5>';
            		$(".request_admin").html(output);
            	}
            	
            }, 'json');
        });
    };
    
    // ------------------------------------------------------------------------
    
    var role_request_pressed = function() {
    	$("body").on('click', '#role_request', function(e) {
    		e.preventDefault();
    		
    		var button = $(this);
    		var row = button.parent().parent();
    		
    		var role = button.data('role');
    		var userID = button.data('userid');
    		var answer = button.html();
    		if (answer == "Accept") {
    			answer = "accepted";
    		} else if (answer == "Deny") {
    			answer = "denied"
    		}
    		
    		var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/set_role/';
        	var postData = {
        			userID : userID, 
        			role : role,
        			answer : answer
        		};
      
            $.post(url, postData, function(o) {
            	var output = '';
            	
            	if (o != "success") {
            		Message.error("Role change failed.");
            	} else {
            		row.hide();
            		Message.success("The role was changed succesfuly.");
            	}
            	
            }, 'json');
        });
    };
    
    
    // ------------------------------------------------------------------------
    
    var generate_link = function() {
    	$('#generate').submit(function(e) {
    		e.preventDefault();
    		
    		var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/add_invite/';
        	var input = $('form').serializeArray();
        	
        	var postData = {};
        	postData['userID'] = myID;
        	postData['email'] = input[0]['value'];
        	
        	console.log(postData);
        	
        	if (postData.email == "") {
        		Message.error("Please enter an email into the email address field.");
        		return;
        	}  
        	
            $.post(url, postData, function(o) {
            	var output = '';
            	console.log('invite created? ' + o);
            	
            	if (o == 0) {
            		Message.error("This group name is already used, choose a different name.");
            	} else {
            		$("#generated_output").html(o);
            	}
            	
            }, 'json');
        });
    };
    
    // ------------------------------------------------------------------------
    
    var suspend_pressed = function() {
    	$("body").on('click', '#suspend', function(e) {
    		e.preventDefault();
    		
    		var button = $(this);
    		var row = button.parent().parent();
    		
    		var status = 'suspended';
    		var userID = button.data('userid');
    		
    		var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/set_status/';
        	var postData = {userID : userID, status : status};
      
            $.post(url, postData, function(o) {
            	var output = '';
            	
            	if (o != "success") {
            		Message.error("Request failed");
            	} else {
            		Message.success("User suspension is in effect immediately.");
            		row[0].cells[1].innerHTML = 'suspended';
            		row[0].cells[2].innerHTML = AdminTemplate.suspendedButtons(userID);
            	}
            	
            }, 'json');
        });
    };
    
    // ------------------------------------------------------------------------
    
    var inactivate_pressed = function() {
    	$("body").on('click', '#inactivate', function(e) {
    		e.preventDefault();
    		
    		var button = $(this);
    		var row = button.parent().parent();
    		console.log(row);
    		
    		var status = 'inactive';
    		var userID = button.data('userid');
    		
    		var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/set_status/';
        	var postData = {userID : userID, status : status};
      
            $.post(url, postData, function(o) {
            	var output = '';
            	
            	if (o != "success") {
            		Message.error("Request failed");
            	} else {
            		Message.success("User inactivated succesfully.");
            		row[0].cells[1].innerHTML = 'inactive';
            		row[0].cells[2].innerHTML = AdminTemplate.inactiveButtons(userID);
            	}
            	
            }, 'json');
        });
    };
    
    // ------------------------------------------------------------------------
    
    var activate_pressed = function() {
    	$("body").on('click', '#activate', function(e) {
    		e.preventDefault();
    		
    		var button = $(this);
    		var row = button.parent().parent();
    		console.log(row);
    		
    		var status = 'active';
    		var userID = button.data('userid');
    		
    		var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/set_status/';
        	var postData = {userID : userID, status : status};
      
            $.post(url, postData, function(o) {
            	var output = '';
            	
            	if (o != "success") {
            		Message.error("Request failed");
            	} else {
            		Message.success("User activated succesfully.");
            		row[0].cells[1].innerHTML = 'active';
            		row[0].cells[2].innerHTML = AdminTemplate.activeButtons(userID);
            	}
            	
            }, 'json');
        });
    };
    
    // ------------------------------------------------------------------------
    
    
    
    // ------------------------------------------------------------------------
    
    
    
    // ------------------------------------------------------------------------
    
   
    
    // ------------------------------------------------------------------------
    
    
    
    // ------------------------------------------------------------------------
    
    this.__construct();
    
};
