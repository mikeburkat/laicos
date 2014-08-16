<!-- LOGIN USERNAME PASSWORD AND BUTTON ================================================== -->
<?php echo validation_errors(); ?>
<h1>Please enter your information below to log into Laicos</h1>
<div class="container"><i>Default test login is admin@default.com : 123456</i></div>
	<?php echo form_open('verifylogin'); ?>
		<div class="col-md-3">
			<div class="form-group">
				<p>
					<label for="username">Email:</label>
					<input width="171" type="text" class="form-control" id="username" name="username" placeholder="Enter your email"/>
				</p>
			</div>
			<div class="form-group">
				<p>
					<label for="password">Password:</label>
					<input width="171" type="password" class="form-control"  id="password" name="password" placeholder="Enter your password"/>
				</p>
			</div>
			<div class="form-group">
				<p>
					<input width="171" type="submit" class="form-control" value="Login"/>
				</p>
			</div>
		</div>
	<?php echo form_close(); ?>
