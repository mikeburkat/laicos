<?php $this->load->view('templates/header');?>
	<body>
	<div class="col-md-3"></div>
	<form role="form" action="index.php/main/welcome/" class="col-md-6">
	  <div class="form-group">
		<label for="exampleInputEmail1">User name</label>
		<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter user name">
	  </div>
	  <div class="form-group">
		<label for="exampleInputPassword1">Password</label>
		<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
	  </div>
	  just push the button no checking : <button type="submit" class="btn btn-default">Submit</button>
	</form>
	<div class="col-md-3"></div>
<?php $this->load->view('templates/footer');?>