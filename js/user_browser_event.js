var UserBrowserEvent = function () {
	
	// ------------------------------------------------------------------------
	  
    this.__construct = function() {
        console.log('Group Browser Event Created');
        browserTemplate = new UserBrowserTemplate();
        filter_click();
    };
    
    var base_url = window.location.origin;
    var pathArray = window.location.pathname.split( '/' );
    
    // ------------------------------------------------------------------------
    
    var filter_click = function() {
    	 $("body").on('click', '.filter_click', function(e) {
             e.preventDefault();
             
             $("#user_list").html('<span class="ajax-loader-gray"></span>');
             
             var self = $(this);
             var filter = $(this).attr('data-name');
             console.log('filter '+ filter +' clicked');
             
             $("#selected_filters").html(filter);
            	 
             switch (filter) {
             case "age":
            	 filter = 'dateOfBirth';
            	 break;
             case "alphabetical first name":
            	 filter = 'firstName';
            	 break;
             case "alphabetical last name":
            	 filter = 'lastName';
            	 break;
             
             }
             
             console.log(filter);
             var url =  base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/sort_users_by_filter/';
         	 var postData = {sortBy: filter, order: 'ASC'};
         	
             $.post(url, postData, function(data) {
            	 showUsers(data);
             }, 'json');
             
             
    	 });       
    };
    
    // ------------------------------------------------------------------------
    
    var showUsers = function(o) {
    		var groups = [];
         	var output = '';
         	console.log('get users for filter');
         	for (var i = 0; i < o.length; i++ ) {
         		output += browserTemplate.user(o[i]);
         	}
         	console.log(output);
         	$("#user_list").html(output);
         	
    }
    
    // ------------------------------------------------------------------------
    
    // ------------------------------------------------------------------------
    
    this.__construct();
    
};
