<?php
function search_permalink( $query ) {
  $query = permalink( urldecode( $query ) );
  $slug = str_replace( '%query%', $query, get_option( 'search_permalink' ) );
  return site_url() . '/' . $slug;
}

function json_permalink( $query ) {
  $query = permalink( urldecode( $query ) );
  $slug = str_replace( '%query%', $query, get_option( 'json_permalink' ) );
  return site_url() . '/' . $slug;
}

function download_permalink( $title, $id ) {
  $slug = permalink( $title );
  $id = base64_url_encode( $id );
  $full_slug = str_replace( [ '%slug%', '%id%' ], [ $slug, $id ], get_option( 'download_permalink' ) );
  return site_url() . '/' . $full_slug;
}

function playlist_permalink( $slug ) {
  $full_slug = str_replace( '%slug%', $slug, get_option( 'playlist_permalink' ) );
  return site_url() . '/' . $full_slug;
}

function page_permalink( $slug ) {
  $full_slug = str_replace( '%slug%', $slug, get_option( 'page_permalink' ) );
  return site_url() . '/' . $full_slug;
}

function post_permalink( $slug ) {
  $full_slug = str_replace( '%slug%', $slug, get_option( 'post_permalink' ) );
  return site_url() . '/' . $full_slug;
}

function convert_permalink( $id ) {
  $full_slug = str_replace( '%id%', $id, get_option( 'convert_permalink' ) );
  return site_url() . '/' . $full_slug;
}

function sitemap_searches_permalink() {
  return site_url() . '/' . get_option( 'sitemap_searches_permalink' );
}

function sitemap_keywords_permalink( $num ) {
  $slug = str_replace( '%num%', $num, get_option( 'sitemap_keywords_permalink' ) );
  return site_url() . '/' . $slug;
}

function sitemap_posts_permalink( $num ) {
  $slug = str_replace( '%num%', $num, get_option( 'sitemap_posts_permalink' ) );
  return site_url() . '/' . $slug;
}

function sitemap_permalink() {
  return site_url() . '/' . get_option( 'sitemap_permalink' );
}
