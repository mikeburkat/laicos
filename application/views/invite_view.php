	<div class="row" class="col-xs-10">
					<div class="container">
								
									<div class="panel panel-default" class="col-xs-6">
												<div class="panel-heading">
													<h3 class="panel-title">Enter a person's email address to generate a unique registration URL!</h3>
												</div>
											<form name = "generate" METHOD = "GET" ACTION = "">
											
											<div>
											<br>
											<label for="displayName">Email address: </label>
											<input type="email" name = "mail">
											<br> 
											<br>
											<input type = "submit" class="btn btn-primary" name = "inviteSubmit" value = "Invite!">
											</div>
											</form>
											
										
											
											<center>
											<?PHP
											if(empty($_GET['mail']))
											{
											}
											else
											{
												$email = $_GET['mail'];
												$secreturl = MD5($email);
												$base = site_url();
												mysql_query("INSERT INTO invites (invited, invitedurl) VALUES ('$email', '$secreturl')");
												echo 'Generated URL for '.$email.'<br/> '.$base.'registration/index/'.$secreturl;
												//	$results = mysql_query("SELECT email FROM user WHERE email=$email");
											}
											?>
											</center>
											
									</div>
						</div>	
							
	</div>








