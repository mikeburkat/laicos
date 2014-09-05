var UserEvent = function() {

	// ------------------------------------------------------------------------

	this.__construct = function() {
		console.log('User Event Created');
		Message = new Message();
		addAsFriend();
		removeFriend();
		removeFriendRequest();
		addAsFamily();
		removeFamily();
		removeFamilyRequest();
		addAsCollegue();
		removeCollegue();
		removeCollegueRequest();
		addPostForm();
		submitPost();
		cancelPost();
		addCommentForm();
		submitComment();
		cancelComment();
		selected_post_type_text();
		selected_post_type_image();
		selected_post_type_video();
	};

	var base_url = window.location.origin;
	var pathArray = window.location.pathname.split('/');

	// ------------------------------------------------------------------------

	var addAsFriend = function() {
		$("body").on('click', '#add_as_friend', function(e) {
			e.preventDefault();

			console.log('add to ' + myID + ' friend ' + id);

			var url = base_url + "/" + pathArray[1] + '/api/add_relationship/';
			var postData = {
				'myID' : myID,
				'id' : id,
				'status' : 'friends pending'
			};

			$.post(url, postData, function(data) {
				result(data);
				UserTemplate.removeFriendRequest();
			}, 'json');
		});
	};
	
	// ------------------------------------------------------------------------

	var removeFriend = function() {
		$("body").on('click', '#remove_friend', function(e) {
			e.preventDefault();

			console.log('remove ' + myID + ' friend ' + id);

			var url = base_url + "/" + pathArray[1] + '/api/remove_relationship/';
			var postData = {
				'myID' : myID,
				'id' : id,
				'status' : 'friends'
			};

			$.post(url, postData, function(data) {
				result(data);
				UserTemplate.addAsFriend();
				UserTemplate.removePost();
			}, 'json');
		});
	};
	
	// ------------------------------------------------------------------------

	var removeFriendRequest = function() {
		$("body").on('click', '#remove_friend_request', function(e) {
			e.preventDefault();

			console.log('remove ' + myID + ' friend ' + id);

			var url = base_url + "/" + pathArray[1] + '/api/remove_relationship/';
			var postData = {
				'myID' : myID,
				'id' : id,
				'status' : 'friends pending'
			};

			$.post(url, postData, function(data) {
				result(data);
				UserTemplate.addAsFriend();
				UserTemplate.removePost();
			}, 'json');
		});
	};

	// ------------------------------------------------------------------------

	var addAsFamily = function() {
		$("body").on('click', '#add_as_family', function(e) {
			e.preventDefault();

			console.log('add to ' + myID + ' friend ' + id);

			var url = base_url + "/" + pathArray[1] + '/api/add_relationship/';
			var postData = {
				'myID' : myID,
				'id' : id,
				'status' : 'family pending'
			};

			$.post(url, postData, function(data) {
				result(data);
				UserTemplate.removeFamilyRequest();
			}, 'json');
		});
	};
	
	// ------------------------------------------------------------------------

	var removeFamily = function() {
		$("body").on('click', '#remove_family', function(e) {
			e.preventDefault();

			console.log('remove ' + myID + ' friend ' + id);

			var url = base_url + "/" + pathArray[1] + '/api/remove_relationship/';
			var postData = {
				'myID' : myID,
				'id' : id,
				'status' : 'family'
			};

			$.post(url, postData, function(data) {
				result(data);
				UserTemplate.addAsFamily();
				UserTemplate.removePost();
			}, 'json');
		});
	};

	// ------------------------------------------------------------------------

	var removeFamilyRequest = function() {
		$("body").on('click', '#remove_family_request', function(e) {
			e.preventDefault();

			console.log('remove ' + myID + ' friend ' + id);

			var url = base_url + "/" + pathArray[1] + '/api/remove_relationship/';
			var postData = {
				'myID' : myID,
				'id' : id,
				'status' : 'family pending'
			};

			$.post(url, postData, function(data) {
				result(data);
				UserTemplate.addAsFamily();
			}, 'json');
		});
	};
	
	// ------------------------------------------------------------------------

	var addAsCollegue = function() {
		$("body").on('click', '#add_as_collegue', function(e) {
			e.preventDefault();

			console.log('add to ' + myID + ' friend ' + id);

			var url = base_url + "/" + pathArray[1] + '/api/add_relationship/';
			var postData = {
				'myID' : myID,
				'id' : id,
				'status' : 'collegues pending'
			};

			$.post(url, postData, function(data) {
				result(data);
				UserTemplate.removeCollegueRequest();
			}, 'json');
		});
	};
	
	// ------------------------------------------------------------------------

	var removeCollegue = function() {
		$("body").on('click', '#remove_collegue', function(e) {
			e.preventDefault();

			console.log('remove ' + myID + ' friend ' + id);

			var url = base_url + "/" + pathArray[1] + '/api/remove_relationship/';
			var postData = {
				'myID' : myID,
				'id' : id,
				'status' : 'collegues'
			};

			$.post(url, postData, function(data) {
				result(data);
				UserTemplate.addAsCollegue();
				UserTemplate.removePost();
			}, 'json');
		});
	};

	// ------------------------------------------------------------------------

	var removeCollegueRequest = function() {
		$("body").on('click', '#remove_collegue_request', function(e) {
			e.preventDefault();

			console.log('remove ' + myID + ' friend ' + id);

			var url = base_url + "/" + pathArray[1] + '/api/remove_relationship/';
			var postData = {
				'myID' : myID,
				'id' : id,
				'status' : 'collegues pending'
			};

			$.post(url, postData, function(data) {
				result(data);
				UserTemplate.addAsCollegue();
			}, 'json');
		});
	};

	// ------------------------------------------------------------------------

	var addPostForm = function() {
		$("body").on('click', '#add_post', function(e) {
			e.preventDefault();
			var type = PostTemplate.post_type();
			var form = PostTemplate.post_form();
			$('#post_button').html(type + form);
		});
	};

	// ------------------------------------------------------------------------

	var updatePostList = function(postId) {
		var url = base_url + "/" + pathArray[1] + '/api/get_user_wall_posts/';
		var postData = {
			userID : id,
			postID : postId
		};

		$.post(url, postData, function(o) {
			for (var i = 0; i < o.length; i++) {
				var output = PostTemplate.parent(o[i]);
				$('#post_list').prepend(output);
			}

			post_button = '<button type="button" id="add_post" class="btn btn-primary">Add Post</button>';
			$('#post_button').html(post_button);

		}, 'json');
	};

	// ------------------------------------------------------------------------

	var cancelPost = function() {
		$("body").on('click', '#cancel_post', function(e) {
			e.preventDefault();
			console.log('cancel pressed');
			post_button = '<button type="button" id="add_post" class="btn btn-primary">Add Post</button>';
			$('#post_button').html(post_button);
		});
	};
	
	// ------------------------------------------------------------------------
	
	function sendSubmitPost(url, postData) {
		console.log(postData);

		$.post(url, postData, function(o) {
			var output = '';
			console.log('post added? ' + o);
			updatePostList(o);
		}, 'json');
	};

	// ------------------------------------------------------------------------

	var submitPost = function() {
		$("body").on('click', '#submit_post', function(e) {
			e.preventDefault();

			var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?"
					+ '/api/add_user_wall_post/';

			console.log($('form'));
			
			var form = $('form').find("input.form-control");
			console.log(form);
			
			var type = form.prop('name');
			console.log(type);
			
			if (type == undefined) {
				form = $('form').find("textarea.form-control");
				type = form.prop('name');
				console.log("type: " + type);
			}
			
			var postData = {};
			postData['posterID'] = myID;
			postData['targetID'] = id;
			
			if (type == 'image_file') {
				
				var file = form.prop('files')[0];
				
				console.log(file);
				
				var FR = new FileReader();
		        FR.onload = function(e) {
		        	
		            postData['image'] = e.target.result;
		            sendSubmitPost(url, postData);
		             
		        };
		        FR.readAsDataURL(file);
		        
			} else if (type == 'message') {
				postData['message'] = form.prop('value');
				if (postData['message'] == "") {
					return;
				}
				sendSubmitPost(url, postData);
			} else if (type == 'video_link') {
				var videoLink = form.prop('value');
				postData['video'] = form.prop('value');
				if (postData['video'] == "") {
					return;
				}
				sendSubmitPost(url, postData);
			}
		});
	};

	// ------------------------------------------------------------------------

	var result = function(data) {
		console.log("Success or Failure");

		var split = data.split(" ");
		console.log(split);
		if (split[2] == "now" || split[2] == "not") {
			Message.success(data);
		} else if (split[2] == "already") {
			Message.error(data);
		}

	}

	// ------------------------------------------------------------------------

	var addCommentForm = function() {
		$("body").on('click', '#add_comment', function(e) {
			e.preventDefault();
			var form = PostTemplate.comment_form();
			$(this).closest('#comment_button').html(form);
		});
	};

	// ------------------------------------------------------------------------

	var cancelComment = function() {
		$("body").on('click', '#cancel_comment', function(e) {
			e.preventDefault();
			console.log('cancel pressed');
			comment_button = '<button id="add_comment" type="button" class="btn btn-primary pull-right">Add Comment</button>';
			$(this).closest('#comment_button').html(comment_button);
		});
	};
	
	// ------------------------------------------------------------------------

	var updateCommentList = function(dom, postId) {
		var url = base_url + "/" + pathArray[1] + '/api/get_one_child_post/';
		var postData = {
			postID : postId
		};

		$.post(url, postData, function(o) {
			console.log(o);
			for (var i = 0; i < o.length; i++) {	
				PostTemplate.comment(o[i]);
			}

			comment_button = '<button id="add_comment" type="button" class="btn btn-primary pull-right">Add Comment</button>';
			dom.children('div#comment_button.panel-body').html(comment_button);
		}, 'json');
	};

	// ------------------------------------------------------------------------
	
	var submitComment = function() {
		$("body").on('click', '#submit_comment', function(e) {
			e.preventDefault();
			
			var url = base_url + "/" + pathArray[1] + "/" + pathArray[2]  +"/"+ pathArray[3]  + "?"
					+ '/api/add_comment_to_post/';

			var input = $('form').serializeArray();
			
			console.log("input form: " + input);
			
			var heading = $(this).closest("div.panel.panel-default");
			
			var postID = heading.attr('id');
			
			console.log(heading);
			console.log(postID);
			
			var postData = {};
			postData['posterID'] = myID;
			postData['postID'] = postID;
			postData['message'] = $('form').prop('comment').value;

			if (postData['message'] == "") {
				return;
			}
			
			console.log(postData);
			
			$.post(url, postData, function(o) {
				var output = '';
				console.log('post added? ' + o);

				updateCommentList(heading, o);

			}, 'json');

		});
	};
	
	// ------------------------------------------------------------------------
	
	var selected_post_type_text = function() {
		$("body").on('click', '#TEXT', function(e) {
			e.preventDefault();
			
			$(this).addClass('active');
			$(this).siblings("#IMAGE").removeClass('active');
			$(this).siblings("#VIDEO").removeClass('active');
			
			var form = PostTemplate.text_form();
			$(this).parent().parent().find("#post_form").html(form);
		});
	};
	
	// ------------------------------------------------------------------------
	
	var selected_post_type_image = function() {
		$("body").on('click', '#IMAGE', function(e) {
			event.preventDefault();
			
			$(this).addClass('active');
			$(this).siblings("#TEXT").removeClass('active');
			$(this).siblings("#VIDEO").removeClass('active');
			
			var form = PostTemplate.image_form();
			$(this).parent().parent().find("#post_form").html(form);
			
		});
	};
	
	// ------------------------------------------------------------------------
	
	var selected_post_type_video = function() {
		$("body").on('click', '#VIDEO', function(e) {
			event.preventDefault();
			
			$(this).addClass('active');
			$(this).siblings("#IMAGE").removeClass('active');
			$(this).siblings("#TEXT").removeClass('active');
			
			var form = PostTemplate.video_form();
			$(this).parent().parent().find("#post_form").html(form);
			
		});
	};
	
	// ------------------------------------------------------------------------
	
	
	

	this.__construct();

};
