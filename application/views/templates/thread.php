
	<div class="container">
	<div id="post">	</div>
	</div>

<?php echo '<script>var id = "' . $id . '";</script>'; ?>
<?php echo '<script>var myID = "' . $myID . '";</script>'; ?>
<?php echo '<script>var myRole = "' . $myRole . '";</script>'; ?>
<?php echo '<script>var myStatus = "' . $myStatus . '";</script>'; ?>
<?php echo '<script>var myPrivacy = "' . $myPrivacy . '";</script>'; ?>

<script>
	$(function(){
		console.log(id);
		var user = new User();
	});
</script>

<script>
	$(function(){
		var post = new Post();
		post.get_post(<?php  echo $param_id ?>);
	});
</script>
	
<script src="<?=base_url()?>js/post_template.js"></script>
<script src="<?=base_url()?>js/message.js"></script>
<script src="<?=base_url()?>js/user_template.js"></script>
<script src="<?=base_url()?>js/user_event.js"></script>
<script src="<?=base_url()?>js/user.js"></script>
<script src="<?=base_url()?>js/post.js"></script>
