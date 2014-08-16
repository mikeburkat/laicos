
<link rel="stylesheet" href="<?=base_url()?>css/group_browser.css" />

<script src="<?=base_url()?>js/group_browser_event.js"></script>
<script src="<?=base_url()?>js/group_browser_template.js"></script>
<script src="<?=base_url()?>js/group_browser.js"></script>

<!-- <?php echo '<script>var id = "' . $id . '";</script>'; ?> -->

<?php echo '<script>var passedTagId = "' . $tagId . '";</script>'; ?>

<script>
	$(function(){
// 		console.log(id);
		var groupBrowser = new GroupBrowser();
		groupBrowser.passed_tag(passedTagId);
	});
</script>


<h3>Selected Tags</h3>
<a class="clear_tags" href="clear" >Clear</a>
<div id="selected_tags"></div>
<div class="hidden" id="selected_tag_ids"></div>
<br>
<h3>Tags</h3>
<div class="container">
	<div id="tag_list"><span class="ajax-loader-gray"></span></div>
</div>
<br>
<h3>Groups</h3>
<div class="container">
	<div id="group_list"><span class="ajax-loader-gray"></span></div>
</div>
<br>



