<div class="container">
<div class="row"> <section class="col-md-12">
<div class="row">
<div role="main" class="main col-md-9">
<section class="new-content">
<article id="post-111" class="ktz-page post-111 page type-page status-publish hentry">
<div class="inner-box">
<div class="entry-body clearfix">
<h2 class="widget-title"> Download Lagu MP3</h2> <p class="alert alert-block btn-box alert-info"><strong>Download Lagu MP3</strong> - Gudang lagu mp3 terbaru, download lagu mp3 terbaik gratis, dengarkan lagu mp3 secara online, top download lagu Indonesia. download lagu mp3 gratis, download lagu mp3 terbaru 2020, Stafa Band Tangga Lagu - Download lagu terbaru 2020 Indonesia planetlagu. Gratis Lagu Barat Dangdut Koplo Full Album Terlengkap wapka mobi, download lagu barat hits terbaru 2020.</p>
<?php if ( $all_posts ) { ?>
<?php $i = 0; ?>
<div class="widget-title">
<h2 class="entry-title"> Download Lagu Terupdate </h2> </div>
<ul class="ranked-popular-post-wrapper">
<?php foreach ( $all_posts as $item ) { ?>
<?php $i++; ?>
<li class="col-xs-12 col-sm-6 col-md-12">
<div class="popular-news-wrapper">
<a class="news-image" href="<?php echo post_permalink( $item['slug'] ); ?>">
<img class="lazy" width="160px" src="/themes/metrolagu/images/blank.jpg" data-src="<?php echo $item['image']; ?>" title="Download <?php echo $item['artist']; ?> - <?php echo $item['title']; ?> MP3" alt="Download <?php echo $item['artist']; ?> - <?php echo $item['title']; ?> MP3">
</a>
<h4 class="news-title">
<a title="<?php echo $item['title']; ?> MP3" href="<?php echo post_permalink( $item['slug'] ); ?>">
<?php echo $item['artist']; ?> - <?php echo $item['title']; ?>
</a>
</h4>
<div class="news-info">
<time datetime="<?php echo $item['added']; ?>"><?php echo timeline($item['added']); ?></time> <i>#<?php echo $item['genre']; ?></i>
</div>
</div>
</li>
<?php } unset( $item ); ?>
</ul>
<?php } ?>
<?php if ( $top_songs ) { ?>
<?php $i = 0; ?>
<div class="widget-title">
<h2 class="entry-title"> Download Lagu Terpopuler </h2> </div>
<ul class="ranked-popular-post-wrapper">
<?php foreach ( $top_songs as $item ) { ?>
<?php $i++; ?>
<li class="col-xs-12 col-sm-6 col-md-12">
<div class="popular-news-wrapper">
<a class="news-image" href="<?php echo search_permalink( $item['title'] ); ?>">
<img class="lazy" width="160px" src="/themes/metrolagu/images/blank.jpg" data-src="<?php echo $item['image']; ?>" title="Download <?php echo $item['title']; ?> MP3" alt="Download <?php echo $item['title']; ?> MP3">
</a>
<h4 class="news-title">
<a title="<?php echo $item['title']; ?> MP3" href="<?php echo search_permalink( $item['title'] ); ?>">
<?php echo $item['title']; ?>
</a>
</h4>
<div class="news-info">
<time datetime="<?php echo $item['date']; ?>"><?php echo timeline($item['date']); ?></time> <i>#<?php echo $item['genre']; ?></i>
</div>
</div>
</li>
<?php } unset( $item ); ?>
</ul>
<?php } ?>
</div>
</div>
</article>
</section>
</div>
<div class="sbar col-md-3 widget-area wrapwidget" role="complementary">
<?php
$searches = get_recent_user_access( get_option( 'recent_searches_count' ) );
if ( $searches ) {
?>
<aside id="execphp-2" class="widget widget_execphp">
<h4 class="widget-title"><span class="ktz-blocktitle"> Pencarian Terakhir </span></h4>
<ul>
<?php foreach( $searches as $item ) { ?>
<li><a href="<?php echo search_permalink( $item['q'] ); ?>" title="<?php echo $item['q']; ?> MP3"><span class="cuk"><?php echo $item['q']; ?></span></a></li>
<?php } ?>
</ul>
</aside>
<?php } ?>
</div>
</div>
</section>
</div> 
</div>