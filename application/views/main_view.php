
<div class="container">
	<div class="page-header">
		<h1>Welcome back, <?php echo $firstName;?></h1>
	</div>
	<p>
		<a href="<?php echo site_url();?>friends/add/">Find some friends</a>,
		or <a href="<?php echo site_url();?>group/browser">join some groups</a>
	</p>

	
	<?php echo '<script>var myID = "' . $myID . '";</script>'; ?>
	<?php echo '<script>var id = "' . $id . '";</script>'; ?>
	<?php echo '<script>var myRole = "' . $myRole . '";</script>'; ?>
	<?php echo '<script>var myStatus = "' . $myStatus . '";</script>'; ?>
	<?php echo '<script>var myPrivacy = "' . $myPrivacy . '";</script>'; ?>

	<h2>Requests</h2>
	<div id="requests">
		You have no pending requests.
	</div>
	<br>
</div>

<script>
	$(function(){
		var requests = new FriendRequest();
	});
</script>

<div class="container">
<div id="newsfeed">	</div>
</div>


<script>
	$(function(){
		console.log(id);
		var user = new User();
	});
</script>

<script>
	$(function(){
		var post = new Post();
		console.log('calling get newsfeed...');
		post.get_newsfeed();
	});
</script>


<script src="<?=base_url()?>js/message.js"></script>
<script src="<?=base_url()?>js/friend_request.js"></script>
<script src="<?=base_url()?>js/post_template.js"></script>
<script src="<?=base_url()?>js/user_template.js"></script>
<script src="<?=base_url()?>js/user_event.js"></script>
<script src="<?=base_url()?>js/user.js"></script>
<script src="<?=base_url()?>js/post.js"></script>
