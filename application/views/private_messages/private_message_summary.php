    <div class="row">
		<div class="container">
		
			<div class="panel panel-default">
			
				<div class="panel-heading">
				<h3 class="panel-title">
				<a href= <?php echo site_url() . 'message/pm_thread/' .  $post['0']->postID ?> >
					<?php 
					echo 'GO TO : Conversation started @ ';
					echo '' . $post['0']->timeCreated . ' '; 
					?>
				</a>
				</h3>
				</div>
				
				<div class="panel-body">
					Participants : 
					<div class="list-group">				
					<?php		
					
					foreach($participants as $person)
					{
						echo '<a href=' . site_url() . 'user/show/' . $person->userID . ' class="list-group-item">';
						echo $person->firstName . ' ';
						echo $person->lastName . ' ' ;
						echo '</a>';
					}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>