<div class="row">
<div class="col-md-9 new-content">
<div class="nxt-titlepage nxt-icon">
<h1>Download Lagu MP3 2020</h1></div>
<div class="go-konten"><b><?php echo get_option( 'site_name' ); ?></b> adalah media musik digital gratis dengan jutaan link download audio mp3 dan video mp4. Dapatkan semua konten download paling lengkap dan terbaru.</div>
<div class="widget-title text-center">
<h3>Menu Cepat</h3></div>
<ul class="menu">
<li><a href="<?php echo playlist_permalink( 'lagu-dangdut' ); ?>" class="btn" title="Download Lagu Dangdut">Dangdut</a></li>
<li><a href="<?php echo playlist_permalink( 'lagu-hits' ); ?>" class="btn" title="Download Lagu Populer">Hits</a></li>
</ul>
<div class="widget-title text-center">
<h3>Baru Ditambahkan</h3>
</div>
<?php if ( $all_posts ) { ?>
<?php foreach ( $all_posts as $item ) { ?>
<div class="box-post nxt-archive media">
<a href="<?php echo post_permalink( $item['slug'] ); ?>" class="pull-left"><img src="<?php echo $item['image']; ?>?resize=96,96" class="media-object" alt="<?php echo $item['artist']; ?> - <?php echo $item['title']; ?>" width="96" height="96"></a>
<div class="media-body">
<h2 class="nxt-titlemini"><a href="<?php echo post_permalink( $item['slug'] ); ?>"><?php echo $item['artist']; ?> - <?php echo $item['title']; ?></a></h2>
<span class="go-info"><?php echo $item['size']; ?></span>
<span class="go-info"><?php echo $item['genre']; ?></span>
<span class="go-info"><?php echo timeline($item['added']); ?></span>
</div>
</div>
<?php } unset( $item ); ?>
<?php } ?>
</div>
<div class="col-md-3 widget-area">
<?php if ( agc()->widget_playlist('PLkbaG37V-vG8Fib_qvgOKf3qzqA0SUk59') ) { ?>
<aside class="widget toplist">
<h4 class="widget-title">Lagu Terbaru</h4>
<ul>
<?php foreach ( agc()->widget_playlist('PLkbaG37V-vG8Fib_qvgOKf3qzqA0SUk59') as $item ) { ?>
<li>
<a href="<?php echo search_permalink( $item['title'] ); ?>"><img class="nxt-img" src="<?php echo $item['image']; ?>?resize=320,100" alt="<?php echo $item['title']; ?>" /> <span class="nxt-title"><?php echo $item['title']; ?></span> <span class="duration"><?php echo timeline($item['date']); ?></span></a>
</li>
<?php } unset( $item ); ?>
</ul>
</aside>
<?php } ?>
<?php if ( $playlist ) { ?>
<aside class="widget toplist">
<h4 class="widget-title">Lagu Terpopuler</h4>
<ul>
<?php foreach ( $playlist as $item ) { ?>
<li>
<a href="<?php echo search_permalink( $item['title'] ); ?>"><img class="nxt-img" src="<?php echo $item['image']; ?>?resize=320,100" alt="<?php echo $item['title']; ?>" /> <span class="nxt-title"><?php echo $item['title']; ?></span> <span class="duration"><?php echo timeline($item['date']); ?></span></a>
</li>
<?php } unset( $item ); ?>
</ul>
</aside>
<?php } ?>
<?php if ( $searches ) { ?>
<aside class="widget toplist">
<h4 class="widget-title">Download Terbaru</h4>
<ul>
<?php foreach( $searches as $item ) { ?>
<li><a href="<?php echo search_permalink( $item['q'] ); ?>" title="<?php echo $item['q']; ?>"><?php echo $item['q']; ?></a></li>
<?php } ?>
</ul>
</aside>
<?php } ?>
</div>
</div>