
<link rel="stylesheet" href="<?=site_url()?>css/user_browser.css" />

<script src="<?=base_url()?>js/user_browser_event.js"></script>
<script src="<?=base_url()?>js/user_browser_template.js"></script>
<script src="<?=base_url()?>js/user_template.js"></script>
<script src="<?=base_url()?>js/user_browser.js"></script>

<!-- <?php echo '<script>var id = "' . $id . '";</script>'; ?> -->

<script>
	$(function(){
// 		console.log(id);
		var userBrowser = new UserBrowser();
	});
</script>

<div class="container">
	<h3>Selected Filter</h3>
	<div class="container">
		<div id="selected_filters"></div>
		<div class="hidden" id="selected_filter_ids"></div>
	</div>
	<br>
	<h3>Filters</h3>
	<div class="container">
		<div id="filter_list">
			<span class="ajax-loader-gray"></span>
		</div>
	</div>
	<br>
	<h3>Users</h3>
	<div class="container">
		<div id="user_list">
			<span class="ajax-loader-gray"></span>
		</div>
	</div>
	<br>
</div>


