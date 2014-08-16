
	var base_url = window.location.origin;
    var pathArray = window.location.pathname.split( '/' );

	// ------------------------------------------------------------------------
	
	function acceptRequest(friendID, myID, status) {
		
		console.log("myID: " + myID + " f: " + friendID + " s: " + status);
		$("#request_"+status+"_"+friendID).remove();
		
		var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/accept_relationship_request/';
    	var postData = {userID1: friendID, userID2: myID, status: status};
    	
    	 $.post(url, postData, function(o) {
    		
    		 if (o == 1) {
    			 Message.success("Request was accepted.");
    		 } else {
    			 Message.success("Request accept failed.");	 
    		 }
    		 
         }, 'json');
		
		
		
	};
	
	// ------------------------------------------------------------------------
	
	function declineRequest(friendID, myID, status) {
		
		console.log("myID: " + myID + " f: " + friendID + " s: " + status);
		$("#request_"+status+"_"+friendID).remove();
		
		var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/decline_relationship_request/';
		var postData = {userID1: friendID, userID2: myID, status: status};
    	
    	 $.post(url, postData, function(o) {
    		
    		 if (o == 1) {
    			 Message.success("Request was declined.");
    		 } else {
    			 Message.success("Request decline failed.");	 
    		 }
    		 
         }, 'json');
		
	};
	
	// ------------------------------------------------------------------------
	

var FriendRequest = function() {

	// ------------------------------------------------------------------------

	
	this.__construct = function() {
		listRequests();
	}
	
    var base_url = window.location.origin;
    var pathArray = window.location.pathname.split( '/' );
    
	
	
	// ------------------------------------------------------------------------

	var listRequests = function() {
		
		var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_pending_relationships/';
    	var postData = {userID: myID};
    	
    	 $.post(url, postData, function(o) {
    		var output = '';
    		
    		if (o.length > 0) {
    			output += '<ul class="list-group">';
    		}
    		
         	console.log('requests');
         	for (var i = 0; i < o.length; i++ ) {
         		var req = o[i].status.split(" ")[0];
         		output += '<li id="request_'+ req + '_' + o[i].userID + '" class="list-group-item">';
         		output += o[i].firstName + ' ' + o[i].lastName;
         		
         		
         		output += ' requested to be ' + req;
         		
         		output += '<button type="button" class="btn btn-success" ';
         		output += 'onClick="acceptRequest(' + o[i].userID + ', ' + myID + ', \'' + req + '\')">Accept</button>';
         		output += '<button type="button" class="btn btn-danger" ';
         		output += 'onClick="declineRequest(' + o[i].userID + ', ' + myID + ', \'' + req + '\')">Decline</button>';
         		
         		output += '</li>';
         	}
         	
         	
         	if (o.length > 0) {
    			output += '</ul>';
    		} else {
    			output = 'You have no pending requests.';
    		}
         	
         	$("#requests").html(output);
         }, 'json');
		
	};
	
	// ------------------------------------------------------------------------

	
	
	// ------------------------------------------------------------------------


	
	
	this.__construct();
};
