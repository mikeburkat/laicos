var Admin = function () {
	
	// ------------------------------------------------------------------------
	  
    this.__construct = function() {
        console.log('Admin '+id+' Created, my id: ' + myID, ", my role: " + myRole + ", my status: " + myStatus + ", my privacy: " + myPrivacy);
        Message = new Message();
        AdminTemplate = new AdminTemplate();
        
        
        switch (myRole) {
        case "administrator":
        	console.log(myRole);
        	$(".admin_roles").removeClass("hide");
        	admin();
        case "senior":
        	$(".senior_roles").removeClass("hide");
        	senior();
        case "junior":
        	$(".junior_roles").removeClass("hide");
        	junior();
        }
        
    };
    
    var base_url = window.location.origin;
    var pathArray = window.location.pathname.split( '/' );
    
    // ------------------------------------------------------------------------
    
    var admin = function() {
    	list_role_requests();
    	list_all_users();
    };
    
    // ------------------------------------------------------------------------
    
    var senior = function() {
    	request_admin_block();
    	list_owned_groups();
    	list_membership_requests();
    };
    
    // ------------------------------------------------------------------------
    
    var junior = function() {
    	request_seniority_block();
    	list_member_groups();
    	list_friend_requests();
    	list_relationship('family');
    	list_relationship('friends');
    	list_relationship('collegues');
    	
    };
    
    // ------------------------------------------------------------------------
    
    var list_all_users = function () {
    	var url = base_url + "/" + pathArray[1] + '/api/get_all_users/';
    	var postData = {};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('Admin User List');
        	
        	output += '<table class="table table-striped">'
        		+ '<thead>'
        		+ '<tr>'
        		+ '<th width="30%">User Name</th>'
        		+ '<th width="30%">Status</th>'
        		+ '<th >Action</th>'
        		+ '</tr>'
        		+ '</thead>';
        	
        	output += '<tbody>';
        	for (var i = 0; i < o.length; i++ ) {
        		output += AdminTemplate.adminUser(o[i]);
        	}
        	output += '</tbody>';
        	output += '</table>';
        	
        	$(".user_list").append(output);
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var request_seniority_block = function() {
    	var url = base_url + "/" + pathArray[1] + '/api/get_role_requests/';
    	var postData = {userID : myID, role : 'senior'};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('Seniority check');
        	console.log(o);
        	
        	if (o[0]) {
	        	output += '<h5>Your request to be a Senior member is ' + o[0].answer + '.</h5>';
	        	console.log('here');
        	} else {
        		output += AdminTemplate.seniorityRequest();
        	}
        		
        	$(".request_seniority").html(output);
        }, 'json');
    };
    
    
    // ------------------------------------------------------------------------
    
    var request_admin_block = function() {
    	var url = base_url + "/" + pathArray[1] + '/api/get_role_requests/';
    	var postData = {userID : myID, role : 'administrator'};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('Seniority check');
        	console.log(o);
        	
        	if (o[0]) {
	        	output += '<h5>Your request to be a Administrator is ' + o[0].answer + '.</h5>';
	        	console.log('here');
        	} else {
        		output += AdminTemplate.adminRequest();
        	}
        		
        	$(".request_admin").html(output);
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var list_role_requests = function() {
    	var url = base_url + "/" + pathArray[1] + '/api/get_role_requests/';
    	var postData = {};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('list role requests');
        	
        	var senior = document.createElement("TABLE");
        	var head = senior.createTHead();
        	var hRow = head.insertRow();
        	
        	th1 = document.createElement('th');
        	th1.innerHTML = "First Name";
        	th2 = document.createElement('th');
        	th2.innerHTML = "Last Name";
        	th3 = document.createElement('th');
        	th3.innerHTML = "Requested Role";
        	th4 = document.createElement('th');
        	th4.innerHTML = "Actions";
        	
        	hRow.appendChild(th1);
        	hRow.appendChild(th2);
        	hRow.appendChild(th3);
        	hRow.appendChild(th4);
        	
        	var body = senior.createTBody();
        	for (var i = 0; i < o.length; i++ ) {
        		var row = body.insertRow();
        		var fN = row.insertCell();
        		var lN = row.insertCell();
        		var role = row.insertCell();
        		var actions = row.insertCell();
        		fN.innerHTML = o[i].firstName;
        		lN.innerHTML = o[i].lastName;
        		role.innerHTML = o[i].requested_role;
        		
        		var accept = '<button id="role_request" type="button" data-role="' 
        			+ o[i].requested_role + '" data-userID="' +  o[i].userID
        			+ '" class="btn btn-success">Accept</button>';
        		var deny = '<button id="role_request" type="button"  data-role="' 
        			+ o[i].requested_role + '" data-userID="' +  o[i].userID
    				+ '" class="btn btn-danger">Deny</button>';
        		
        		actions.innerHTML = accept + "  " + deny;
        	}
        	senior.classList.add("table");
        	senior.classList.add("table-striped");
        	$(".seniority_requests_table").append(senior);
        	
        	
        }, 'json');
    };
    
    
    // ------------------------------------------------------------------------
    
    var list_owned_groups = function() {
    	var url = base_url + "/" + pathArray[1] + '/api/get_membership/';
    	var postData = { userID : myID, role : 'owner'};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('list role requests');
        	
        	var senior = document.createElement("TABLE");
        	var head = senior.createTHead();
        	var hRow = head.insertRow();
        	
        	th1 = document.createElement('th');
        	th1.innerHTML = "Group Name";
        	th4 = document.createElement('th');
        	th4.innerHTML = "Actions";
        	
        	hRow.appendChild(th1);
        	hRow.appendChild(th4);
        	
        	var body = senior.createTBody();
        	for (var i = 0; i < o.length; i++ ) {
        		var row = body.insertRow();
        		var gN = row.insertCell();
        		var actions = row.insertCell();
        		gN.innerHTML = o[i].name;
        		
        		var deny = '<button id="delete_group" type="button"  data-clubID="' +  o[i].clubID
    				+ '" class="btn btn-danger">Delete</button>';
        		
        		actions.innerHTML = deny;
        	}
        	senior.classList.add("table");
        	senior.classList.add("table-striped");
        	$(".owned_group_list_table").append(senior);
        	
        	
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var list_membership_requests = function() {
    	var url = base_url + "/" + pathArray[1] + '/api/get_membership_requests/';
    	var postData = {userID : myID};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('list role requests');
        	
        	var senior = document.createElement("TABLE");
        	var head = senior.createTHead();
        	var hRow = head.insertRow();
        	
        	th1 = document.createElement('th');
        	th1.innerHTML = "Group Name";
        	th2 = document.createElement('th');
        	th2.innerHTML = "User Name";
        	th4 = document.createElement('th');
        	th4.innerHTML = "Actions";
        	
        	hRow.appendChild(th1);
        	hRow.appendChild(th2);
        	hRow.appendChild(th4);
        	
        	var body = senior.createTBody();
        	for (var i = 0; i < o.length; i++ ) {
        		var row = body.insertRow();
        		var gN = row.insertCell();
        		var flN = row.insertCell();
        		var actions = row.insertCell();
        		gN.innerHTML = o[i].name;
        		flN.innerHTML = o[i].firstName + " " + o[i].lastName;
        		
        		var accept = '<button id="membership_request" type="button" data-clubID="' 
        			+ o[i].clubID + '" data-userID="' +  o[i].userID
        			+ '" class="btn btn-success">Accept</button>';
        		var deny = '<button id="membership_request" type="button"  data-clubID="' 
        			+ o[i].clubID + '" data-userID="' +  o[i].userID
    				+ '" class="btn btn-danger">Deny</button>';
        		
        		actions.innerHTML = accept + "  " + deny;
        	}
        	senior.classList.add("table");
        	senior.classList.add("table-striped");
        	$(".membership_request_table").append(senior);
        	
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var list_member_groups = function() {
    	var url = base_url + "/" + pathArray[1] + '/api/get_membership/';
    	var postData = { userID : myID, role : 'member'};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('list role requests');
        	
        	var senior = document.createElement("TABLE");
        	var head = senior.createTHead();
        	var hRow = head.insertRow();
        	
        	th1 = document.createElement('th');
        	th1.innerHTML = "Group Name";
        	th4 = document.createElement('th');
        	th4.innerHTML = "Actions";
        	
        	hRow.appendChild(th1);
        	hRow.appendChild(th4);
        	
        	var body = senior.createTBody();
        	for (var i = 0; i < o.length; i++ ) {
        		var row = body.insertRow();
        		var gN = row.insertCell();
        		var actions = row.insertCell();
        		gN.innerHTML = o[i].name;
        		
        		var deny = '<button id="leave_group" type="button"  data-clubID="' +  o[i].clubID
    				+ '" class="btn btn-danger">Leave</button>';
        		
        		actions.innerHTML = deny;
        	}
        	senior.classList.add("table");
        	senior.classList.add("table-striped");
        	$(".member_group_list_table").append(senior);
        	
        	
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var list_friend_requests = function() {
    	var url = base_url + "/" + pathArray[1] + '/api/get_pending_relationships/';
    	var postData = {userID: myID};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('list role requests');
        	
        	var senior = document.createElement("TABLE");
        	var head = senior.createTHead();
        	var hRow = head.insertRow();
        	
        	th1 = document.createElement('th');
        	th1.innerHTML = "User Name";
        	th2 = document.createElement('th');
        	th2.innerHTML = "Requested";
        	th4 = document.createElement('th');
        	th4.innerHTML = "Actions";
        	
        	hRow.appendChild(th1);
        	hRow.appendChild(th2);
        	hRow.appendChild(th4);
        	
        	var body = senior.createTBody();
        	for (var i = 0; i < o.length; i++ ) {
        		var row = body.insertRow();
        		var flN = row.insertCell();
        		var r = row.insertCell();
        		var actions = row.insertCell();
        		var relation = o[i].status.split(" ")[0];
        		r.innerHTML = relation;
        		flN.innerHTML = o[i].firstName + " " + o[i].lastName;
        		
        		var accept = '<button id="relationship_request" type="button" data-relation="' 
        			+ relation + '" data-userID="' +  o[i].userID
        			+ '" class="btn btn-success">Accept</button>';
        		var deny = '<button id="relationship_request" type="button"  data-relation="' 
        			+ relation + '" data-userID="' +  o[i].userID
    				+ '" class="btn btn-danger">Deny</button>';
        		
        		actions.innerHTML = accept + "  " + deny;
        	}
        	senior.classList.add("table");
        	senior.classList.add("table-striped");
        	$(".friend_requests_table").append(senior);
        	
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var list_relationship = function(relationship) {
    	var url = base_url + "/" + pathArray[1] + '/api/get_relationship/';
    	var postData = {userID1 : myID, status : relationship};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('list ' + relationship);
        	
        	if (o.length == 0) {
        		$("." + relationship + "_list_table").append("Sorry but you have no " + relationship + ".");
        	} else {
        	var senior = document.createElement("TABLE");
        	
        	var head = senior.createTHead();
        	var hRow = head.insertRow();
        	
        	th1 = document.createElement('th');
        	th1.innerHTML = "User Name";
        	th4 = document.createElement('th');
        	th4.innerHTML = "Actions";
        	
        	hRow.appendChild(th1);
        	hRow.appendChild(th4);
        	
        	var body = senior.createTBody();
        	for (var i = 0; i < o.length; i++ ) {
        		var row = body.insertRow();
        		var n = row.insertCell();
        		var actions = row.insertCell();
        		n.innerHTML = o[i].firstName + " " + o[i].lastName;
        		
        		var deny = '<button id="remove_relationship" type="button"  data-status="' 
        			+ relationship + '" data-userID="' +  o[i].userID
    				+ '" class="btn btn-danger">Remove</button>';
        		
        		actions.innerHTML = deny;
        	}
        	senior.classList.add("table");
        	senior.classList.add("table-striped");
        	
        	$("." + relationship + "_list_table").append(senior);
        	}
        	
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    this.__construct();
    
};
