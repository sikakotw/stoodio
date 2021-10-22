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
$result = agc()->get_playlist();
$data = agc()->get_playlist_data();
$playlist = agc()->get_youtube_playlist();
$searches = get_recent_user_access( get_option( 'recent_searches_count' ) );

if( $data['title'] == "" ){
  redirect( site_url() );
}else{
$site_title = str_replace( [ '%title%', '%size%', '%site_name%', '%domain%' ], [ $data['title'], $result[0]['size'], get_option( 'site_name' ), $_SERVER['HTTP_HOST'] ], get_option( 'playlist_title' ) );
$meta_description = str_replace( [ '%title%', '%size%', '%description%', '%site_name%', '%domain%' ], [ $data['title'], $result[0]['size'], $data['description'], get_option( 'site_name' ), $_SERVER['HTTP_HOST'] ], get_option( 'playlist_description' ) );
$meta_robots = get_option( 'playlist_robots' );
}

require 'themes/' . get_option( 'theme' ) . '/header.php';
require 'themes/' . get_option( 'theme' ) . '/playlist.php';
require 'themes/' . get_option( 'theme' ) . '/footer.php';
?>