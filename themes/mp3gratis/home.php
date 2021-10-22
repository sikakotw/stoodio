<div class="gt">
  <span class="pc90">
	<u><b><?php echo get_option( 'site_name' ); ?></b></u> <i>Situs download lagu, blog download lagu mp3, website download lagu terbaru gratis dan lengkap.</i>
  </span>
</div>
<table class="table">
  <tr>
	<td class="td"><a href="<?php echo search_permalink( 'lagu-indonesia' ); ?>">Download Lagu Indonesia</a></td>
	<td class="td"><a href="<?php echo search_permalink( 'lagu-terbaru' ); ?>">Download Lagu Terbaru</a></td>
  </tr>
  <tr>
	<td class="td"><a href="<?php echo search_permalink( 'gudang-lagu-dangdut-koplo' ); ?>">Download Lagu Dangdut</a></td>
	<td class="td"><a href="<?php echo search_permalink( 'lagu-barat' ); ?>">Download Lagu Barat</a></td>
  </tr>
  <tr>
	<td class="td"><a href="<?php echo search_permalink( 'lagu-mp3' ); ?>">Download Lagu Mp3</a></td>
	<td class="td"><a href="<?php echo search_permalink( 'mp3-lagu' ); ?>">Download Lagu Gratis</a></td>
  </tr>
  <tr>
	<td colspan="2" class="td center"><a href="/">Download Lagu</a></td>
  </tr>
</table>
<div id="main">
  <div class="left-bar">
	<h2 class="ht">Download lagu Mp3</h2>
	<div class="menu">
	  <p>Download lagu mp3 online di <b>Gudang Download Lagu </b>, streaming video musik online berkualitas, dan download lagu gratis dengan kualitas tinggi. Download lagu online disini dengan nyaman tanpa ada iklan.</p>
	</div>
	<?php if ( $all_posts ) { ?>
	<?php foreach ( $all_posts as $item ) { ?>	
	<div class="menu">
	  <div class="detail-thumb">
		<a href="<?php echo post_permalink( $item['slug'] ); ?>">
		  <img src="/themes/mp3gratis/images/mp3.png" class="icon" id="img339405011" alt="<?php echo $item['artist']; ?> - <?php echo $item['title']; ?>" title="<?php echo $item['artist']; ?> - <?php echo $item['title']; ?>" />
		</a>
	  </div>
	  <div class="detail-info">
		<b class="ab ellipsis dli block">
		  <a href="<?php echo post_permalink( $item['slug'] ); ?>" title="<?php echo $item['artist']; ?> - <?php echo $item['title']; ?>"><?php echo $item['artist']; ?> - <?php echo $item['title']; ?></a>
        </b>
	  </div>
	</div>
	<?php } unset( $item ); ?>
	<?php } ?>
	
	<?php if ( $top_songs ) { ?>
	<?php foreach ( $top_songs as $item ) { ?>	
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
  <div class="right-bar">
	<h2 class="ht">Download lagu terbaru 2021</h2>
	<div class="menu">Dapatkan lagu terbaru dengan mengetikan nama artis atau judul lagu dimenu Search. Download lagu ini memiliki format file .mp3 128Kbps hasil convert video dari youtube.</div>
	<?php
	$searches = get_recent_user_access( get_option( 'recent_searches_count' ) );
	if ( $searches ) { ?>
	<?php foreach( $searches as $item ) { ?>
	<div class="menu">
	  <div class="detail-thumb">    
		<img src="/themes/mp3gratis/images/mp3.png" class="icon" id="img339405011" alt="<?php echo $item['q']; ?>" title="<?php echo $item['Q']; ?>" />
      </div>
	  <div class="detail-info">
		<b class="ab ellipsis dli block">
          <a href="<?php echo search_permalink( $item['q'] ); ?>" title="<?php echo $item['q']; ?>"><?php echo $item['q']; ?></a>
         </b>
      </div>
	</div>
	<?php } ?>
	<?php } ?>
  </div>
</div>