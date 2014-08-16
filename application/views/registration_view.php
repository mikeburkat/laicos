<!-- REGISTRATION FORM =================================================================== -->
<?php echo validation_errors(); ?>
<h1>Looks like you've been given a secret registration URL! Welcome. :D</h1>
	<?php echo form_open("registration/send"); ?>
		<div class="col-md-3">
			<div class="form-group">
				<p>
					<label for="displayName">Display Name:</label>
					<input type="text" class="form-control" id="displayName" name="displayName" placeholder="Enter the name you wish to display"value="<?php echo set_value('displayName'); ?>" />
				</p>
			</div>
			<div class="form-group">
				<p>
					<label for="firstName">First Name:</label>
					<input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your First Name" value="<?php echo set_value('firstName'); ?>" />
				</p>
			</div>
			<div class="form-group">
				<p>
					<label for="lastName">Last Name:</label>
					<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your Last Name"value="<?php echo set_value('lastName'); ?>" />
				</p>
			</div>
			<div class="form-group">
				<p>
					<label for="dateOfBirth">Date of Birth:</label>
					<input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" placeholder="Enter your DOB"value="<?php echo set_value('dateOfBirth'); ?>" />
				</p>
			</div>	
			<div class="form-group">
				<p>
					<label for="tagline">Tagline:</label>
					<input type="text" class="form-control" id="tagline" name="tagline" placeholder="Enter something about you"value="<?php echo set_value('tagline'); ?>" />
				</p>
			</div>
			<div class="form-group">
				<p>
					<label for="email">Your Email:</label>
					<input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo set_value('email'); ?>" />
				</p>
			</div>
			<div class="form-group">
				<p>
					<label for="password">Password:</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" value="<?php echo set_value('password'); ?>" />
				</p>
			</div>
			<div class="form-group">
				<p>
					<label for="con_password">Confirm Password:</label>
					<input type="password" class="form-control" id="con_password" name="con_password" placeholder="Enter your password once more"value="<?php echo set_value('con_password'); ?>" />
				</p>
			</div>
			<div class="form-group">
				<p>
					<label for="address">Address:</label>
					<input type="text" class="form-control" id="address" name="address" placeholder="Enter your address"value="<?php echo set_value('address'); ?>" />
				</p>
			</div>
			<div class="form-group">
				<p>
					<label for="cityName">City:</label>
					<input type="text" class="form-control" id="cityName" name="cityName" placeholder="Enter your City"value="<?php echo set_value('cityName'); ?>" />
				</p>
			</div>
			<div class="form-group">
				<p>
					<label for="province">Province:</label>
					<input type="text" class="form-control" id="province" name="province" placeholder="Enter your City"value="<?php echo set_value('province'); ?>" />
				</p>
			</div>
			<div class="form-group">
				<p>
					<label for="country">Country:</label>
					<input type="text" class="form-control" id="country" name="country" placeholder="Enter your Country"value="<?php echo set_value('country'); ?>" />
				</p>
			</div>				
			<div class="form-group">
					<label for="Profile Privacy">Profile Privacy:</label>
					<div class="span4"> <input type="radio" class="radio" id="privacy"  name="privacy" value="public" <?php echo set_checkbox('privacy', 'public'); ?>>Public </div>
					<div class="span4"> <input type="radio" class="radio" id="privacy"  name="privacy" value="private" <?php echo set_checkbox('privacy', 'private'); ?>>Private </div>
			</div>
			
			<div class="form-group">
				<p>
					<input type="submit" class="form-control" class="greenButton" value="Submit" />
				</p>
			</div>
			
			
			
			
			
			
			
			
			
			
		</div>
	<?php echo form_close(); ?>
