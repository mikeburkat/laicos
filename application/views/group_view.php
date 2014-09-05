
<link rel="stylesheet" href="<?=base_url()?>css/group_profile.css" />

<script src="<?=base_url()?>js/post_template.js"></script>
<script src="<?=base_url()?>js/post.js"></script>
<script src="<?=base_url()?>js/message.js"></script>
<script src="<?=base_url()?>js/group_template.js"></script>
<script src="<?=base_url()?>js/group_event.js"></script>
<script src="<?=base_url()?>js/group.js"></script>



<?php echo '<script>var id = "' . $id . '";</script>'; ?>
<?php echo '<script>var myID = "' . $myID . '";</script>'; ?>
<?php echo '<script>var myRole = "' . $myRole . '";</script>'; ?>
<?php echo '<script>var myStatus = "' . $myStatus . '";</script>'; ?>
<?php echo '<script>var myPrivacy = "' . $myPrivacy . '";</script>'; ?>

<script>
	$(function(){
		console.log(id);
		var group = new Group(id);
	});
</script>

<script>
	$(function(){
		var post = new Post();
		post.list_group_posts();
	});
</script>

<div class="row">
	<div class="col-md-4" id="group_info_block">
		<h3>Info</h3>
		<div id="join_button"></div>
		<br>
		<div id="delete_group"></div>
		<div id="group_info">
			<span class="ajax-loader-gray"></span>
		</div>
		<br>
		<h3>Tags</h3>
		<div id="tags">
			<span class="ajax-loader-gray"></span>
		</div>
		<br>
		<h3>Group Owner</h3>
		<div id="group_owner">
			<span class="ajax-loader-gray"></span>
		</div>
		<br>
		<h3>Group Members</h3>
		<div id="group_members">
			<span class="ajax-loader-gray"></span>
		</div>
		<br>
	</div>

	<div class="col-md-8" id="user_posts_block">
		<h3>Wall</h3>
		<div id="post_button"></div>
		<br>
		<div id="post_list">
			<span class="ajax-loader-gray"></span>
		</div>
	</div>
	
	
	
	
	
