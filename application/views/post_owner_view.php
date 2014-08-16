<div class="container">
	<h3>Currently allowing comments:
	<?php if ($allowsComments): ?>
		Yes. <a href="<?php echo site_url();?>post/disable_comments/<?php echo $postID;?>">Disable Comments </a>
	<?php elseif (!$allowsComments): ?>
		No. <a href="<?php echo site_url();?>post/enable_comments/<?php echo $postID;?>">Enable Comments </a></h3>
	<?php endif; ?>
	<br>
	<h3><a href="<?php echo site_url();?>post/delete/<?php echo $postID;?>">Delete Post </a></h3></br>
</div>