var Post = function () {
	
	// ------------------------------------------------------------------------
	  
    this.__construct = function() {
        console.log('Posts for user: '+id+' Created, my id: ' + myID, ", my role: " + myRole + ", my status: " + myStatus + ", my privacy: " + myPrivacy);
        PostTemplate = new PostTemplate();
        
        heart_button_pressed();
        delete_button_pressed();
        share_button_pressed();
    };
    
    var base_url = window.location.origin;
    var pathArray = window.location.pathname.split( '/' );
    
	// ------------------------------------------------------------------------
        
    this.get_newsfeed = function() {
    	
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_newsfeed/';
    	var postData = {userID: myID};
    	
		console.log('getting a newfeed request...');
		
        $.post(url, postData, function(o) {
        	$('#newsfeed').html("");
        	var parents = [];
        	for (var i = 0; i < o.length; i++ ) {
        		var output = PostTemplate.parent(o[i]);
        		$('#newsfeed').append(output);
        		parents.push(o[i].postID);
        	}
        	
        	list_comments(parents);
        	set_harted_state(parents);
        	list_heart_counts(parents);
        	show_delete_buttons(parents);
        }, 'json');
    };
    	
    // ------------------------------------------------------------------------
    this.get_post = function(postId) {
    	
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_post/';
    	var postData = {postID: id};

        $.post(url, postData, function(o) {
        	$('#post').html("");

        	var parents = [];
			parents.push(o[0].postID);
			
        	var output = PostTemplate.parent(o[0]);
        	$('#post').append(output);

        	list_comments(parents);
        	set_harted_state(parents);
        	list_heart_counts(parents);
        	show_delete_buttons(parents);
        }, 'json');
    };
    // ------------------------------------------------------------------------
    
    this.list_user_posts = function() {
    	
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_user_wall_posts/';
    	var postData = {userID: id};
    	
        $.post(url, postData, function(o) {
        	$('#post_list').html("");
        	var parents = [];
        	for (var i = 0; i < o.length; i++ ) {
        		var output = PostTemplate.parent(o[i]);
        		$('#post_list').append(output);
        		parents.push(o[i].postID);
        	}
        	
        	list_comments(parents);
        	set_harted_state(parents);
        	list_heart_counts(parents);
        	show_delete_buttons(parents);
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    this.list_group_posts = function() {
    	
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_group_wall_posts/';
    	var postData = {groupID: id};
    	
        $.post(url, postData, function(o) {
        	$('#post_list').html("");
        	var parents = [];
        	for (var i = 0; i < o.length; i++ ) {
        		var output = PostTemplate.parent(o[i]);
        		$('#post_list').append(output);
        		parents.push(o[i].postID);
        	}
        	
        	list_comments(parents);
        	set_harted_state(parents);
        	list_heart_counts(parents);
        	show_delete_buttons(parents);
        }, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var list_comments = function(parents) {
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_child_posts/';
		var postData = {
			parentIDs : parents
		};
		
		$.post(url, postData, function(children) {

			for (var i = 0; i < children.length; i++) {
				PostTemplate.comment(children[i]);
			}
			
		}, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var set_harted_state = function(parents) {
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_hearted_state/';
		var postData = {
			userID : myID,
			postIDs : parents
		};
		
		$.post(url, postData, function(hearted) {
			
			for (var i = 0; i < hearted.length; i++) {
				PostTemplate.setToUnHeartButton(hearted[i]);
			}
			
		}, 'json');
    	
    };
    
    // ------------------------------------------------------------------------
    
    var list_heart_counts = function(parents) {
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/get_heart_counts/';
		var postData = {
			postIDs : parents
		};
		
		$.post(url, postData, function(counts) {

			for (var i = 0; i < counts.length; i++) {
				PostTemplate.setBadge(counts[i]);
			}
			
		}, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var heart_button_pressed = function() {
    	$("body").on('click', '#heart_button', function(e) {
			e.preventDefault();
    	
	    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?";
	    	
	    	var button = $(this);
	    	
	    	houh = $(this).html();
	    	if (houh == 'heart') {
	    		url += '/api/add_to_hearted/';
	    	} else if (houh == 'un-heart') {
	    		url += '/api/remove_from_hearted/';
	    	}
	    	
	    	post = $(this).data('button');
			var postData = {
				userID : myID,
				postID : post
			};
			
			$.post(url, postData, function(result) {

				if (result == 1 && houh == 'heart') {
					var inc = $('#badge_'+post).html();
					++inc;
					$('#badge_'+post).html(inc);
					button.html('un-heart');
				} else if (result == 1 && houh == 'un-heart') {
					var inc = $('#badge_'+post).html();
					--inc;
					$('#badge_'+post).html(inc);
					button.html('heart');
				}
				
			}, 'json');
			
		
    	});
    };
    

    // ------------------------------------------------------------------------
    
    var show_delete_buttons = function(parents) {
    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/confirm_post_ownership/';
		var postData = {
			userID : myID,
			postIDs : parents
		};
		
		$.post(url, postData, function(counts) {

			for (var i = 0; i < counts.length; i++) {
				PostTemplate.addDeleteButton(counts[i]);
			}
			
		}, 'json');
    };
    
    // ------------------------------------------------------------------------
    
    var delete_button_pressed = function() {
    	$("body").on('click', '#delete_button', function(e) {
			e.preventDefault();
    	
	    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/delete_post/';
	    	
	    	var button = $(this);
	    	
	    	post = $(this).data('button');
			var postData = {
				userID : myID,
				postID : post
			};
			
			$.post(url, postData, function(result) {

				if (result == 1) {
					console.log('deleted successfuly post ' + post);
					$("#"+post).remove();
				} else {
					Message.error("Post was not deleted, and error occured.");
				}
				
			}, 'json');
    	});
    };
    
    // ------------------------------------------------------------------------
    
    var share_button_pressed = function() {
    	$("body").on('click', '#share_button', function(e) {
			e.preventDefault();
    	
	    	var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/api/share_post/';
	    	
	    	var button = $(this);
	    	
	    	post = $(this).data('button');
			var postData = {
				userID : myID,
				postID : post
			};
			
			$.post(url, postData, function(result) {

				if (result == 1) {
					Message.success("Post was shared");
				} else {
					Message.error("Don't overshare, once is enough.");
				}
				
			}, 'json');
    	});
    };
    
    // ------------------------------------------------------------------------
    
    
    this.__construct();
};
