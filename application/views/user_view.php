
<link rel="stylesheet" href="<?=base_url()?>css/user_profile.css" />

<script src="<?=base_url()?>js/message.js"></script>
<script src="<?=base_url()?>js/post_template.js"></script>
<script src="<?=base_url()?>js/user_template.js"></script>
<script src="<?=base_url()?>js/user_event.js"></script>
<script src="<?=base_url()?>js/user.js"></script>
<script src="<?=base_url()?>js/post.js"></script>


<?php  $this->output->enable_profiler(false);?>

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
		post.list_user_posts();
	});
</script>

<div class="row">
	<div class="col-md-4">
		<div id="user_info_block">
			<div class="row">
				<div  class="col-md-offset-1">
					
					<br><br>
					<div id="edit_profile"></div>
					<div id="frind_button"></div>
					<div id="family_button"></div>
					<div id="collegue_button"></div>
					<br>
					
					<div id="user_name"></div>
					
					<div id="profile_photo">
					<?php 
					
					$sql = $this->db->select("*")->from("user")->where("email", $this->session->userdata('email'))->get();
					foreach ($sql->result() as $my_info) {
						$db_pic = $my_info -> profilePhoto;
					}
					$db_pic = $my_info -> profilePhoto;
					
					$pic_url = 'uploads/'.$db_pic;			
					?>
					<img src="<?php echo base_url().$pic_url;?>" height="100"></div> <br>
					
					
					<div id="user_info">
					
						<span class="ajax-loader-gray"></span>
					</div>
				</div>
			</div>
		</div>
	
		<div id="user_friends_block">
			<div class="row">
				<div class="col-md-offset-1">
					<h3>Family</h3>
					<div id="user_family" class="row">
						<span class="ajax-loader-gray"></span>
					</div>
					<br>
					<h3>Friends</h3>
					<div id="user_friends" class="row">
						<span class="ajax-loader-gray"></span>
					</div>
					<br>
					<h3>collegues</h3>
					<div id="user_collegues" class="row">
						<span class="ajax-loader-gray"></span>
					</div>
					<br>
					<h3>Groups Owned</h3>
					<div id="create_new_group"></div>
					<div id="user_groups_owned">
						<span class="ajax-loader-gray"></span>
					</div>
					<br>
					<h3>Groups Member</h3>
					<div id="user_groups_member">
						<span class="ajax-loader-gray"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8" id="user_posts_block">
		<h3>Wall</h3>
		<?php
		if (!empty($stream_id)) { ?>
		<div class="container">
		This user is broadcasting:<br>
		<iframe width="420" height="315" src="//www.youtube.com/embed/<?php 
		echo $stream_id;
		?>" frameborder="0" allowfullscreen></iframe><br><br>
		</div>
		<?php } ?>
		<div id="post_button"></div>
		<br>
		<div id="post_list">
			<span class="ajax-loader-gray"></span>
		</div>
	</div>
</div>
