<?php
require 'libraries/ua.class.php';
require 'core/functions/options.php';
require 'core/functions/cache.php';
require 'core/functions/permalinks.php';
require 'core/functions/common.php';
require 'core/classes/agc.php';

if ( $redirect = badword_redirect() ) {
  redirect( $redirect );
}
dmca_redirect();
$result = agc()->get_search();
$data = agc()->get_post();
$by_artist = agc()->get_by_artist($data['artist']);
$searches = get_recent_user_access( get_option( 'recent_searches_count' ) );

if( $data['slug'] == "" ){
  redirect( site_url() );
}else{
$site_title = str_replace( [ '%title%', '%artist%', '%size%', '%site_name%', '%domain%' ], [ $data['title'], $data['artist'], $data['size'], get_option( 'site_name' ), $_SERVER['HTTP_HOST'] ], get_option( 'post_title' ) );
$meta_description = str_replace( [ '%title%', '%artist%', '%size%', '%site_name%', '%domain%' ], [ $data['title'], $data['artist'], $data['size'], get_option( 'site_name' ), $_SERVER['HTTP_HOST'] ], get_option( 'post_description' ) );
$meta_robots = get_option( 'post_robots' );
}

require 'themes/' . get_option( 'theme' ) . '/header.php';
require 'themes/' . get_option( 'theme' ) . '/post.php';
require 'themes/' . get_option( 'theme' ) . '/footer.php';
?>