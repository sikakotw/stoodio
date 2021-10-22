<div class="ktz-inner-content">
<div class="container">
<div class="row"> <section class="col-md-12">
<div class="row">
<div role="main" class="main col-md-9">
<section class="new-content">
<h1 class="ktz-titlepage">Search Results for: <?php echo get_search_query(); ?> MP3 & MP4</h1>
<h2 class="alert alert-block btn-box alert-info"><small>Download lagu <strong><?php echo get_search_query(); ?> MP3</strong> dapat kamu download secara gratis di <?php echo get_option( 'site_name' ); ?>.
Untuk melihat detail lagu <?php echo get_search_query(); ?> klik salah satu judul yang cocok,
kemudian untuk link download <?php echo get_search_query(); ?> ada di halaman berikutnya.</small></h2>
<?php if ( $result ) { ?>
<?php foreach ( $result as $item ) { ?>
<article class="box-post ktz-archive post type-post status-publish format-standard hentry">
<div class="entry-body">
<div class="media-body ktz-post">
<h2 class="entry-title ktz-titlemini"><a href="<?php echo download_permalink( $item['title'], '--' . $item['id'] ); ?>"> <b><?php echo $item['title']; ?></b> </a></h2>
<div><span class="entry-author vcard"><?php echo $item['channel']; ?></span>
<span class="entry-date updated"><?php echo timeline($item['date']); ?></span></div>
<div>
<a href="<?php echo download_permalink( $item['title'], '--' . $item['id'] ); ?>" rel="nofollow" class="btn btn-custom red btn-xs"> Play </a>
<a href="<?php echo download_permalink( $item['title'], '--' . $item['id'] ); ?>" rel="nofollow" class="btn btn-custom green btn-xs"> Download </a></div>
</div>
</div>
</article>
<?php } unset( $item ); ?>
<?php } ?>
</section>
</div>
<div class="sbar col-md-3 widget-area wrapwidget" role="complementary">
<aside id="execphp-2" class="widget widget_execphp">
<?php 
$searches = get_recent_user_access( get_option( 'recent_searches_count' ) );
if ( $searches ) {
?>
<div class="execphpwidget"><aside class="widget widget_categories">
<h4 class="widget-title"><span class="ktz-blocktitle">Recent Search</span></h4><ul></ul></aside></div>
<ul>
<?php foreach( $searches as $item ) { ?>
<li><a href="<?php echo search_permalink( $item['q'] ); ?>" title="<?php echo $item['q']; ?> MP3"><span class="cuk"><?php echo $item['q']; ?></span></a></li>
<?php } ?>
</ul>
<?php } ?>
</aside></div>
</div>
</section>
</div> 
</div> 
</div>