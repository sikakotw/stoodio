<!DOCTYPE html>
<html lang="id"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $site_title; ?></title>
<?php if ( isset( $meta_description ) ) { ?>
<meta name="description" content="<?php echo $meta_description; ?>"/>
<meta property="og:description" content="<?php echo $meta_description; ?>"/>
<?php } ?>
<meta property="og:site_name" content="<?php echo get_option( 'site_name' ); ?>"/>
<meta property="og:title" content="<?php echo $site_title; ?>"/>
<meta property="og:url" content="<?php echo canonical_url(); ?>"/>
<meta name="google-site-verification" content="<?php echo get_option( 'google_verify' ); ?>">
<?php if ( isset( $meta_robots ) ) { ?>
<meta name="robots" content="<?php echo $meta_robots; ?>"/>
<?php } ?>
<meta name="Language" content="Indonesia"/>
<meta http-equiv="content-language" content="ID"/>
<meta name="geo.placename" content="Indonesia"/>
<meta name="geo.region" content="ID"/>
<meta property="og:locale" content="id_ID"/>
<?php if ( isset( $result[0]['image'] ) ) { ?>
<meta property="og:image" content="<?php echo $result[0]['image']; ?>"/>
<?php } elseif ( isset( $result['image'] ) ) { ?>
<meta property="og:image" content="<?php echo $result['image']; ?>"/>
<?php } ?><meta name="theme-color" content="#3F51B5"/>
<link rel="dns-prefetch" href="//ajax.googleapis.com">
<link rel="dns-prefetch" href="//www.googletagmanager.com">
<link rel="dns-prefetch" href="//www.google-analytics.com">
<link rel="dns-prefetch" href="//i2.wp.com">
<style>html{-webkit-box-sizing:border-box;box-sizing:border-box;line-height:1.15;font:normal normal normal 1rem/1.6 -apple-system,BlinkMacSystemFont,Helvetica Neue,Helvetica,Arial,sans-serif;font-size:1em;font-weight:400;scroll-behavior:smooth;-webkit-font-smoothing:antialiazed;-moz-osx-font-smoothing:grayscale}body{line-height:27px;font-size:16px;font-weight:400;font-family:Roboto,sans-serif;margin:0;background:#000;color:#eee;}.title-class{font-size:20px;padding:6px 0;}h1, h2, h3, h4, h5{margin:0;padding:0;font-weight:400;}h3{font-size:1em;padding:0;margin:0;}h1{font-size:18px;}a{color:#fff;text-decoration:none;}.wrapper{display:block;max-width:840px;margin:0 auto;}.wrapper-menu{display:block;max-width:400px;margin:0 auto;}header{background:#3F51B5;padding:30px 20px 60px;text-align:center;}header a{font-size:28px;color:#fff;font-weight:bold;}header p{color:#fff;padding:10px;font-size:16px}.search{position:relative;width:100%;max-width:600px;margin:30px auto 0;}[type="text"]{font-size:16px;padding:13px 50px 14px 20px;color:#eee;width:100%;max-width:600px;box-sizing:border-box;background:#333;border:0;border-radius:5px;}[type="submit"]{background:#333;border:0;padding:10px 15px;color:#eee;position:absolute;bottom:0;right:0;border-radius:0 5px 5px 0;cursor:pointer;}[type]:focus{border:0;outline:none;box-shadow:none;}.menu-bar{margin:0 20px 20px;text-align:center;background:#222;border-radius:100px;padding:20px 15px;white-space:nowrap;overflow-x:auto;box-shadow:0 2px 3px 0 rgba(0,0,0,.15);}.menu-bar a{background:#444;padding:8px;margin:3px;border-radius:100px;}.top{margin-top:-35px!important;}.menu{margin:10px 20px;background:#222;border-radius:6px;padding:20px 15px;box-shadow:0 2px 3px 0 rgba(0,0,0,.15);}.track{padding:5px 0 10px;border-bottom:1px solid #444}.img-flex img{border-radius:6px;width:55px;}.img-flex{overflow:hidden;float:left;width:55px;height:55px;background: url('/themes/bejo/assets/icon.png');background-size:21px;border-radius:6px;background-repeat:no-repeat;background-position:center;background-color:#bdbdbd;}.item-flex{height:50px;overflow:hidden;padding-left:10px}.title{white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.small{font-size:12px}.clearfix:after{content: "."; display: block; height: 0; clear: both; visibility: hidden;}.clearfix{display: inline-block;}.clearfix{display: block;}.none{display: none;}.list{display: none;}.list:first-child {display: block;}.alert{color:#333;font-size:15px;margin:0px 0px 38px 0px;padding:4px;}.recent{border-bottom:1px solid #444;padding:10px 0;display:block;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}footer{text-align:center;padding:26px 20px 20px 20px;}@media screen and (max-width:540px){.menu-bar{margin:0px 10px 20px;padding:15px 10px;}.menu{margin:10px 10px;padding:15px 10px;}}.download{background:#444;color:#fff;padding:10px 20px;margin:5px;font-weight:bold;border-radius:4px;}.download:hover{background:#222;color:#fff;box-shadow:0 2px 3px 0 rgba(0,0,0,.15);}@media screen and (min-width:750px){.menu{margin-left:5px;margin-right:5px;}.kiri{display:inline-block;width:70%;float:left;margin-right:2px;}.kanan{display:inline-block;width:29%;vertical-align:top;float:right;margin-left:2px;}}.clear{clear:both;float:none;}.playlist-flex{overflow:hidden;float:left;width:30px;height:30px;font-size:18px;text-align:center;line-height:30px;border-radius:6px;background-color:#3f51b5;}.lists-flex{height:25px;overflow:hidden;padding-left:10px;}.footer{text-align:center;padding:10px 10px 15px;display:block}.footer a{background:#3F51B5;padding:5px 8px;font-size:14px;margin:3px;border-radius:15px;}</style>
<?php
if ( file_exists( BASE . '/config/' . $_SERVER['HTTP_HOST'] . '/_header.php' ) ) {
include BASE . '/config/' . $_SERVER['HTTP_HOST'] . '/_header.php';
}?></head><body><header><a href="<?php echo site_url(); ?>"><?php echo get_option( 'site_name' ); ?></a><form method="get" action="<?php echo site_url(); ?>" class="search"><input autocomplete="off" type="text" name="search" placeholder="Artist - Title ..." required autofocus /><button name="Search" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 128 128" fill="#777"><path d="M52.35 14.4c-9.725 0-19.45 3.7-26.85 11.1-14.8 14.8-14.8 38.9 0 53.7C32.9 86.6 42.6 90.3 52.4 90.3S71.9 86.6 79.3 79.2C94 64.4 94 40.3 79.2 25.5c-7.4-7.4-17.125-11.1-26.85-11.1zm-.05 5.9c8.2 0 16.4 3.098 22.6 9.398C87.4 42.2 87.4 62.5 75 75c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3C35.9 23.5 44.1 20.3 52.3 20.3zm0 6A25.41 25.41 0 0 0 34 34c-4.7 4.7-7.3 10.8-7.6 17.4-.1 1.7 1.2 3 2.9 3.1h.1c1.6 0 2.9-1.3 3-2.9.2-5.1 2.3-9.8 5.8-13.4C42 34.4 47 32.3 52.3 32.3c1.7 0 3-1.3 3-3s-1.3-3-3-3zM35 64a3 3 0 1 0 0 6 3 3 0 1 0 0-6zm48.363 16.5c-.763 0-1.513.3-2.062.9-1.2 1.2-1.2 3.1 0 4.2l2.5 2.5a8.6 8.6 0 0 0-.9 3.9c0 2.4.9 4.7 2.6 6.4L98.3 111c1.8 1.8 4.098 2.7 6.398 2.7s4.6-.9 6.4-2.6c3.5-3.5 3.5-9.2 0-12.7L98.3 85.6c-1.7-1.7-4-2.6-6.4-2.6a8.6 8.6 0 0 0-3.9.9l-2.5-2.5c-.6-.6-1.374-.9-2.137-.9zm8.537 8.4c.8 0 1.6.3 2.1.9l12.7 12.7c1.2 1.2 1.2 3.1 0 4.2-1.2 1.2-3.1 1.2-4.2 0L89.8 94.1a3.1 3.1 0 0 1-.9-2.199c0-.8.3-1.6.9-2.1.6-.6 1.3-.9 2.1-.9z"/></svg></button></form></header>