var PostTemplate = function() {

	// ------------------------------------------------------------------------

	this.__construct = function() {
		console.log('Post Template Created');
	};

	var base_url = window.location.origin;
	var pathArray = window.location.pathname.split('/');

	// ------------------------------------------------------------------------

	this.parent = function(parent) {
		console.log('this is coming from the post_template...');
		console.log(parent);

		var output = '';
		output += '<div id="'+parent.postID+'" class="panel panel-default">';
		output += '<div class="panel-heading">';
		output += '<h3 class="panel-title">' + '<a href="' + base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?"
		output += '/user/show/' + parent.userID + '">' + parent.firstName + ' ' + parent.lastName + '</a>'
		output += ' @ ' + '<a href="'+base_url+ "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?" + '/post/show/' + parent.postID+ '">' + parent.timeCreated+ '<a/>     ';
		
		output += '<span id="delete_' + parent.postID + '"></span>   ';
		
		if (myID != parent.userID) {
			output += '<button id="share_button" data-button="' + parent.postID + '" type="button" class="btn btn-xs">share</button>';
		}
		
		output += '<div id="heart_block" class="pull-right">';
		output += '<span id="badge_' + parent.postID + '" class="badge">0</span>     ';
		output += '<button id="heart_button" data-button="' + parent.postID + '" type="button" class="btn btn-xs">heart</button>';
		output += '</div>';
		
		output += '</h3>';
		output += '</div>';
		
		// format a text post
		if (parent.type == 'TEXT') {
			output += '<div class="panel-body" id="text">';
			output += parent.text;
			output += '</div>';
		} 
		
		// format an image post
		else if (parent.type == 'IMAGE') {
			output += '<div class="panel-body" id="image_'+parent.postID+'" >';
			output += '<center><img width="550" src="'+base_url+'/'+pathArray[1] + '/' + pathArray[2] + '/uploads/' + parent.postID + '.jpg" /></center>';
			
			output += '</div>';
		} 
		
		// format a video link to embed within post
		else if (parent.type == 'VIDEO') {
			var videoArray = parent.link_url.split("watch?v=");
			console.log(videoArray);
			var video = videoArray[1];
			output += '<div class="panel-body" id="text"><center>';
			output += '<iframe width="560" height="315" src="//www.youtube.com/embed/' + video + '"';
			output += ' frameborder="0" allowfullscreen></iframe></center>';
			output += '</div>';
		}
		
		output += '<div id="comments_for_' + parent.postID + '">';
		output += '</div>';
		
		output += '<div class="panel-body" id="comment_button">';
		output += '<button id="add_comment" type="button" class="btn btn-primary pull-right">Add Comment</button>';
		output += '</div>';
		
		output += '</div>';

		return output;
	};

	// ------------------------------------------------------------------------

	this.comment = function(child) {
		console.log(child);

		var output = '';
		output += '<div class="row">';
		output += '<div class="well col-md-offset-1 col-md-10">';
		output += '<a href="' + base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?"
		output += '/user/show/' + child.userID + '">' + child.firstName + ' ' + child.lastName + '</a>'
		output +=  ' @ ' + child.dateCreated;
		output += '<br>' + child.text;
		output += '</div>';
		output += '</div>';

		$('#comments_for_' + child.parentID).append(output);
	};
	
	// ------------------------------------------------------------------------
	
	this.setBadge = function(child) {
		console.log(child);
		$('#badge_'+child.postID).html(child.total);
	};
	
	// ------------------------------------------------------------------------
	
	this.setToUnHeartButton = function(child) {
		console.log("set to un-heart " + child.postID);
		$("#heart_button[data-button*='" + child.postID + "']").html('un-heart');
	};

	// ------------------------------------------------------------------------
	
	this.addDeleteButton = function(myPost) {
		var button = '<button id="delete_button" type="button" class="btn btn-xs"';
		button += 'data-button="' + myPost.postID + '" >delete</button>';
		
		console.log('adding delete to ' + myPost.postID);
		$("#delete_" + myPost.postID).html(button);
	};

	// ------------------------------------------------------------------------
	
	this.post_form = function() {

		var form = '';
		form += '<form role="form">';
		form += '<div id="post_form" class="form-group">';
		form += '<label for="description" class="control-label">Post a Message</label>';
		form += '<textarea name="message" class="form-control" rows="3" placeholder="Your Message"></textarea>';
		form += '</div>';
		form += '<button id="submit_post" type="submit" class="btn btn-success">Submit</button>';
		form += '<button id="cancel_post" type="submit" class="btn btn-danger">Cancel</button>';
		form += '</form>';

		return form;
	};
	
	// ------------------------------------------------------------------------
	
	this.text_form = function() {
		
		var form = '';
		form += '<label for="description" class="control-label">Post a Message</label>';
		form += '<textarea form="post_form" name="message" class="form-control" rows="3" placeholder="Your Message"></textarea>';
		return form;
	};
	
	// ------------------------------------------------------------------------
	
	this.image_form = function() {
		
		var form = '';
		form += '<label for="description" class="control-label">Post an Image from File</label>';
		form += '<input name="image_file" type="file" name="userfile" size="20" class="form-control" accept="image/*">';
		return form;
	};
	
	// ------------------------------------------------------------------------
	
	this.video_form = function() {
		
		var form = '';
		form += '<label for="description" class="control-label">Post a Video as a YouTube link</label>';
		form += '<input name="video_link" type="text" class="form-control">';
		return form;
	};
	
	// ------------------------------------------------------------------------
	
	this.post_type = function() {
		
		var type = '';
		type += '<div class="btn-group">';
		type += '<button id="TEXT" type="button" class="btn btn-default active">Text</button>';
		type += '<button id="IMAGE" type="button" class="btn btn-default">Image</button>';
		type += '<button id="VIDEO" type="button" class="btn btn-default">Video</button>';
		type += '</div>';
		
		return type;
	};

	// ------------------------------------------------------------------------
	
	this.comment_form = function() {

		var form = '';
		form += '<form role="form">';
		form += '<div id="comment_form" class="form-group">';
		form += '<label for="description" class="control-label">Comment</label>';
		form += '<textarea name="comment" class="form-control" rows="3" placeholder="Your Comment"></textarea>';
		form += '</div>';
		form += '<button id="submit_comment" type="submit" class="btn btn-success">Submit</button>';
		form += '<button id="cancel_comment" type="submit" class="btn btn-danger">Cancel</button>';
		form += '</form>';

		return form;
	};

	// ------------------------------------------------------------------------

	this.__construct();

};
