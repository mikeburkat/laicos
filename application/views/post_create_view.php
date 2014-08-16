<script language="Javascript">
function showGroups(x)
{
    if (x.checked)
    {
		document.getElementById("Friends").style.visibility="hidden";
		document.getElementById("Groups").style.visibility="visible";

		document.getElementById("Friends").style.display="none";
		document.getElementById("Groups").style.display="inline";
    }
}

function showFriends(x)
{
    if (x.checked)
    {
		document.getElementById("Groups").style.visibility="hidden";
		document.getElementById("Friends").style.visibility="visible";

		document.getElementById("Groups").style.display="none";
		document.getElementById("Friends").style.display="inline";
    }
}

function showMyWall(x)
{
	if (x.checked)
    {
		document.getElementById("Groups").style.visibility="hidden";
		document.getElementById("Friends").style.visibility="hidden";

		document.getElementById("Groups").style.display="none";
		document.getElementById("Friends").style.display="none";
    }
}
function showPhoto(x)
{
    if (x.checked)
    {
    document.getElementById("Photo").style.visibility="visible";
    document.getElementById("Video").style.visibility="hidden";
    document.getElementById("Photo").style.display="inline";
    document.getElementById("Video").style.display="none";
	}
}

function showVideo(x)
{
    if (x.checked)
    {
    document.getElementById("Photo").style.visibility="hidden";
    document.getElementById("Video").style.visibility="visible";

	document.getElementById("Photo").style.display="none";
    document.getElementById("Video").style.display="inline";
    }
}

function showText(x)
{
    if (x.checked)
    {
    document.getElementById("Photo").style.visibility="hidden";
    document.getElementById("Video").style.visibility="hidden";

	document.getElementById("Photo").style.display="none";
    document.getElementById("Video").style.display="none";
    }
}
</script>
<br/>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Create a new post</h3>
		</div>
		<div class="panel-body">
			<?php echo form_open_multipart('post/send');?>
			<input type="radio" onchange="showMyWall(this)" name="where" checked value="ownWall">  Post to my wall<br>
			<input type="radio" onchange="showFriends(this)" name="where" value="friendWall">  Post to a friend's wall<br/>
			<input type="radio" onchange="showGroups(this)" name="where" value="groupWall">  Post to a group's wall<br/>
			<div id="Friends" style="visibility:hidden;display:none;">Select a friend: <br/>
				<select name="friendID" class="form-control">
				<?php foreach ($friend_list as $friend):?>
				<option value="<?php echo $this->User_model->get_user_setting($friend["userID2"],'userID');?>"><?php echo $this->User_model->get_user_setting($friend["userID2"],'firstName');
				echo " ", $this->User_model->get_user_setting($friend["userID2"],'lastName');
				?></option> <?php endforeach;?> </select><br/>
			</div>
			<div id="Groups" style="visibility:hidden;display:none;">
				Select a group: <br>
				<select name="groupID" class="form-control" >
				<?php foreach ($group_list as $group):?>
				<option value="<?php echo $this->Group_model->get_group_setting($group["clubID"],'clubID'); ?>"><?php echo $this->Group_model->get_group_setting($group["clubID"],'name');
				?></option><?php endforeach;?></select><br/>
			</div>
			<br/>
			<textarea rows="10" cols="60" name="message" class="form-control" placeholder="Enter your message."></textarea>
			<br/>

			<input type="radio" onchange="showText(this)" name="post_type" value="TEXT" checked>  Text message - rock it old school<br>
			<input type="radio" onchange="showPhoto(this)" name="post_type" value="IMAGE">  Attach an image like it's 2006<br>
			<input type="radio" onchange="showVideo(this)" name="post_type" value="VIDEO">  Embed a Youtube video<br>

			<div id="Photo" style="visibility:hidden;display:none;">
				Select image to attach:
				<input type="file" name="userfile" size="20" class="form-control" /> <br>
			</div>
			<div id="Video" style="visibility:hidden;display:none;" class="form-control">
				Youtube Video to embed:
				<input type="text" name="embedID"><br>


			</div>
			<br/>
			<div class="btn-group">
				<button type="submit" class="btn btn-primary">Post Message</button>
				<a href="<?php echo site_url();?>" class="btn btn-default">Cancel</a>
			</div>
	</form>
	</div>
	</div>
</div>
