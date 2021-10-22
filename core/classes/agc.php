<?php
class AGC {

  public function get_inject($inject, $limit) {
	  
    $url = 'https://itunes.apple.com/search?term='. urlencode($inject) .'&media=music&limit=' . $limit . '';
    $curl = $this->curl( $url, 'https://itunes.apple.com' );
	  
    if ( $curl['info']['http_code'] == 200 ) {
      $array = json_decode( $curl['data'], true );
      if ( isset( $array['results'] ) ) {
        foreach ( $array['results'] as $item ) {
		  if( $item['kind'] == 'music-video' ){
          } else {		  
		  if ( file_exists( '../store/' . $_SERVER['HTTP_HOST'] . '/inject' ) ) {
			$cache_file = '../store/' . $_SERVER['HTTP_HOST'] . '/inject/' . $this->myslug($item['artistName'].'-'.$item['trackName']) .'.json';
		  }else{
			$cache_file = '../store/default/inject/' . $this->myslug($item['artistName'].'-'.$item['trackName']) .'.json';
		  }
		  
		  $data['slug'] = $this->myslug($item['artistName'].'-'.$item['trackName']);
		  $data['title'] = $item['trackName'];
          $data['artist'] = $item['artistName'];
          $data['genre'] = $item['primaryGenreName'];
		  $data['album'] = $item['collectionName'];
		  $data['added'] = str_replace('+00:00', 'Z', gmdate('c'));
		  if( $item['releaseDate'] == '' ){
          } else {
		  $data['date'] = isset($item['releaseDate']) ? $item['releaseDate'] : '-';
		  }
		  $data['duration'] = date('H:i', mktime($item['trackTimeMillis'] / 60000));
		  $exp_duration = explode( ':', $data['duration'] );
                if ( count( $exp_duration ) == 2 ) {
                  $parsed = date_parse( '00:' . $data['duration'] );
                  $seconds = ( $parsed['minute'] * 60 ) + $parsed['second'];
                } else {
                  $parsed = date_parse( $data['duration'] );
                  $seconds = ( $parsed['hour'] * 60 * 60 ) + ( $parsed['minute'] * 60 ) + $parsed['second'];
                }
          $data['size'] = $this->get_format_bytes( ( $seconds * ( 128 / 8 ) * 1000 ) );
		  $item['image'] = str_replace( '200x200bb', '100x100bb', $item['artworkUrl100'] );
		  $data['image'] = str_replace( 'https://', 'https://i0.wp.com/', $item['image'] );
          $items[] = $data;
		  if ( isset( $data ) ) {
			set_cache( $cache_file, $data );
		  }
		  }
        }
       }
      }

    return ( isset( $items ) ) ? $items : [];
  }
  
  public function get_by_artist($artist) {
    $folder = get_post_path();
	$first_count = 1;
	$count = 5;
	chdir($folder);
	array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);
	foreach($files as $filename) {
	  $item = json_decode( file_get_contents( $filename ), true );
	  if( $item['artist'] == $artist ){
		if( $first_count <= $count ){
		  $first_count++;
		  $data['slug'] = $item['slug'];
	  	  $data['title'] = $item['title'];
		  $data['artist'] = $item['artist'];
		  $data['genre'] = $item['genre'];
		  $data['album'] = $item['album'];
		  $data['added'] = $item['added'];
		  $data['date'] = $item['date'];
		  $data['duration'] = $item['duration'];
		  $data['size'] = $item['size'];
		  $data['image'] = $item['image'];
		  $items[] = $data;
		}
	  }
    }
	return ( isset( $items ) ) ? $items : [];
  }
  
  public function get_by_genre($genre) {
    $folder = get_post_path();
	$first_count = 1;
	$count = 5;
	chdir($folder);
	array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);	
	foreach($files as $filename) {
	  $item = json_decode( file_get_contents( $filename ), true );
	  if( $item['genre'] == $genre ){
		if( $first_count <= $count ){
		  $first_count++;
		  $data['slug'] = $item['slug'];
	  	  $data['title'] = $item['title'];
		  $data['artist'] = $item['artist'];
		  $data['genre'] = $item['genre'];
		  $data['album'] = $item['album'];
		  $data['added'] = $item['added'];
		  $data['date'] = $item['date'];
		  $data['duration'] = $item['duration'];
		  $data['size'] = $item['size'];
		  $data['image'] = $item['image'];
		  $items[] = $data;
		}
	  }
    }
	return ( isset( $items ) ) ? $items : [];
  }
  
  public function get_by_album($artist, $album) {
    $folder = get_post_path();
	$first_count = 1;
	$count = 5;
	chdir($folder);
	array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);	
	foreach($files as $filename) {
	  $item = json_decode( file_get_contents( $filename ), true );
	  if( $item['artist'] == $artist ){
		if( $item['album'] == $album ){
		  if( $first_count <= $count ){
			$first_count++;
			$data['slug'] = $item['slug'];
			$data['title'] = $item['title'];
			$data['artist'] = $item['artist'];
			$data['genre'] = $item['genre'];
			$data['album'] = $item['album'];
			$data['added'] = $item['added'];
			$data['date'] = $item['date'];
			$data['duration'] = $item['duration'];
			$data['size'] = $item['size'];
			$data['image'] = $item['image'];
			$items[] = $data;
		  }
		}
	  }
    }
	return ( isset( $items ) ) ? $items : [];
  }
  
  public function get_all_posts() {
    $cache_file = get_cache_path() . '/home/home-post.json';
    if ( file_exists( $cache_file ) ) {
      $json = file_get_contents( $cache_file, true );
      $items = json_decode( $json, true );
    } else {
    $folder = get_post_path();
	$offset = 1; //get this as input from the user, probably as a GET from a link
	$quantity = get_option( 'posts_count', 10 ); //number of items to display
	chdir($folder);
	array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);
	$selectedFiles = array_slice($files, $offset-1, $quantity);	
	foreach($selectedFiles as $filename) {
	  $item = json_decode( file_get_contents( $filename ), true );
	  
	  $data['slug'] = $item['slug'];
	  $data['title'] = $item['title'];
      $data['artist'] = $item['artist'];
      $data['genre'] = $item['genre'];
	  $data['album'] = $item['album'];
	  $data['added'] = $item['added'];
	  $data['date'] = $item['date'];
	  $data['duration'] = $item['duration'];
      $data['size'] = $item['size'];
	  $data['image'] = $item['image'];
      $items[] = $data;
    }
	  create_cache( $cache_file, $items );
    }
	return ( isset( $items ) ) ? $items : [];
  }
  
  public function get_itunes_top_songs() {
    $cache_file = get_cache_path() . '/home/top-songs.json';
    if ( file_exists( $cache_file ) ) {
      $json = file_get_contents( $cache_file, true );
      $items = json_decode( $json, true );
    } else {
      $count = get_option( 'itunes_count', 10 );
      $country = get_option( 'itunes_country' );
      $url = 'https://itunes.apple.com/' . $country . '/rss/topsongs/limit=' . $count . '/xml';
      $curl = $this->curl( $url, 'https://www.apple.com' );

    if ( $curl['info']['http_code'] == 200 ) {
      $xml = str_replace( 'im:', '', $curl['data'] );
      $xml = json_decode( json_encode( simplexml_load_string( $xml ) ), true );

      if ( isset( $xml['entry'] ) ) {
        foreach ( $xml['entry'] as $item ) {
		  $data['title'] = $item['artist'].' - '.$item['name'];
          $data['artist'] = $item['artist'];
		  if( $item['releaseDate'] == '' ){
          } else {
		  $data['date'] = isset($item['releaseDate']) ? $item['releaseDate'] : '-';
		  }
		  $item['image2'] = str_replace( '55x55bb', '60x60bb', $item['image'][0] );
		  $data['image'] = str_replace( 'https://', 'https://i0.wp.com/', $item['image2'] );
          $items[] = $data;
        }
		create_cache( $cache_file, $items );
       }
      }
    }

    return ( isset( $items ) ) ? $items : [];
  }

  public function get_itunes_new_releases() {
    $cache_file = get_cache_path() . '/home/new-releases.json';
    if ( file_exists( $cache_file ) ) {
      $json = file_get_contents( $cache_file, true );
      $items = json_decode( $json, true );
    } else {
      $count = get_option( 'itunes_count', 10 );
	  $country = get_option( 'itunes_country' );
      $url = 'https://rss.itunes.apple.com/api/v1/' . $country . '/itunes-music/recent-releases/all/' . $count . '/non-explicit.json';
      $curl = $this->curl( $url, 'https://www.apple.com' );

    if ( $curl['info']['http_code'] == 200 ) {
      $array = json_decode( $curl['data'], true );
      if ( isset( $array['feed']['results'] ) ) {
        foreach ( $array['feed']['results'] as $item ) {
		  $data['title'] = $item['artistName'].' - '.$item['name'];
          $data['artist'] = $item['artistName'];
		  if( $item['releaseDate'] == '' ){
          } else {
		  $data['date'] = isset($item['releaseDate']) ? $item['releaseDate'] : '-';
		  }
          $item['image'] = str_replace( '200x200bb', '100x100bb', $item['artworkUrl100'] );
		  $data['image'] = str_replace( 'https://', 'https://i0.wp.com/', $item['image'] );
          $items[] = $data;
        }
		create_cache( $cache_file, $items );
       }
      }
    }

    return ( isset( $items ) ) ? $items : [];
  }

  public function get_itunes_top_songs_by_genre($genre, $limit = '100'){
    $genre_id = $this->itunes_genre_id($genre);
    $genre = trim(preg_replace(array("`'`", "`[^a-z0-9]+`"),  array("", "-"), strtolower($genre)), "-");
    $country = get_option( 'itunes_country' );
    $url = 'https://itunes.apple.com/'.$country.'/rss/topsongs/limit='.$limit.'/genre='.$genre_id.'/explicit=true/json';

    $cache_file = get_cache_path() . '/itunes/top-'.$genre.'-'.$country  .'.json';

    if ( file_exists( $cache_file ) ) {
      $json = file_get_contents( $cache_file, true );
      $items = json_decode( $json, true );
    } else {
      $curl = $this->curl( $url, 'https://www.apple.com' );
      if ( $curl['info']['http_code'] == 200 ) {
        $xml = str_replace( 'im:', '', $curl['data'] );
        $xml = json_decode( $xml, true );
        if ( isset( $xml['feed']['entry'] ) ) {
          foreach ( $xml['feed']['entry'] as $item ) {
            $artistid = $item['artist']['attributes']['href'];
            $artistid = explode('/', $artistid);
            $artistid = explode('?', $artistid[6]);
            $albumid = $item['collection']['link']['attributes']['href'];
            $albumid = explode('/', $albumid);
            $albumid = explode('?', $albumid[6]);
            $data['artistid'] = $artistid[0];
            $data['albumid'] = $albumid[0];
            $data['title'] = $item['title']['label'];
            $data['artist'] = $item['artist']['label'];
            $data['album'] = $item['collection']['name']['label'];
            $item['image'] = str_replace( '55x55bb-85', '100x100bb-100', $item['image'][0]['label'] );
			$data['image'] = str_replace( 'https://', 'https://i0.wp.com/', $item['image'] );
            $items[] = $data;
          }
          create_cache( $cache_file, $items );
        }
      }
    }
    return ( isset( $items ) ) ? $items : [];
  }

  public function get_youtube_top_videos() {
    $cache_file = get_cache_path() . '/home/top-videos.json';
    if ( file_exists( $cache_file ) ) {
      $json = file_get_contents( $cache_file, true );
      $items = json_decode( $json, true );
    } else {
      $api_key = $this->get_youtube_api();
      $country = get_option( 'youtube_top_videos_country', 10 );
      $count = get_option( 'youtube_top_videos_count' );
      $url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&chart=mostPopular&regionCode=' . $country . '&maxResults=' . $count . '&key=' . $api_key;
      $curl = $this->curl( $url, 'https://www.youtube.com' );

      if ( $curl['info']['http_code'] == 200 ) {
        $array = json_decode( $curl['data'], true );
        if ( isset( $array['items'] ) ) {
          foreach ( $array['items'] as $item ) {
            $data['id'] = $item['id'];
			$item['title2'] = strip_tags($item['snippet']['title']);
			$item['title2'] = str_replace( ' (Official Music Video)', '', $item['title2'] );
			$item['title2'] = str_replace( '| Official Music Video', '', $item['title2'] );
			$item['title2'] = str_replace( ' Official', '', $item['title2'] );
			$item['title2'] = str_replace( '[', '', $item['title2'] );
			$item['title2'] = str_replace( ']', '', $item['title2'] );
			$item['title2'] = str_replace( '(', '', $item['title2'] );
			$item['title2'] = str_replace( ')', '', $item['title2'] );
			$item['title2'] = str_replace( ' Official', '', $item['title2'] );
			$item['title2'] = str_replace( ' official', '', $item['title2'] );
			$item['title2'] = str_replace( ' Video', '', $item['title2'] );
			$item['title2'] = str_replace( ' video', '', $item['title2'] );
			$item['title2'] = str_replace( ' Audio', '', $item['title2'] );
			$item['title2'] = str_replace( ' audio', '', $item['title2'] );
			$item['title2'] = str_replace( ' Music', '', $item['title2'] );
			$item['title2'] = str_replace( ' music', '', $item['title2'] );
			$item['title2'] = str_replace( ' Lyric', '', $item['title2'] );
			$item['title2'] = str_replace( ' lyric', '', $item['title2'] );
			$item['title2'] = str_replace( ' OFFICIAL', '', $item['title2'] );
			$item['title2'] = str_replace( ' MUSIC', '', $item['title2'] );
			$item['title2'] = str_replace( ' VIDEO', '', $item['title2'] );
			$item['title2'] = str_replace( ' AUDIO', '', $item['title2'] );
			$item['title2'] = str_replace( ' |', '', $item['title2'] );
			$data['title'] = str_replace( '||', '', $item['title2'] );
            $data['channel'] = $item['snippet']['channelTitle'];
            $data['image'] = 'https://i2.wp.com/ytimg.googleusercontent.com/vi/'.$item['id'].'/mqdefault.jpg';
            $items[] = $data;
          }

          create_cache( $cache_file, $items );
        }
      }
    }

    return ( isset( $items ) ) ? $items : [];
  }
 
  public function widget_playlist ($id) {
    $cache_file = get_cache_path() . '/home/'.$id.'.json';
    if ( file_exists( $cache_file ) ) {
      $json = file_get_contents( $cache_file, true );
      $items = json_decode( $json, true );
    } else {
      $api_key = $this->get_youtube_api();
      $count = get_option( 'youtube_playlist_count' );
	
      $url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=' . $id . '&maxResults=' . $count . '&key=' . $api_key;
      $curl = $this->curl( $url, 'https://www.youtube.com' );

	  if ( $curl['info']['http_code'] == 200 ) {
		$array = json_decode( $curl['data'], true );
		if ( isset( $array['items'] ) ) {
          foreach ( $array['items'] as $item ) {
			$data['id'] = $item['snippet']['resourceId']['videoId'];
			$item['title2'] = strip_tags($item['snippet']['title']);
			$item['title2'] = str_replace( ' (Official Music Video)', '', $item['title2'] );
			$item['title2'] = str_replace( '| Official Music Video', '', $item['title2'] );
			$item['title2'] = str_replace( ' Official', '', $item['title2'] );
			$item['title2'] = str_replace( '[', '', $item['title2'] );
			$item['title2'] = str_replace( ']', '', $item['title2'] );
			$item['title2'] = str_replace( '(', '', $item['title2'] );
			$item['title2'] = str_replace( ')', '', $item['title2'] );
			$item['title2'] = str_replace( ' Official', '', $item['title2'] );
			$item['title2'] = str_replace( ' official', '', $item['title2'] );
			$item['title2'] = str_replace( ' Video', '', $item['title2'] );
			$item['title2'] = str_replace( ' video', '', $item['title2'] );
			$item['title2'] = str_replace( ' Audio', '', $item['title2'] );
			$item['title2'] = str_replace( ' audio', '', $item['title2'] );
			$item['title2'] = str_replace( ' Music', '', $item['title2'] );
			$item['title2'] = str_replace( ' music', '', $item['title2'] );
			$item['title2'] = str_replace( ' Lyric', '', $item['title2'] );
			$item['title2'] = str_replace( ' lyric', '', $item['title2'] );
			$item['title2'] = str_replace( ' OFFICIAL', '', $item['title2'] );
			$item['title2'] = str_replace( ' MUSIC', '', $item['title2'] );
			$item['title2'] = str_replace( ' VIDEO', '', $item['title2'] );
			$item['title2'] = str_replace( ' AUDIO', '', $item['title2'] );
			$item['title2'] = str_replace( ' |', '', $item['title2'] );
			$data['title'] = str_replace( '||', '', $item['title2'] );
			$data['channel'] = $item['snippet']['channelTitle'];
			$data['date'] = $this->convert_youtube_date($item['snippet']['publishedAt']);
			$data['image'] = 'https://i2.wp.com/ytimg.googleusercontent.com/vi/'.$item['snippet']['resourceId']['videoId'].'/mqdefault.jpg';
			$items[] = $data;
          }

          create_cache( $cache_file, $items );
        }
      }
	}
	
    return ( isset( $items ) ) ? $items : [];
  }
 
  public function get_youtube_playlist () {
    $cache_file = get_cache_path() . '/home/playlist.json';
    if ( file_exists( $cache_file ) ) {
      $json = file_get_contents( $cache_file, true );
      $items = json_decode( $json, true );
    } else {
      $api_key = $this->get_youtube_api();
      $count = get_option( 'youtube_playlist_count' );
      $playlist_id = get_option( 'youtube_playlist_id' );
	
      $url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=' . $playlist_id . '&maxResults=' . $count . '&key=' . $api_key;
      $curl = $this->curl( $url, 'https://www.youtube.com' );

	  if ( $curl['info']['http_code'] == 200 ) {
		$array = json_decode( $curl['data'], true );
		if ( isset( $array['items'] ) ) {
          foreach ( $array['items'] as $item ) {
			$data['id'] = $item['snippet']['resourceId']['videoId'];
			$item['title2'] = strip_tags($item['snippet']['title']);
			$item['title2'] = str_replace( ' (Official Music Video)', '', $item['title2'] );
			$item['title2'] = str_replace( '| Official Music Video', '', $item['title2'] );
			$item['title2'] = str_replace( ' Official', '', $item['title2'] );
			$item['title2'] = str_replace( '[', '', $item['title2'] );
			$item['title2'] = str_replace( ']', '', $item['title2'] );
			$item['title2'] = str_replace( '(', '', $item['title2'] );
			$item['title2'] = str_replace( ')', '', $item['title2'] );
			$item['title2'] = str_replace( ' Official', '', $item['title2'] );
			$item['title2'] = str_replace( ' official', '', $item['title2'] );
			$item['title2'] = str_replace( ' Video', '', $item['title2'] );
			$item['title2'] = str_replace( ' video', '', $item['title2'] );
			$item['title2'] = str_replace( ' Audio', '', $item['title2'] );
			$item['title2'] = str_replace( ' audio', '', $item['title2'] );
			$item['title2'] = str_replace( ' Music', '', $item['title2'] );
			$item['title2'] = str_replace( ' music', '', $item['title2'] );
			$item['title2'] = str_replace( ' Lyric', '', $item['title2'] );
			$item['title2'] = str_replace( ' lyric', '', $item['title2'] );
			$item['title2'] = str_replace( ' OFFICIAL', '', $item['title2'] );
			$item['title2'] = str_replace( ' MUSIC', '', $item['title2'] );
			$item['title2'] = str_replace( ' VIDEO', '', $item['title2'] );
			$item['title2'] = str_replace( ' AUDIO', '', $item['title2'] );
			$item['title2'] = str_replace( ' |', '', $item['title2'] );
			$data['title'] = str_replace( '||', '', $item['title2'] );
			$data['channel'] = $item['snippet']['channelTitle'];
			$data['date'] = $this->convert_youtube_date($item['snippet']['publishedAt']);
			$data['image'] = 'https://i2.wp.com/ytimg.googleusercontent.com/vi/'.$item['snippet']['resourceId']['videoId'].'/mqdefault.jpg';
			$items[] = $data;
          }

          create_cache( $cache_file, $items );
        }
      }
	}
	
    return ( isset( $items ) ) ? $items : [];
  }
 
  public function get_playlist () {
    global $route;
	$url = $route['vars'][0];
	$cache_file = get_playlist_path() . '/' . md5( $url ) .'.json';
	if ( file_exists( $cache_file ) ) {
	  $cache_data = json_decode( file_get_contents( $cache_file ), true );
	}
	  
    $api_key = $this->get_youtube_api();
    $count = get_option( 'playlist_count' );
    $playlist_id = $cache_data['id'];
	
    $url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=' . $playlist_id . '&maxResults=' . $count . '&key=' . $api_key;
    $curl = $this->curl( $url, 'https://www.youtube.com' );

      if ( $curl['info']['http_code'] == 200 ) {
        $youtube__array = json_decode( $curl['data'], true );
		
        if ( isset( $youtube__array['items'] ) ) {
          foreach ( $youtube__array['items'] as $item )
            $video_id[] = $item['snippet']['resourceId']['videoId'];
			
		  unset( $item );
			
			$detail__url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails&id=' . implode(',', $video_id ) . '&key=' . $api_key;
			$detail__curl = $this->curl( $detail__url, 'https://www.youtube.com' );
			
			if ( $detail__curl['info']['http_code'] == 200 ) {
			  $detail__array = json_decode( $detail__curl['data'], true );
			  
			  foreach ( $detail__array['items'] as $item ) {
				$snippet = $item['snippet'];
				$content_details = $item['contentDetails'];
				
				$data['id'] = $item['id'];
				$item['title2'] = strip_tags($snippet['title']);
				$item['title2'] = str_replace( ' (Official Music Video)', '', $item['title2'] );
				$item['title2'] = str_replace( '| Official Music Video', '', $item['title2'] );
				$item['title2'] = str_replace( ' Official', '', $item['title2'] );
				$item['title2'] = str_replace( '[', '', $item['title2'] );
				$item['title2'] = str_replace( ']', '', $item['title2'] );
				$item['title2'] = str_replace( '(', '', $item['title2'] );
				$item['title2'] = str_replace( ')', '', $item['title2'] );
				$item['title2'] = str_replace( ' Official', '', $item['title2'] );
				$item['title2'] = str_replace( ' official', '', $item['title2'] );
				$item['title2'] = str_replace( ' Video', '', $item['title2'] );
				$item['title2'] = str_replace( ' video', '', $item['title2'] );
				$item['title2'] = str_replace( ' Audio', '', $item['title2'] );
				$item['title2'] = str_replace( ' audio', '', $item['title2'] );
				$item['title2'] = str_replace( ' Music', '', $item['title2'] );
				$item['title2'] = str_replace( ' music', '', $item['title2'] );
				$item['title2'] = str_replace( ' OFFICIAL', '', $item['title2'] );
				$item['title2'] = str_replace( ' MUSIC', '', $item['title2'] );
				$item['title2'] = str_replace( ' VIDEO', '', $item['title2'] );
				$item['title2'] = str_replace( ' AUDIO', '', $item['title2'] );
				$data['title'] = str_replace( '||', '', $item['title2'] );
				$data['date'] = $this->convert_youtube_date($snippet['publishedAt']);
				$data['channel'] = $snippet['channelTitle'];
				$data['image'] = 'https://i2.wp.com/ytimg.googleusercontent.com/vi/'.$item['id'].'/mqdefault.jpg';
                $data['duration'] = $this->convert_youtube_time($content_details['duration']);
				$exp_duration = explode( ':', $data['duration'] );
                if ( count( $exp_duration ) == 2 ) {
                  $parsed = date_parse( '00:' . $data['duration'] );
                  $seconds = ( $parsed['minute'] * 60 ) + $parsed['second'];
                } else {
                  $parsed = date_parse( $data['duration'] );
                  $seconds = ( $parsed['hour'] * 60 * 60 ) + ( $parsed['minute'] * 60 ) + $parsed['second'];
                }
                $data['size'] = $this->get_format_bytes( ( $seconds * ( 128 / 8 ) * 1000 ) );
			  
				$items[] = $data;
			  }
			}
        }
      }
	
    return ( isset( $items ) ) ? $items : [];
  }

  public function get_playlist_data() {
    global $route;
    $url = $route['vars'][0];
	$cache_file = get_playlist_path() . '/' . md5( $url ) .'.json';
	if ( file_exists( $cache_file ) ) {
	  $cache_data = json_decode( file_get_contents( $cache_file ), true );
	}
	$data['id'] = $cache_data['id'];
	$data['title'] = $cache_data['title'];
	$data['url'] = $cache_data['url'];
	$data['description'] = $cache_data['description'];
	return ( isset( $data ) ) ? $data : [];
  }

  public function get_search_backup() {
    $q = urlencode( get_search_query() );
    $items = [];

    $youtube__api_key = $this->get_youtube_api();
    $youtube__count = get_option( 'youtube_search_count', 5 );

	if ( $youtube__api_key ) {
      $youtube__url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . $q . '&type=video&regionCode=ID&maxResults=' . $youtube__count . '&key=' . $youtube__api_key;
      $youtube__curl = $this->curl( $youtube__url, 'https://www.youtube.com' );

      if ( $youtube__curl['info']['http_code'] == 200 ) {
        $youtube__array = json_decode( $youtube__curl['data'], true );
		
        if ( isset( $youtube__array['items'] ) ) {
          foreach ( $youtube__array['items'] as $item )
            $video_id[] = $item['id']['videoId'];
			
		  unset( $item );
			
			$detail__url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails&id=' . implode(',', $video_id ) . '&key=' . $youtube__api_key;
			$detail__curl = $this->curl( $detail__url, 'https://www.youtube.com' );
			
			if ( $detail__curl['info']['http_code'] == 200 ) {
			  $detail__array = json_decode( $detail__curl['data'], true );
			  
			  foreach ( $detail__array['items'] as $item ) {
				$snippet = $item['snippet'];
				$content_details = $item['contentDetails'];
				
				$data['id'] = $item['id'];
				$data['title'] = preg_replace('/["?]/', '', $snippet['title']);
				$data['date'] = $this->convert_youtube_date($snippet['publishedAt']);
				$data['channel'] = $snippet['channelTitle'];
				$data['image'] = 'https://i2.wp.com/ytimg.googleusercontent.com/vi/'.$item['id'].'/mqdefault.jpg';
                $data['duration'] = $this->convert_youtube_time($content_details['duration']);
				$exp_duration = explode( ':', $data['duration'] );
                if ( count( $exp_duration ) == 2 ) {
                  $parsed = date_parse( '00:' . $data['duration'] );
                  $seconds = ( $parsed['minute'] * 60 ) + $parsed['second'];
                } else {
                  $parsed = date_parse( $data['duration'] );
                  $seconds = ( $parsed['hour'] * 60 * 60 ) + ( $parsed['minute'] * 60 ) + $parsed['second'];
                }
                $data['size'] = $this->get_format_bytes( ( $seconds * ( 128 / 8 ) * 1000 ) );
				if ( isset($statistics['viewCount']))
				$data['views'] = $statistics['viewCount'];
		  
				$items[] = $data;
			  }
			}
        }
      }
    }
	
    return ( isset( $items ) ) ? $items : [];
  }

  public function get_search() {
    $q = urlencode( get_search_query() );
    $items = [];

    $youtube__api_key = $this->get_youtube_api();
    $youtube__count = get_option( 'youtube_search_count', 5 );

    if ( $youtube__api_key ) {
      $youtube__url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&regionCode=ID&maxResults=' . $youtube__count . '&q=' . $q . '&key=' . $youtube__api_key;
      $youtube__curl = $this->curl( $youtube__url, 'https://www.youtube.com' );

      if ( $youtube__curl['info']['http_code'] == 200 ) {
        $youtube__array = json_decode( $youtube__curl['data'], true );
        if ( isset( $youtube__array['items'] ) ) {
          foreach ( $youtube__array['items'] as $item ) {
            $data['id'] = $item['id']['videoId'];
			$item['title2'] = strip_tags($item['snippet']['title']);
			$item['title2'] = str_replace( ' (Official Music Video)', '', $item['title2'] );
			$item['title2'] = str_replace( '| Official Music Video', '', $item['title2'] );
			$item['title2'] = str_replace( ' Official', '', $item['title2'] );
			$item['title2'] = str_replace( '[', '', $item['title2'] );
			$item['title2'] = str_replace( ']', '', $item['title2'] );
			$item['title2'] = str_replace( '(', '', $item['title2'] );
			$item['title2'] = str_replace( ')', '', $item['title2'] );
			$item['title2'] = str_replace( ' Official', '', $item['title2'] );
			$item['title2'] = str_replace( ' official', '', $item['title2'] );
			$item['title2'] = str_replace( ' Video', '', $item['title2'] );
			$item['title2'] = str_replace( ' video', '', $item['title2'] );
			$item['title2'] = str_replace( ' Audio', '', $item['title2'] );
			$item['title2'] = str_replace( ' audio', '', $item['title2'] );
			$item['title2'] = str_replace( ' Music', '', $item['title2'] );
			$item['title2'] = str_replace( ' music', '', $item['title2'] );
			$item['title2'] = str_replace( ' OFFICIAL', '', $item['title2'] );
			$item['title2'] = str_replace( ' MUSIC', '', $item['title2'] );
			$item['title2'] = str_replace( ' VIDEO', '', $item['title2'] );
			$item['title2'] = str_replace( ' AUDIO', '', $item['title2'] );
			$data['title'] = str_replace( '||', '', $item['title2'] );
            $data['desc'] = strip_tags($item['snippet']['description']);
            $data['date'] = $this->convert_youtube_date($item['snippet']['publishedAt']);
            $data['channel'] = $item['snippet']['channelTitle'];
            $data['image'] = 'https://i2.wp.com/ytimg.googleusercontent.com/vi/'.$item['id']['videoId'].'/mqdefault.jpg';
            $items[] = $data;
          } unset( $item, $data );
        }
      }
    }

    return ( isset( $items ) ) ? $items : [];
  }

  public function get_download() {
    global $route;

    $slug = $route['vars'][0];
    $id = $route['vars'][1];
	$full_slug = $slug . '-' . $id;
    $cache_file = get_cache_path() . '/downloads/' . md5( $full_slug ) .'.json';

    if ( file_exists( $cache_file ) ) {
      $data = json_decode( file_get_contents( $cache_file ), true );
    } else {
	  $decode_id = base64_url_decode( $id );
      $exp_decode_id = explode( '--', $decode_id );
	  
	  if ( count( $exp_decode_id ) == 2 ) {
		  $id = $exp_decode_id[1];
          
		  $youtube__api_key = $this->get_youtube_api();
          if ( $youtube__api_key ) {
            $youtube__url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails,statistics&id=' . $id . '&key=' . $youtube__api_key;
            $youtube__curl = $this->curl( $youtube__url, 'https://www.youtube.com' );

            if ( $youtube__curl['info']['http_code'] == 200 ) {
              $youtube__array = json_decode( $youtube__curl['data'], true );
              if ( isset( $youtube__array['items'][0]['snippet'] ) && isset( $youtube__array['items'][0]['contentDetails'] ) ) {
                $snippet = $youtube__array['items'][0]['snippet'];
                $content_details = $youtube__array['items'][0]['contentDetails'];
				$statistics = $youtube__array['items'][0]['statistics'];

                $data['id'] = $id;
				$item['title2'] = strip_tags($snippet['title']);
				$item['title2'] = str_replace( ' (Official Music Video)', '', $item['title2'] );
				$item['title2'] = str_replace( '| Official Music Video', '', $item['title2'] );
				$item['title2'] = str_replace( ' Official', '', $item['title2'] );
				$item['title2'] = str_replace( '[', '', $item['title2'] );
				$item['title2'] = str_replace( ']', '', $item['title2'] );
				$item['title2'] = str_replace( '(', '', $item['title2'] );
				$item['title2'] = str_replace( ')', '', $item['title2'] );
				$item['title2'] = str_replace( ' Official', '', $item['title2'] );
				$item['title2'] = str_replace( ' official', '', $item['title2'] );
				$item['title2'] = str_replace( ' Video', '', $item['title2'] );
				$item['title2'] = str_replace( ' video', '', $item['title2'] );
				$item['title2'] = str_replace( ' Audio', '', $item['title2'] );
				$item['title2'] = str_replace( ' audio', '', $item['title2'] );
				$item['title2'] = str_replace( ' Music', '', $item['title2'] );
				$item['title2'] = str_replace( ' music', '', $item['title2'] );
				$item['title2'] = str_replace( ' Lyric', '', $item['title2'] );
				$item['title2'] = str_replace( ' lyric', '', $item['title2'] );
				$item['title2'] = str_replace( ' OFFICIAL', '', $item['title2'] );
				$item['title2'] = str_replace( ' MUSIC', '', $item['title2'] );
				$item['title2'] = str_replace( ' VIDEO', '', $item['title2'] );
				$item['title2'] = str_replace( ' AUDIO', '', $item['title2'] );
				$item['title2'] = str_replace( ' |', '', $item['title2'] );
				$data['title'] = str_replace( '||', '', $item['title2'] );
                $data['channel'] = $snippet['channelTitle'];
				$data['date'] = $this->convert_youtube_date($snippet['publishedAt']);
                $data['duration'] = $this->convert_youtube_time( $content_details['duration'] );
                $data['image'] = 'https://i2.wp.com/ytimg.googleusercontent.com/vi/'.$id.'/mqdefault.jpg';

                $exp_duration = explode( ':', $data['duration'] );
                if ( count( $exp_duration ) == 2 ) {
                  $parsed = date_parse( '00:' . $data['duration'] );
                  $seconds = ( $parsed['minute'] * 60 ) + $parsed['second'];
                } else {
                  $parsed = date_parse( $data['duration'] );
                  $seconds = ( $parsed['hour'] * 60 * 60 ) + ( $parsed['minute'] * 60 ) + $parsed['second'];
                }

                $data['view'] = isset($statistics['viewCount']) ? number_format($statistics['viewCount']) : 0;
				$data['size'] = $this->get_format_bytes( ( $seconds * ( 128 / 8 ) * 1000 ) );
              }
            }
          }
	  }
      if ( isset( $data ) ) {
        download_cache( $cache_file, $data );
      }
    }

    return ( isset( $data ) ) ? $data : [];
  }

  public function get_convert() {
    global $route;

    $id = $route['vars'][0];

          $youtube__api_key = $this->get_youtube_api();
          if ( $youtube__api_key ) {
            $youtube__url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails&id=' . $id . '&key=' . $youtube__api_key;
            $youtube__curl = $this->curl( $youtube__url, 'https://www.youtube.com' );

            if ( $youtube__curl['info']['http_code'] == 200 ) {
              $youtube__array = json_decode( $youtube__curl['data'], true );
              if ( isset( $youtube__array['items'][0]['snippet'] ) && isset( $youtube__array['items'][0]['contentDetails'] ) ) {
                $snippet = $youtube__array['items'][0]['snippet'];
                $content_details = $youtube__array['items'][0]['contentDetails'];

                $data['id'] = $id;
                $data['title'] = $snippet['title'];
				$item['title2'] = strip_tags($snippet['title']);
				$item['title2'] = str_replace( ' (Official Music Video)', '', $item['title2'] );
				$item['title2'] = str_replace( '| Official Music Video', '', $item['title2'] );
				$item['title2'] = str_replace( ' Official', '', $item['title2'] );
				$item['title2'] = str_replace( '[', '', $item['title2'] );
				$item['title2'] = str_replace( ']', '', $item['title2'] );
				$item['title2'] = str_replace( '(', '', $item['title2'] );
				$item['title2'] = str_replace( ')', '', $item['title2'] );
				$item['title2'] = str_replace( ' Official', '', $item['title2'] );
				$item['title2'] = str_replace( ' official', '', $item['title2'] );
				$item['title2'] = str_replace( ' Video', '', $item['title2'] );
				$item['title2'] = str_replace( ' video', '', $item['title2'] );
				$item['title2'] = str_replace( ' Audio', '', $item['title2'] );
				$item['title2'] = str_replace( ' audio', '', $item['title2'] );
				$item['title2'] = str_replace( ' Music', '', $item['title2'] );
				$item['title2'] = str_replace( ' music', '', $item['title2'] );
				$item['title2'] = str_replace( ' Lyric', '', $item['title2'] );
				$item['title2'] = str_replace( ' lyric', '', $item['title2'] );
				$item['title2'] = str_replace( ' OFFICIAL', '', $item['title2'] );
				$item['title2'] = str_replace( ' MUSIC', '', $item['title2'] );
				$item['title2'] = str_replace( ' VIDEO', '', $item['title2'] );
				$item['title2'] = str_replace( ' AUDIO', '', $item['title2'] );
				$item['title2'] = str_replace( ' |', '', $item['title2'] );
				$data['title'] = str_replace( '||', '', $item['title2'] );
                $data['channel'] = $snippet['channelTitle'];
				$data['date'] = $this->convert_youtube_date($snippet['publishedAt']);
                $data['duration'] = $this->convert_youtube_time( $content_details['duration'] );
                $data['image'] = 'https://i2.wp.com/ytimg.googleusercontent.com/vi/'.$id.'/mqdefault.jpg';

                $exp_duration = explode( ':', $data['duration'] );
                if ( count( $exp_duration ) == 2 ) {
                  $parsed = date_parse( '00:' . $data['duration'] );
                  $seconds = ( $parsed['minute'] * 60 ) + $parsed['second'];
                } else {
                  $parsed = date_parse( $data['duration'] );
                  $seconds = ( $parsed['hour'] * 60 * 60 ) + ( $parsed['minute'] * 60 ) + $parsed['second'];
                }

                $data['size'] = $this->get_format_bytes( ( $seconds * ( 128 / 8 ) * 1000 ) );
              }
            }
          }

    return ( isset( $data ) ) ? $data : [];
  }
  
  public function get_related() {
	
    global $route;

    $slug = $route['vars'][0];
    $id = $route['vars'][1];
    $decode_id = base64_url_decode( $id );
    $exp_decode_id = explode( '--', $decode_id );

    if ( count( $exp_decode_id ) == 2 ) {
      $id = $exp_decode_id[1];
	  $youtube__api_key = $this->get_youtube_api();
	  $items = [];
	  $count = get_option( 'youtube_related_count' );
		
          if ( $youtube__api_key ) {
            $youtube__url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&maxResults=' . $count . '&relatedToVideoId=' . $id . '&key=' . $youtube__api_key;
            $youtube__curl = $this->curl( $youtube__url, 'https://www.youtube.com' );

			if ( $youtube__curl['info']['http_code'] == 200 ) {
			  $youtube__array = json_decode( $youtube__curl['data'], true );
			  if ( isset( $youtube__array['items'] ) ) {
				foreach ( $youtube__array['items'] as $item ) {
				  $data['id'] = $item['id']['videoId'];
				  $item['title2'] = strip_tags($item['snippet']['title']);
				  $item['title2'] = str_replace( ' (Official Music Video)', '', $item['title2'] );
				  $item['title2'] = str_replace( '| Official Music Video', '', $item['title2'] );
				  $item['title2'] = str_replace( ' Official', '', $item['title2'] );
				  $item['title2'] = str_replace( '[', '', $item['title2'] );
				  $item['title2'] = str_replace( ']', '', $item['title2'] );
				  $item['title2'] = str_replace( '(', '', $item['title2'] );
				  $item['title2'] = str_replace( ')', '', $item['title2'] );
				  $item['title2'] = str_replace( ' Official', '', $item['title2'] );
				  $item['title2'] = str_replace( ' official', '', $item['title2'] );
				  $item['title2'] = str_replace( ' Video', '', $item['title2'] );
				  $item['title2'] = str_replace( ' video', '', $item['title2'] );
				  $item['title2'] = str_replace( ' Audio', '', $item['title2'] );
				  $item['title2'] = str_replace( ' audio', '', $item['title2'] );
				  $item['title2'] = str_replace( ' Music', '', $item['title2'] );
				  $item['title2'] = str_replace( ' music', '', $item['title2'] );
				  $item['title2'] = str_replace( ' Lyric', '', $item['title2'] );
				  $item['title2'] = str_replace( ' lyric', '', $item['title2'] );
				  $item['title2'] = str_replace( ' OFFICIAL', '', $item['title2'] );
				  $item['title2'] = str_replace( ' MUSIC', '', $item['title2'] );
				  $item['title2'] = str_replace( ' VIDEO', '', $item['title2'] );
				  $item['title2'] = str_replace( ' AUDIO', '', $item['title2'] );
				  $item['title2'] = str_replace( ' |', '', $item['title2'] );
				  $data['title'] = str_replace( '||', '', $item['title2'] );
				  $data['date'] = $this->convert_youtube_date($item['snippet']['publishedAt']);
				  $data['channel'] = $item['snippet']['channelTitle'];
				  $data['image'] = 'https://i2.wp.com/ytimg.googleusercontent.com/vi/'.$item['id']['videoId'].'/mqdefault.jpg';
				  $items[] = $data;
				} unset( $item, $data );
			  }
			}
		  }
	}
    return ( isset( $items ) ) ? $items : [];
  }
	
  public function get_pages() {
    global $route;
    $url = $route['vars'][0];
	$cache_file = get_page_path() . '/' . md5( $url ) .'.json';
	if ( file_exists( $cache_file ) ) {
	  $cache_data = json_decode( file_get_contents( $cache_file ), true );
	}
	$data['title'] = $cache_data['title'];
	$data['url'] = $cache_data['url'];
	$data['text'] = $cache_data['text'];
	return ( isset( $data ) ) ? $data : [];
  }
	
  public function get_post() {
    global $route;
    $url = $route['vars'][0];
	$cache_file = get_post_path() . '/' . $url .'.json';
	if ( file_exists( $cache_file ) ) {
	  $cache_data = json_decode( file_get_contents( $cache_file ), true );
	}
	$data['slug'] = $cache_data['slug'];
	$data['title'] = $cache_data['title'];
	$data['artist'] = $cache_data['artist'];
	$data['genre'] = $cache_data['genre'];
	$data['album'] = $cache_data['album'];
	$data['added'] = $cache_data['added'];
	$data['date'] = $cache_data['date'];
	$data['duration'] = $cache_data['duration'];
	$data['size'] = $cache_data['size'];
	$data['image'] = $cache_data['image'];
	return ( isset( $data ) ) ? $data : [];
  }

  private function itunes_genre_id($genre){
    $genre = trim(preg_replace(array("`'`", "`[^a-z0-9]+`"),  array("", "-"), strtolower($genre)), "-");
    $genre_list = array("alternative"=>"20","anime"=>"29","blues"=>"2","brazilian"=>"1122","children-music"=>"4","chinese"=>"1232","christian-gospel"=>"22","classical"=>"5","comedy"=>"3","country"=>"6","dance"=>"17","disney"=>"50000063","easy-listening"=>"25","electronic"=>"7","enka"=>"28","fitness-workout"=>"50","french-pop"=>"50000064","german-folk"=>"50000068","german-pop"=>"50000066","hip-hop-rap"=>"18","holiday"=>"8","indian"=>"1262","instrumental"=>"53","j-pop"=>"27","jazz"=>"11","k-pop"=>"51","karaoke"=>"52","kayokyoku"=>"30","korean"=>"1243","latino"=>"12","new-age"=>"13","opera"=>"9","pop"=>"14","rnb-soul"=>"15","reggae"=>"24","rock"=>"21","singer-songwriter"=>"10","soundtrack"=>"16","spoken-word"=>"50000061","vocal"=>"23","world"=>"19");
     
      if(isset($genre_list[$genre])){
        return $genre_list[$genre];
      }
  }

  private function get_youtube_api() {
    $api_keys = get_option( 'youtube_api_keys' );
    if ( $api_keys ) {
      $exp_api_keys = explode( ',', $api_keys );
      shuffle( $exp_api_keys );
      return $exp_api_keys[0];
    }
  }

  private function curl( $url, $referer = '' ) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $ua = new UA;
    $ch = curl_init();

  	curl_setopt( $ch, CURLOPT_URL, $url );
  	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch, CURLOPT_ENCODING, "gzip,deflate" );
    curl_setopt( $ch, CURLOPT_USERAGENT, $ua->get_ua() );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5 );
  	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, TRUE );

    if ( $referer ) {
      curl_setopt( $ch, CURLOPT_REFERER, $referer );
    }

    curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
  	curl_setopt( $ch, CURLOPT_HTTPHEADER, [ "Accept-Language: en-US;q=0.6,en;q=0.4", "REMOTE_ADDR: $ip", "HTTP_X_FORWARDED_FOR: $ip" ] );

    $data = curl_exec( $ch );
  	$info = curl_getinfo( $ch );

  	curl_close( $ch );

  	return [ 'info' => $info, 'data' => $data ];
  }

  private function convert_youtube_time( $time ){
    $start = new DateTime( '@0' );
    $start->add( new DateInterval( $time ) );
    return $start->format( 'i:s' );
  }
  
  private function myslug( $url ){
	$url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
	$url = trim($url, "-");
	$url = strtolower($url);
	return $url;
  }
  
  private function lyslug( $url ){
	$url = preg_replace('~[^\\pL0-9_]+~u', ' ', $url);
	$url = trim($url, " ");
	$url = strtolower($url);
	return $url;
  }
  
  private function convert_youtube_date($date){
	$date = substr($date,0,10);
	$date = explode('-',$date);
	$mn = date('F',mktime(0,0,0,$date[1]));
	$dates=''.$date[2].' '.$mn.' '.$date[0].'';
	return $dates;
  }

  private function get_format_bytes( $bytes, $precision = 2 ) {
  	$units = [ 'B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB' ];
  	$bytes = max( $bytes, 0);
  	$pow = floor( ( $bytes ? log( $bytes ) : 0) / log( 1024 ) );
  	$pow = min( $pow, count( $units ) - 1 );
  	$bytes /= pow( 1024, $pow );
  	return round( $bytes, $precision ) . '' . $units[$pow];
  }
}

function agc() {
  return new AGC;
}
