<?php
return [
  '/' => [ 'name' => 'home', 'file' => 'home.php' ],
  'search/([^/!#$&*()+={}\[\]|;,]+)' => [ 'name' => 'search', 'file' => 'search.php' ],
  'grab/search/([^/!#$&*()+={}\[\]|;,]+)' => [ 'name' => 'json', 'file' => 'grab/json.php' ],
  'download/([^/_~!#$&*()+={}\[\]|;,]+)-([^/_~!#$&*()+={}\[\]|;,]+)' => [ 'name' => 'download', 'file' => 'download.php' ],
  'convert/([^/!#$&*()+={}\[\]|;,]+)' => [ 'name' => 'convert', 'file' => 'convert.php' ],
  'playlist/([^/!#$&*()+={}\[\]|;,]+)' => [ 'name' => 'playlist', 'file' => 'playlist.php' ],
  'page/([^/!#$&*()+={}\[\]|;,]+)' => [ 'name' => 'pages', 'file' => 'pages.php' ],
  'post/([^/!#$&*()+={}\[\]|;,]+)' => [ 'name' => 'post', 'file' => 'post.php' ],
  'sitemap/searches.xml' => [ 'name' => 'sitemap-searches', 'file' => 'sitemap.php' ],
  'sitemap/post-([0-9-]+).xml' => [ 'name' => 'sitemap-posts', 'file' => 'sitemap.php' ],
  'sitemap/([0-9-]+).xml' => [ 'name' => 'sitemap-keywords', 'file' => 'sitemap.php' ],
  'sitemap.xml' => [ 'name' => 'sitemap-index', 'file' => 'sitemap.php' ]
];
