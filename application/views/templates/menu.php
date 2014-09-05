<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">


  <div class="container">


    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo site_url();?>"><?php echo $projectName;?></a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">friends<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url();?>user/browser/">Browse</a></li>
            <li><a href="<?php echo site_url();?>user/friends/">where art thou!?</a></li>
			<li><a href="<?php echo site_url();?>user/gifts/">Gifts</a></li>

            <li><a href="<?php echo site_url();?>stream/">Broadcast</a></li>
			<!--<li><a href="<?php echo site_url();?>friends/add/">Add a friend</a></li> -->
          </ul>
        </li>

		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Groups<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url();?>group/browser/">Browse</a></li>

			<?php if ( ($this->session->userdata('myRole') == "senior") || ($this->session->userdata('role') == "administrator")) : ?>
			<li><a href="<?php echo site_url();?>group/create/">Create</a></li>
			<?php endif; ?>

          </ul>
        </li>

		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">compose<b class="caret"></b></a>
          <ul class="dropdown-menu">

			<li><a href="<?php echo site_url();?>post/create">create a post</a></li>
			<li><a href="<?php echo site_url();?>message/inbox/">Messages</a></li>
          </ul>
        </li>

		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account<b class="caret"></b></a>
          <ul class="dropdown-menu">

            <li><a href="<?php echo site_url();?>user/">Profile</a></li>
			<li><a href="<?php echo site_url();?>user/settings/">Settings</a></li>
			<li><a href="<?php echo site_url();?>user/logout/">logout</a></li>
			<li><a href="<?php echo site_url();?>admin/">Admin</a></li>

          </ul>
        </li>
      </ul>
	   <!--START OF PROFILE PHOTO -->
		<div id="profile_logo">
<?php

					$sql = $this->db->select("*")->from("user")->where("email", $this->session->userdata('email'))->get();
					foreach ($sql->result() as $my_info) {
					$db_pic = $my_info -> profilePhoto;
					}
					$pic_url = 'uploads/'.$db_pic;
					?>
					<img src="<?php echo base_url().$pic_url;?>" height="50">
				</div>


<!-- <img height="54" src="
  <?php
 //var_dump($this->session->userdata);
  // need to fix with uploads
  //echo site_url();
  //uploads/profile.png;
 // echo site_url(); ?> img/profile.png
<?php // echo $this->session->userdata('profilePhoto'); ?>
">
  <?php
	// profile .png is temp till we fix changing the urls properly
	// bool Imagick::adaptiveResizeImage ( int $columns , int $rows [, bool $bestfit = false ] );

  ?> -->
  <!--END OF PROFILE PHOTO -->
    </div><!--/.nav-collapse -->

</div>
</div>
