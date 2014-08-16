var GroupBrowser = function () {
	
	// ------------------------------------------------------------------------
	  
    this.__construct = function() {
        console.log('Group Browser Created');
        GroupBrowserEvent = new GroupBrowserEvent();
        GroupBrowserTemplate = new GroupBrowserTemplate();
        clear_tags();
        list_tags();
        list_groups();
    };
    
    var base_url = window.location.origin;
    var pathArray = window.location.pathname.split( '/' );
    
    // ------------------------------------------------------------------------
    
    var clear_tags = function() {
    	$("body").on('click', '.clear_tags', function(e) {
            e.preventDefault();
            
            $("#selected_tags").html("");
            $("#selected_tag_ids").html("");
            $("#group_list").html('<span class="ajax-loader-gray"></span>');
            $("#tag_list").html('<span class="ajax-loader-gray"></span>');
            
            list_tags();
            list_groups();
            
   		});
    };
    
    // ------------------------------------------------------------------------
    
    var list_tags = function() {
    	var url =  base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_tags/';
    	var postData = {tag: 'all'};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('get all tags');
        	for (var i = 0; i < o.length; i++ ) {
        		output += GroupBrowserTemplate.tag(o[i]);
        	}
        	
        	$("#tag_list").html(output);
        }, 'json');
    };
    
    
    // ------------------------------------------------------------------------
    
    var list_groups = function() {
    	var url =  base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_groups/';
    	var postData = {group: 'all'};
    	
        $.post(url, postData, function(o) {
        	var output = '';
        	console.log('get all groups');
        	for (var i = 0; i < o.length; i++ ) {
        		output += GroupBrowserTemplate.group(o[i]);
        	}
        	
        	$("#group_list").html(output);
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    this.passed_tag = function(passedTag) {
    	console.log(passedTag);
//    	window.onload = function () { 
//    		alert("It's loaded!"); 
//    	
//    	console.log(document.getElementById('tag_id_'+passedTag));
//    	document.getElementById('tag_id_'+passedTag).click();
//    	}
    	
    }
 
    // ------------------------------------------------------------------------
    
    
    this.__construct();
    
};