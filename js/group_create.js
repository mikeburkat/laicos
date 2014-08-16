var GroupCreate = function () {
	
	// ------------------------------------------------------------------------
	  
    this.__construct = function() {
        console.log('Group creation myID ' + myID);
        createGroup();
    };
    
    var base_url = window.location.origin;
    var pathArray = window.location.pathname.split( '/' );
    
    // ------------------------------------------------------------------------
    
    var createGroup = function() {
    	$('#create').submit(function(e) {
    		event.preventDefault();
    		
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
            	
            	window.location.href = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + "/group/show/" + o;
            	
            }, 'json');
        });
    };
    
    // ------------------------------------------------------------------------
   
    
    // ------------------------------------------------------------------------
    
    this.__construct();
    
};
