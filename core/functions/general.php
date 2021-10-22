<?php
function site_url() {
	if (
    isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' ||
    ! empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ||
    ! empty( $_SERVER['HTTP_X_FORWARDED_SSL'] ) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on'
  ) {
		$ssl = true;
	} else {
    $ssl = false;
  }

	$protocol = $ssl ? 'https' : 'http';
	$host = '://' . $_SERVER['HTTP_HOST'];
	$path = PATH;
	$url = $protocol . $host . $path;

	return $url;
}

function canonical_url() {
  $path = ( PATH == '' ) ? '/' : PATH;
  $parse_uri = parse_url( $_SERVER['REQUEST_URI'] );
  $clean_path = str_replace( PATH, '', $parse_uri['path'] );

  if ( $path == '/' ) {
    $uri = ( $parse_uri['path'] != '/' ) ? '/' . ltrim( $parse_uri['path'], '/' ) : '';
  } else {
    $uri = ( $clean_path != '/' ) ? '/' . str_replace( PATH . '/', '', $parse_uri['path'] ) : '';
  }

	return site_url() . $uri;
}

function redirect( $url = '', $method = '', $time = 1 ) {
  switch( $method ) {
    case 'refresh':
      header( "Refresh:$time; url=$url" );
    break;

    default:
    	header( "Location: $url" );
	    exit;
    break;
  }
}

function timeline($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'Year',
        'm' => 'Month',
        'w' => 'Week',
        'd' => 'Day',
        'h' => 'Hour',
        'i' => 'Minute',
        's' => 'Second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'Just now';
}

function uri_has_extension( $uri ) {
	$exp_uri = explode( '/', $uri );
	$last_item = end( $exp_uri );
	$exp_last_item = explode( '.', $last_item, 2 );
	$has_extension = ( count( $exp_last_item ) > 1 ) ? end( $exp_last_item ) : false;

	return $has_extension;
}

function print_error( $message = null ) {
  $html = '<!DOCTYPE html>';
  $html.= '<html>';
  $html.= '<head>';
  $html.= '<title>Error!</title>';
  $html.= '<style type="text/css">';
  $html.= 'body { padding: 0; margin: 0; overflow-y: scroll; line-height: 20px; font: normal 13px/20px "Helvetica Neue", Helvetica, Arial, sans-serif; background: #eee; color: #444; }';
  $html.= 'div { margin: 15px; padding: 10px 15px; border-left: 3px solid #e64b4b; background: #fff; }';
  $html.= '</style>';
  $html.= '</head>';
  $html.= '<body>';
  $html.= '<div><strong>ERROR:</strong> ' . $message . '</div>';
  $html.= '</body>';
  $html.= '</html>';

  exit( $html );
}

function print_array( $array = [], $exit = true ) {
	echo '<pre>';
	print_r( $array );
	( $exit ) ? exit( '<pre>' ) : '</pre>';
}
