var GroupBrowserEvent = function () {
	
	// ------------------------------------------------------------------------
	  
    this.__construct = function() {
        console.log('Group Browser Event Created');
        browserTemplate = new GroupBrowserTemplate();
        filter_click();
    };
    
    var base_url = window.location.origin;
    var pathArray = window.location.pathname.split( '/' );
    
    // ------------------------------------------------------------------------
    
    var filter_click = function() {
    	 $("body").on('click', '.filter_click', function(e) {
             e.preventDefault();
             
             $("#group_list").html('<span class="ajax-loader-gray"></span>');
             $("#tag_list").html('<span class="ajax-loader-gray"></span>');
             
             var self = $(this);
             var id = $(this).attr('data-id');
             var name = $(this).attr('data-name');
             console.log('filter ID # '+ id +' clicked');
             
             $("#selected_tags").append(name + " + ");
             $("#selected_tag_ids").append(id + " + ");
             
             var tags = $("#selected_tag_ids").html();
             tags = tags.split(" + ");
             tags = tags.filter(function(v){return v!==''});
             
             console.log(tags);
             var url =  base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_groups_of_tag/';
         	 var postData = {tagIDs: tags};
         	
             $.post(url, postData, function(data) {
            	 showGroups(data);
             }, 'json');
             
             
    	 });       
    };
    
    // ------------------------------------------------------------------------
    
    var showGroups = function(o) {
    		var groups = [];
         	var output = '';
         	console.log('get groups for tag');
         	
         	output += '<ul class="list-group">';
         	for (var i = 0; i < o.length; i++ ) {
         		output += '<li class="list-group-item">';
         		output += browserTemplate.group(o[i]);
         		groups[groups.length] = ""+o[i].clubID;
         		output += '</li>';
        	}
        	output += '</ul>';
         	$("#group_list").html(output);
         	
         	console.log("groups: " + groups);
         	
         	var tags = $("#selected_tag_ids").html();
            tags = tags.split(" + ");
            tags = tags.filter(function(v){return v!==''});
         	
         	var url =  base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_tags_of_groups/';
         	var postData = {clubIDs : groups, tagIDs : tags};
         	$.post(url, postData, function(data) {
           	 showTags(data);
            }, 'json');
    }
    
    // ------------------------------------------------------------------------
    
    var showTags = function(o) {
    	console.log(o);
    	var output = '';
     	console.log('get tag for remaining groups');
     	for (var i = 0; i < o.length; i++ ) {
     		output += browserTemplate.tag(o[i]);
     	}
     	console.log(output);
    	$("#tag_list").html(output);
    }
    
    // ------------------------------------------------------------------------
    
    this.__construct();
    
};
