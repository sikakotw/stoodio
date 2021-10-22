<?php
require 'core/functions/options.php';
require 'core/functions/permalinks.php';
require 'core/functions/common.php';

if ( $route['name'] == 'sitemap-searches' ) {
  header( "Content-Type: application/xml" );

  echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
  echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

  echo '
  	<url>
  		<loc>' . site_url() . '</loc>
  		<changefreq>daily</changefreq>
  		<priority>0.6</priority>
  	</url>' . "\n";

  $recent_searches_file = store_dir() . '/searches.json';
  if ( file_exists( $recent_searches_file ) ) {
    $searches = json_decode( file_get_contents( $recent_searches_file ), true );
    foreach( $searches as $item ) {
  		echo '
  			<url>
  				<loc>' . search_permalink( $item['title'] ) . '</loc>
  				<changefreq>daily</changefreq>
  				<priority>0.6</priority>
  			</url>' . "\n";
  	}
  }

  echo '</urlset>';
}

elseif ( $route['name'] == 'sitemap-keywords' ) {
  $id = explode( '-', $route['vars'][0] );
  if ( isset( $id[0] ) && $id[0] > 0 && isset( $id[1] ) && $id[1] > 0 ) {
    $limit = get_option( 'sitemap_limit' );
    $file_number = $id[0];
    $page_number = $id[1];
    $start = ( $page_number - 1 ) * $limit;

    if ( get_option( 'use_default_keyword_files' ) && file_exists( BASE . '/store/default/keywords/' . $file_number . '.txt' ) ) {
      $keyword_file = file( BASE . '/store/default/keywords/' . $file_number . '.txt' );
    } elseif ( file_exists( store_dir() . '/keywords/' . $file_number . '.txt' ) ) {
      $keyword_file = file( store_dir() . '/keywords/' . $file_number . '.txt' );
    }

    if ( isset( $keyword_file ) ) {
      $keywords = array_slice( $keyword_file, $start, $limit );

      if ( $keywords ) {
        header( "Content-Type: application/xml" );

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        $keywords = array_map( 'trim', $keywords );
        if ( $keywords ) {
        	foreach( $keywords as $item ) {
        		echo '
        			<url>
        				<loc>' . search_permalink( $item ) . '</loc>
        				<changefreq>daily</changefreq>
        				<priority>0.6</priority>
        			</url>
        		' . "\n";
        	}
        }

        echo '</urlset>';
      }
    }
  }
}

elseif ( $route['name'] == 'sitemap-posts' ) {
  $id = $route['vars'][0];
    $limit = get_option( 'sitemap_limit' );
    $page_number = $id[0];
    $start = ( $page_number - 1 ) * $limit;

    if ( get_option( 'use_default_keyword_files' ) && file_exists( BASE . '/store/default/inject' ) ) {
      $keyword_file = BASE . '/store/default/inject';
    } elseif ( file_exists( store_dir() . '/inject' ) ) {
      $keyword_file = store_dir() . '/inject';
    }
	chdir($keyword_file);
	array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_ASC, $files);
    if ( isset( $files ) ) {
      $keywords = array_slice( $files, $start, $limit );

      if ( $keywords ) {
        header( "Content-Type: application/xml" );

        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        if ( $keywords ) {
        	foreach( $keywords as $filename ) {
			$item = json_decode( file_get_contents( $filename ), true );
        		echo '
        			<url>
        				<loc>' . post_permalink( $item['slug'] ) . '</loc>
						<lastmod>'.date('c', strtotime($item['added'])).'</lastmod>
        				<changefreq>daily</changefreq>
        				<priority>0.6</priority>
        			</url>
        		' . "\n";
        	}
        }

        echo '</urlset>';
      }
    }
}

else {
  if ( get_option( 'use_default_keyword_files' ) ) {
    $keywords = glob( BASE . '/store/default/keywords/*.txt' );
  } else {
    $keywords = glob( store_dir() . '/keywords/*.txt' );
  }

  if ( $keywords ) {
    foreach( $keywords as $key => $keyword ) {
      $file = file( $keyword );
      $keyword_count = count( $file );
      if ( $keyword_count > 0 ) {
        for( $i = 1; $i <= ( ceil( $keyword_count / get_option( 'sitemap_limit' ) ) ); $i++ ) {
          $sitemap_by_keywords[] = '<sitemap><loc>' . sitemap_keywords_permalink( ( ( $key + 1 ) . '-' . $i ) ) . '</loc><lastmod>'.date('c', time()).'</lastmod></sitemap>' . "\n";
        }
      }
    }
  }
  
  if ( get_option( 'use_default_post_files' ) ) {
    $files = glob( BASE . '/store/default/inject/*');
  } else {
    $files = glob( store_dir() . '/inject/*' );
  }
  if ( $files ) {
      $keyword_count = count( $files );
      if ( $keyword_count > 0 ) {
        for( $i = 1; $i <= ( ceil( $keyword_count / get_option( 'sitemap_limit' ) ) ); $i++ ) {
          $sitemap_by_posts[] = '<sitemap><loc>' . sitemap_posts_permalink( $i ) . '</loc><lastmod>'.date('c', time()).'</lastmod></sitemap>' . "\n";
        }
      }
  }
  
  header( "Content-Type: application/xml" );

  echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
  echo '<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

  if ( file_exists( store_dir() . '/searches.json' ) ) {
  	echo '
      <sitemap>
  		  <loc>' . sitemap_searches_permalink() . '</loc>
		  <lastmod>'.date('c', time()).'</lastmod>
  	  </sitemap>' . "\n";
  }

  if ( isset( $sitemap_by_keywords ) ) {
    foreach ( $sitemap_by_keywords as $sitemap ) {
      echo $sitemap . "\n";
    }
  }

  if ( isset( $sitemap_by_posts ) ) {
    foreach ( $sitemap_by_posts as $postsku ) {
      echo $postsku . "\n";
    }
  }

  echo '</sitemapindex>';
}
