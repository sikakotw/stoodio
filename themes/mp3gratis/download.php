<div id="main">
  <div class="left-bar">
	<div class="bh-top">      
	  <h1 class="ht">Download <?php echo $result['title']; ?> MP3 & Video MP4</h1><br>
	  <center><img src="<?php echo $result['image']; ?>" width="250" height="200" alt="Download Lagu <?php echo $result['title']; ?> MP3"></center></center>
	</div><br/>
    <div class="bh-info">
	  <span class="f12"><?php echo $result['channel']; ?></span> | <b class="play-count"><?php echo $result['view']; ?> View - <?php echo $result['duration']; ?> Min</b>
      <br/>
    </div>
	<br/><br/>
	<center>
	  <a href="#" target="_blank" rel="nofollow" class="download" style="text-align:center;font-size:14px;color:#fffd66;font-weight:bold;">DOWNLOAD MP3</a>
	  <br/><br/>
	  <a href="<?php echo convert_permalink($result['id']); ?>" target="_blank" rel="nofollow" class="download" style="text-align:center;font-size:14px;color:#8bff24;font-weight:bold;">DOWNLOAD NOW</a>
	</center>
	<br/><br/>
	<div class="gt">
	  <p>Download lagu <strong><?php echo $result['title']; ?></strong> dari single terbarunya gratis di <?php echo get_option( 'site_name' ); ?>. Beli juga musik original di iTunes untuk mendukung karyanya atau gunakan I-Ring / RBT <?php echo $result['title']; ?>. Jangan lupa untuk share lagunya ya. Thanks!</p>
	</div>
  </div>
  <div class="right-bar">
	<div class="cate">
	  <h4 class="ht">Download Lagu terbaru</h4>
	</div>
	<?php if ( $related ) { ?>
	<?php foreach ( $related as $item ) { ?>
	<div class="menu">
	  <div class="detail-thumb">
		<a href="<?php echo search_permalink( $item['title'] ); ?>">
		  <img src="/themes/mp3gratis/images/mp3.png" class="icon" id="img339405011" alt="<?php echo $item['title']; ?>" title="<?php echo $item['title']; ?>" />
		</a>
	  </div>
	  <div class="detail-info">
		<b class="ab ellipsis dli block">
		  <a href="<?php echo search_permalink( $item['title'] ); ?>" title="<?php echo $item['title']; ?>"><?php echo $item['title']; ?></a>
		</b>
	  </div>
	</div>
	<?php } unset( $item ); ?>
	<?php } ?>
  </div>
</div>