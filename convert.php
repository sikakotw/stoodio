<?php
require 'libraries/ua.class.php';
require 'core/functions/options.php';
require 'core/functions/cache.php';
require 'core/functions/permalinks.php';
require 'core/functions/common.php';
require 'core/classes/agc.php';

dmca_redirect();
$result = agc()->get_convert();
if ( $result ) {
  $site_title = str_replace( [ '%title%', '%size%', '%duration%', '%site_name%', '%domain%' ], [ $result['title'], $result['size'], $result['duration'], get_option( 'site_name' ), $_SERVER['HTTP_HOST'] ], get_option( 'convert_title' ) );
  $meta_description = str_replace( [ '%title%', '%size%', '%duration%', '%site_name%', '%domain%' ], [ $result['title'], $result['size'], $result['duration'], get_option( 'site_name' ), $_SERVER['HTTP_HOST'] ], get_option( 'convert_description' ) );
  $meta_robots = get_option( 'convert_robots' );
} else {
  redirect( site_url() );
}

require 'themes/' . get_option( 'theme' ) . '/header.php';
require 'themes/' . get_option( 'theme' ) . '/convert.php';
require 'themes/' . get_option( 'theme' ) . '/footer.php';
?>
