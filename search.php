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
set_recent_user_access( [ 'q' => get_search_query() ], 'q', get_option( 'recent_searches_limit', 25000 ) );

$result = agc()->get_search();
$playlist = agc()->get_youtube_playlist();
$searches = get_recent_user_access( get_option( 'recent_searches_count' ) );
$cache_search = get_cache_path() . '/search/' . md5( get_search_query() ) .'.json';
if ( file_exists( $cache_search ) ) {
$my_cache = json_decode( file_get_contents( $cache_search ), true );
$site_title = $my_cache['title'];
$meta_description = $my_cache['description'];
$meta_robots = $my_cache['robots'];
} else {
$site_title = unique(str_replace( [ '%query%', '%site_name%', '%domain%' ], [ get_search_query(), get_option( 'site_name' ), $_SERVER['HTTP_HOST'] ], get_option( 'search_title' ) ));
$meta_description = unique(str_replace( [ '%query%', '%site_name%', '%domain%' ], [ get_search_query(), get_option( 'site_name' ), $_SERVER['HTTP_HOST'] ], get_option( 'search_description' ) ));
$meta_robots = get_option( 'search_robots' );

$my_cache['title'] = $site_title;
$my_cache['description'] = $meta_description;
$my_cache['robots'] = $meta_robots;
if ( isset( $my_cache ) ) {
if(get_option( 'enable_cache_unique' ) == 1 ){
create_cache( $cache_search, $my_cache );
}
}
}
require 'themes/' . get_option( 'theme' ) . '/header.php';
require 'themes/' . get_option( 'theme' ) . '/search.php';
require 'themes/' . get_option( 'theme' ) . '/footer.php';
?>