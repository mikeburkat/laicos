var UserBrowser = function () {
	
	// ------------------------------------------------------------------------
	  
    this.__construct = function() {
        console.log('User Browser Created');
        UserBrowserEvent = new UserBrowserEvent();
        UserBrowserTemplate = new UserBrowserTemplate();
        clear_filters();
        list_filters();
        list_users();
    };
    
    var base_url = window.location.origin;
    var pathArray = window.location.pathname.split( '/' );
    
    // ------------------------------------------------------------------------
    
    var clear_filters = function() {
    	$("body").on('click', '.clear_tags', function(e) {
            e.preventDefault();
            
            $("#selected_filters").html("");
            $("#selected_filter_ids").html("");
            $("#filter_list").html('<span class="ajax-loader-gray"></span>');
            $("#user_list").html('<span class="ajax-loader-gray"></span>');
            
            list_tags();
            list_groups();
            
   		});
    };
    
    // ------------------------------------------------------------------------
    
    var list_filters = function() {
    	var url =  base_url + "/" + pathArray[1] + '/api/get_all_filters/';
    	var postData = {tag: 'all'};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('get all tags');
        	for (var i = 0; i < o.length; i++ ) {
        		output += UserBrowserTemplate.filter(o[i]);
        	}
        	
        	$("#filter_list").html(output);
        }, 'json');
    };
    
    
    // ------------------------------------------------------------------------
    
    var list_users = function() {
    	var url =  base_url + "/" + pathArray[1] + '/api/get_all_users/';
    	var postData = {group: 'all'};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('get all users');
        	
        	output += '<ul class="list-group">';
        	
        	for (var i = 0; i < o.length; i++ ) {
        		if (o[i].privacy == 'public' && o[i].status == 'active'){
        			output += '<li class="list-group-item">';
        			output += UserBrowserTemplate.user(o[i]);
        			output += '</li>';
        		}
        	}
        	
        	output += '</ul>';
        	
        	$("#user_list").html(output);
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    
    
    // ------------------------------------------------------------------------
    
    
    this.__construct();
    
};
