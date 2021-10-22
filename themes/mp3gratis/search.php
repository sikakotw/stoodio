<div id="main">
  <div class="main_search">
	<div class="tkbh-top">
	  <h1 class="ht">Download MP3 & Video for: <?php echo get_search_query(); ?></h1>
	  <br/>
	  <div class="bh-info">Download Lagu <strong><?php echo get_search_query(); ?></strong> dapat kamu download secara gratis di <?php echo get_option( 'site_name' ); ?>. Untuk melihat detail lagu <?php echo get_search_query(); ?> klik tombol <b>DOWNLOAD MP3</b>, kemudian untuk link download lagu mp3 <?php echo get_search_query(); ?> menuju ke halaman berikutnya. Download <strong><?php echo get_search_query(); ?></strong> lagu, mp3, Video 3gp & mp4. List download Lagu MP3 <?php echo get_search_query(); ?> gratis streaming lagu terbaru.</div>
	</div>
	<?php if ( $result ) { ?>
	<?php foreach ( $result as $item ) { ?>
	<div class="menu">
	  <div class="detail-thumb">
		<img src="/themes/mp3gratis/images/mp3.png" class="icon" id="img334042295" alt="<?php echo $item['title']; ?>" />
	  </div>
	  <div class="detail-info">
		<strong class="ab ellipsis dli"><?php echo $item['title']; ?></strong>
		<span class="sg"><b class="play-count">♬ <?php echo $item['channel']; ?></b></span>
		<a href="<?php echo download_permalink( $item['title'], '--' . $item['id'] ); ?>" rel="nofollow" rel="bookmark" class="download">DOWNLOAD MP3</a>
	  </div>
	</div>
	<?php } unset( $item ); ?>
	<?php } ?>
	<div class="main_search">
	  <div class="tkbh-top">
		<h4>Recents Search</h4>
		<div style="border: 1px solid #efefef;background: #d7ffd4;padding: 10px;color: blue; font-size: 16px; font-weight: 600;margin-top: 6px;margin-bottom: 6px;">
		<?php 
		$searches = get_recent_user_access( get_option( 'recent_searches_count' ) );
		if ( $searches ) { ?>
		<?php foreach( $searches as $item ) { ?>
		<i class="ket fa fa-headphones"></i><a href="<?php echo search_permalink( $item['q'] ); ?>" rel="dofollow" title="<?php echo $item['q']; ?>"><?php echo $item['q']; ?></a></li>, 
		<?php } ?>
		<?php } ?>
		</div>
	  </div>
	</div>
  </div>
</div>