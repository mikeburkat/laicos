<div class="container">
				<div class="row" class="col-xs-10">
					<div class="container">
									<!-- CHANGE PW FORM =================================================================== -->
									<div class="panel panel-default" class="col-xs-6">
									<?php echo validation_errors(); ?>
									<div class="panel-heading">
										<h3 class="panel-title">Want to change your password? Do it here!</h3>
									</div>
										<?php echo form_open("settings/change_password"); ?>
											<div class="panel-body">
												<div class="col-xs-4">
													<label for="opassword">Old Password:</label>
													<input type="password" class="form-control" id="opassword" name="opassword" placeholder="Enter your old password" value="<?php echo set_value('opassword'); ?>" />
													<label for="npassword">New Password:</label>
													<input type="password" class="form-control" id="npassword" name="npassword" placeholder="Enter your new password" value="<?php echo set_value('npassword'); ?>" />
													<label for="cpassword">Confirm Password:</label>
													<input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Repeat your new password" value="<?php echo set_value('cpassword'); ?>" />
													<br>
													<input type="submit" class="btn btn-primary" value="Submit" />
												</div>
											</div>	
										<?php echo form_close(); ?>
									</div>			
	
									<div class="panel panel-default" class="col-xs-6">
									<div class="panel-heading">
										<h3 class="panel-title">Change your privacy settings below.</h3>
									</div>
										<?php echo form_open("settings/change_privacy"); ?>
											<div class="panel-body">
												<div class="row">
												    <div class="col-xs-10">
													<label for="Profile Privacy">Profile Privacy:</label>
													<input type="radio" class="radio" id="privacy"  name="privacy" value="public" <?php echo set_checkbox('privacy', 'public'); ?>>Public
													<input type="radio" class="radio" id="privacy"  name="privacy" value="private" <?php echo set_checkbox('privacy', 'private'); ?>>Private
													<br>
													<input type="submit" class="btn btn-primary" value="Submit" />
													</div>
												</div>
											</div>
										<?php echo form_close(); ?>
									</div>
					</div> <!--container-->
				</div><!--row-->

<!-- CHANGE PROFILE PHOTO =================================================================== -->
					<div class="row" class="col-xs-10">
							<div class="container">	
								<div class="panel panel-default" class="col-xs-6">
									<div class="panel-heading">
											<h3 class="panel-title">Change your profile photo</h3>
									</div>
										<?php echo form_open_multipart("settings/change_profile_photo"); ?>
											<div class="panel-body">
														<div class="row">
															<div class="col-xs-10">
																
																	<div class="col-md-6">
																		<div class="form-group">
																			<label for="address">Select image to attach:</label>
																			<input type="file" name="userfile" size="20" class="form-control" /> <br>

																			<input type="submit" class="btn btn-primary" value="Upload" />
																		</div>
																	</div>
																
															</div>
														</div>
												</div>
										<?php echo form_close(); ?>
										
										
										
								</div>
						</div> <!--container-->
					</div><!--row-->	
				
						<!-- CHANGE ADDRESS =================================================================== -->
					<div class="row" class="col-xs-10">
							<div class="container">	
								<div class="panel panel-default" class="col-xs-6">
									<div class="panel-heading">
											<h3 class="panel-title">Update your address</h3>
									</div>
										<?php echo form_open("settings/change_address"); ?>
											<div class="panel-body">
														<div class="row">
															<div class="col-xs-10">
																<div class="col-md-4">
																	<div class="col-md-12">
																		<div class="form-group">
																			<label for="address">Address:</label>
																			<input type="text" class="form-control" id="address" name="address" placeholder="Enter your new address" value="<?php echo set_value('address'); ?>" />
																			<label for="city">City:</label>
																			<input type="text" class="form-control" id="city" name="city" placeholder="Enter your new city" value="<?php echo set_value('city'); ?>" />
																			<label for="province">Province:</label>
																			<input type="text" class="form-control" id="province" name="province" placeholder="Enter your province" value="<?php echo set_value('province'); ?>" />
																			<label for="country">Country:</label>
																			<input type="text" class="form-control" id="country" name="country" placeholder="Enter your country" value="<?php echo set_value('country'); ?>" />
																			<br>
																			<input type="submit" class="btn btn-primary" value="Submit" />
																		</div>
																	</div>
																</div>
															</div>
														</div>
												</div>
										<?php echo form_close(); ?>
								</div>
						</div> <!--container-->
					</div><!--row-->	
							<!-- CHANGE TAGLINE =================================================================== -->				
									<div class="row" class="col-xs-10">
										<div class="container">
											<div class="panel panel-default" class="col-xs-6">
												<div class="panel-heading">
														<h3 class="panel-title">Update your tagline</h3>
												</div>
													<?php echo form_open("settings/change_tagline"); ?>
													
													<div class="panel-body">
														<div class="col-md-4">
															<div class="col-md-12">
															
																	<label for="tagline">Tagline:</label>
																	<input type="text" class="form-control" id="tagline" name="tagline" placeholder="Enter your new tagline" value="<?php echo set_value('tagline'); ?>" />
																	<br>
																	<input type="submit" class="btn btn-primary" value="Submit" />
															</div>
														</div>
													</div>
											</div>
													<?php echo form_close(); ?>
										</div> <!--container-->
									</div><!--row-->	
							<!-- CHANGE DISPLAY NAME =================================================================== -->
					<div class="row" class="col-xs-10">
					<div class="container">
								
											<div class="panel panel-default" class="col-xs-6">
												<div class="panel-heading">
													<h3 class="panel-title">Update your Display Name.</h3>
												</div>
													<?php echo form_open("settings/change_display_name"); ?>
													<div class="panel-body">
														<div class="col-md-4">
																	<div class="col-md-12">
																		<label for="displayName">New Display Name:</label>
																		<input type="text" class="form-control" id="displayName" name="displayName" placeholder="Enter your new tagline" value="<?php echo set_value('displayName'); ?>" />
																		<br>
																		<input type="submit" class="btn btn-primary" value="Submit" />
																	</div>
														</div>
													</div>
													<?php echo form_close(); ?>
											</div>
								</div>	
							
					</div>
												



<div class="row" class="col-xs-10">
	<div class="container">
		<div class="panel panel-default" class="col-xs-6">
			<?php 
	
			$userRole = $this->session->userdata('role');
								
			if ( $userRole == 'administrator') { 
			
			?>
			
			<!-- ADMIN SETTINGS: ADMINISTRATOR =================================================================== -->		
			
			
							<div class="panel-heading">
									<h3 class="panel-title">Change User Roles (Administrator)</h3>
							</div>	
											<?php echo form_open('settings/change_user_role_status');?>
		
							<div class="panel-body">
								<div class="col-md-4">
									
											
									
									<label for="displayName">Change other users' status:</label>
											
											<select name="targetUser" class="form-control">
											
											<?php 
															
												$result = $this->User_model->get_all_users();
				
												foreach ($result as $user):
											?>
												<option value="<?php echo $this->User_model->get_user_setting($user["userID"],'userID');?>">
												
												<?php 
											
												echo $this->User_model->get_user_setting($user["userID"],'firstName'); echo " -> ", $this->User_model->get_user_setting($user["userID"],'email');
											
												?>
												
												</option> 
											
											<?php
											endforeach;
											?> 
											
											</select>
															<br/>
				
															<input type="radio" id= "role" name="role" value="junior" <?php echo set_checkbox('role', 'junior'); ?> checked > Junior 
															<input type="radio" id= "role" name="role" value="senior" <?php echo set_checkbox('role', 'senior'); ?> > Senior
															<input type="radio" id= "role" name="role" value="administrator" <?php echo set_checkbox('role', 'administrator'); ?>> Admin
															<br>
															<input type="radio" id= "role" name="status" value="active" <?php echo set_checkbox('status', 'active'); ?> checked> Active
															<input type="radio" id= "role" name="status" value="inactive" <?php echo set_checkbox('status', 'inactive'); ?> > Inactive
															<input type="radio" id= "role" name="status" value="suspended" <?php echo set_checkbox('status', 'suspended'); ?> > Suspended
															<br>
															<br>
															<input type="submit" class="btn btn-primary" value="Submit" />
								</div>
							</div>
							
											
											
													
											
			
										<?php echo form_close(); ?>
						
			<?php 

													
			} else if ($userRole == 'senior') { 
			
			?>
			
			<!-- ADMIN SETTINGS: SENIOR =================================================================== -->		
			
					
						
							<div class="panel-heading">
								<h3 class="panel-title">Change User Roles (Senior)</h3>
							</div>	
							<?php echo form_open('settings/change_user_role_status');?>
		
									<div class="panel-body">
										<div class="col-md-4">
																													
											<label for="displayName">Change other users' status:</label>
											
											<select name="targetUser" class="form-control">
											
											<?php 
															
												$result = $this->User_model->get_junior_or_senior_users();
				
												foreach ($result as $user):
											?>
												<option value="<?php echo $this->User_model->get_user_setting($user["userID"],'userID');?>">
												
												<?php 
											
												echo $this->User_model->get_user_setting($user["userID"],'firstName'); echo " -> ", $this->User_model->get_user_setting($user["userID"],'email');
											
												?>
												
												</option> 
											
											<?php
											endforeach;
											?> 
											
											</select>
											<br/>
				
															<input type="radio" id= "role" name="role" value="junior" <?php echo set_checkbox('role', 'junior'); ?> checked > Junior 
															<input type="radio" id= "role" name="role" value="senior" <?php echo set_checkbox('role', 'senior'); ?> > Senior
											<br>
															<input type="radio" id= "role" name="status" value="active" <?php echo set_checkbox('status', 'active'); ?> checked> Active
															<input type="radio" id= "role" name="status" value="inactive" <?php echo set_checkbox('status', 'inactive'); ?> > Inactive
												
											<br>
											<br>
															<input type="submit" class="btn btn-primary" value="Submit" />
										</div>
									</div>
								
							<?php echo form_close(); ?>
										
										
					
			
			
			
			<?php
			} else { 
			?>
			
			<!-- ADMIN SETTINGS: JUNIOR =================================================================== -->	
			
			
			<H1>YOU ARE A JUNIOR USER. REQUEST A HIGHER ROLE.</H1>
			
			
			<?php 
			
			echo 'This is a Junior account';
			
			}
			?>
			</div>
		</div> <!--container-->	
	</div> <!--row-->	
</div>	<!--BIG CONTAINER -->
