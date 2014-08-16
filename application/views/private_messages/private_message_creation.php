<script language="Javascript">


</script>
<div class="row">
		<div class="container">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Create a new private message</h3>
				</div>
				<div class="panel-body">

					<?php echo form_open_multipart('message/send');?>
						
						<div id="Friends" >
							<label for="recipients">Recipients</label>
							<select multiple name="friendID[]" class="form-control">
							
							<?php foreach ($friend_list as $friend):?>
								<option value="<?php echo $this->User_model->get_user_setting($friend["userID2"],'userID');?>">
								
												<?php echo $this->User_model->get_user_setting($friend["userID2"],'firstName');
														echo " ", $this->User_model->get_user_setting($friend["userID2"],'lastName');
													?>
								</option> 
							<?php endforeach;?> 
							
							</select><br/>
						</div>
						
						<label for="body">Message body</label>
						<textarea style="resize:none" name="message" class="form-control" rows="10" id="body "placeholder="Your Message"></textarea>
						
						<p></p>
						<div class="container">
						<button type="submit" class="btn btn-primary">Send</button>
						<a href="<?php echo site_url();?>message/inbox/" class="btn btn-default">Cancel</a>
						
						

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>