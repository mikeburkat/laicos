   
<div class="container">
	<div class="page-header">
        <h1>Broadcast to your friends</h1>
      </div>
	  All you have to do is set your video stream to any Youtube or Hangout on Air ID. Then, you will be broadcasting that to your social network.
</div>
 <div class="container">Enter the Youtube ID you would like to broadcast:
  <?php
    $data = array(
        'name'        => 'yt_id',
        'id'          => 'yt_id',
        'value'       => (string)$stream_id,
        'maxlength'   => '300',
        'size'        => '100',
        'style'       => 'width:300px',
    );
    echo form_open('stream/set');
    echo form_input('video_url');
    echo form_submit('submit', 'Broadcast');
    echo form_close();
  ?>
</div>
