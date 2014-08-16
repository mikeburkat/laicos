
<script src="<?=base_url()?>js/gifts.js"></script>


<div class="row" class="col-xs-10">
					<div class="container">
								<div class="panel panel-default" class="col-xs-6">
											<div class="panel-heading">
													<h3 class="panel-title">Give a gift to a friend</h3>
												</div>	
		
							<div class="panel-body">
								<div class="col-md-4">				
									<label for="displayName">Select a friend:</label>


											<?php

												echo form_open("gifts/send_gift");

												echo '<select name="friend" class="form-control">';
												
												$data ['friends'] = $this->User_model->get_user_friends($this->session->userdata('userID'));

												foreach ($data ['friends'] as $friendID){
													
													$friendName = $this->User_model->get_user_setting($friendID["userID2"], "firstName");
													echo '<option value="' .  $friendID["userID2"] . '"> ' . $friendName . '</option>';
												}

												echo "</select>";

												
											?>

											<br/>

											
											<div class="row-fluid">										
												<div class="span12">
														
													<div class="row">	
													<div class="span12 offset2">													
													<input type="radio" name="gift_type" value="1">  Send a cake <br>
													<img src="<?php echo base_url();?>img/cake.png" height="100"> <br>
													
													<input type="radio" name="gift_type" value="2">  Send a beer<br>
													<img src="<?php echo base_url();?>img/beer.png" height="100"><br>
													</div>
													</div>
													<div class="row">												
													<input type="radio" name="gift_type" value="3">  Send a rose <br>
													<img src="<?php echo base_url();?>img/rose.png" height="100"> <br>
													
													<input type="radio" name="gift_type" value="4">  Send a beach ball <br>
													<img src="<?php echo base_url();?>img/beachball.png" height="100"><br>
											</div>
											</div>
											
											
											
											
											<br>
											</div>	
													
													<div class="btn-group">
											<button type="submit" class="btn btn-primary">Send gift</button>
											<a href="<?php echo site_url();?>" class="btn btn-default">Cancel</a>
										</div>

										<?php echo form_close(); ?>
																			
</div>
</div>
</div>
</div>
</div>

<div class="row" class="col-xs-10">
	<div class="container">
		<div class="panel panel-default" class="col-xs-6">
			<div class="panel-heading">
				<h3 class="panel-title">Your received gifts</h3>
			</div>	
											
		
			<div class="panel-body">
				<div class="col-md-4">				
											
					<br/>

											
					<div class="container">

						<?php

							$data ['myGifts'] = $this->User_model->get_user_gifts($this->session->userdata('userID'));

							foreach ($data['myGifts'] as $gift){
								
								$senderName = $this->User_model->get_user_setting($gift ['senderID'], "firstName");

								if($gift['giftGiven'] == '1'){
									echo '<img src="'. base_url() . 'img/cake.png" height="100">';
									echo 'From: ' . $senderName;
									echo '<br />';
								}
								elseif ($gift['giftGiven'] == '2') {
									echo '<img src="'. base_url() . 'img/beer.png" height="100">';
									echo 'From: ' . $senderName;
									echo '<br />';
								}
								elseif ($gift['giftGiven'] == '3') {
									echo '<img src="'. base_url() . 'img/beachball.png" height="100">';
									echo 'From: ' . $senderName;
									echo '<br />';
								}
								else{
									echo '<img src="'. base_url() . 'img/rose.png" height="100">';
									echo 'From: ' . $senderName;
									echo '<br />';
								}				
							}

						?>	
					</div>																
				</div>
			</div>
		</div>
	</div>
</div>

