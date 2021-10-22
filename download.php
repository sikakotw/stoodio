<?php
require 'libraries/ua.class.php';
require 'core/functions/options.php';
require 'core/functions/cache.php';
require 'core/functions/permalinks.php';
require 'core/functions/common.php';
require 'core/classes/agc.php';

dmca_redirect();
delete_cache( get_cache_path() . '/downloads', get_option( 'cache_time' ) );
$result = agc()->get_download();
$related = agc()->get_related();
$searches = get_recent_user_access( get_option( 'recent_searches_count' ) );

if ( $result ) {
  $site_title = str_replace( [ '%title%', '%size%', '%duration%', '%site_name%', '%domain%' ], [ $result['title'], $result['size'], $result['duration'], get_option( 'site_name' ), $_SERVER['HTTP_HOST'] ], get_option( 'download_title' ) );
  $meta_description = str_replace( [ '%title%', '%size%', '%duration%', '%site_name%', '%domain%' ], [ $result['title'], $result['size'], $result['duration'], get_option( 'site_name' ), $_SERVER['HTTP_HOST'] ], get_option( 'download_description' ) );
  $meta_robots = get_option( 'download_robots' );
} else {
  redirect( site_url() );
}

require 'themes/' . get_option( 'theme' ) . '/header.php';
require 'themes/' . get_option( 'theme' ) . '/download.php';
require 'themes/' . get_option( 'theme' ) . '/footer.php';
?>
