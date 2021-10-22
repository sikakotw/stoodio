<div class="nxt-inner-content">
<div class="container">
<div class="row">
<section class="col-md-12">
<div class="row">
<div class="col-md-9 new-content">
<div class="nxt-single">
<div class="nxt-body">
<div class="nxttitle nxt-icon">
<h1><?php echo $data['artist']; ?> - <?php echo $data['title']; ?></h1>
</div>
<div class="metasingle-aftertitle">
<span class="nxt-author"><?php echo $data['artist']; ?></span> <span class="nxt-date"><?php echo timeline($data['added']); ?></span>
</div>
<div class="nxt-content nxt-wrap-content-single nxt-post">
<p class="nxt-konten media"><img class="media-object pull-left" src="<?php echo $data['image']; ?>?resize=180,180" alt="<?php echo $data['artist']; ?> - <?php echo $data['title']; ?>width="120" height="120"> Download <strong><?php echo $data['artist']; ?> - <?php echo $data['title']; ?></strong> dengan High Quality Audio MP3 dan HD Video MP4, di-upload oleh <strong></strong>. Dapatkan lagu dan video <strong><?php echo $data['artist']; ?> - <?php echo $data['title']; ?></strong> secara gratis, mudah, dan cepat hanya di <strong></strong>!</p>

<audio class="aligncenter" src="https://m.youtube.com/watch?v=<?php echo $result[0]['id']; ?>" type="video/youtube" style="width: 90%; margin-bottom: -5px;">Your browser does not support the audio element</audio>

<div class="download noleft">
<ul class="dl-list">
<li><a class="btn" href="<?php echo convert_permalink($result[0]['id']); ?>" rel="nofollow noopener noreferrer">Download</a></li>
<li><a rel="nofollow" class="btn red" href="https://music.youtube.com/watch?v=<?php echo $result[0]['id']; ?>" target="_blank">Youtube Music</a></li>
<li><a class="btn dots" href="#info">Info &amp; Statistik</a></li>
<li><a class="btn dots" href="#lirik">Lirik Lagu</a></li>
<li><a class="btn dots" href="#share">Share</a></li>
</ul>
</div>

<blockquote><strong>Peringatan!</strong> Gunakan lagu dari <?php echo site_url(); ?> sebagai preview saja, jika kamu suka dengan lagu <strong><?php echo $data['artist']; ?> - <?php echo $data['title']; ?></strong>, lebih baik kamu membeli atau download dan streaming secara legal. Kamu juga bisa mendukung artis dengan mengikuti akun sosial media dan menonton konser mereka.</blockquote>
<div id="info" class="download">
<h4 class="widget-title">Info &amp; Statistik</h4></div>
<div class="info noleft">
<img class="aligncenter" src="<?php echo $data['image']; ?>?resize=180,180" alt="<?php echo $data['title'];?>">
<ul>
<li>Judul: <strong><?php echo $data['title']; ?></strong></li>
<li>Artis: <strong><?php echo $data['artist']; ?></strong></li>
<li>Album: <strong><?php echo $data['album']; ?></strong></li>
<li>Genre Musik: <strong><?php echo $data['genre']; ?></strong></li>
<li>Waktu putar: <strong><?php echo $data['duration']; ?></strong></li>
<li>Ukuran: <strong><?php echo $data['size']; ?></strong></li>
<li>Audio: <strong>44,1 kHz, Stereo, 128 kb/s, MP3</strong></li>
<li>Dirilis: <strong><?php echo timeline($data['date']); ?></strong></li>
<li>Diperbarui: <strong><?php echo timeline($data['added']); ?></strong></li>
</ul>
</div>
<div id="lirik" class="download">
<h4 class="widget-title">Lirik Lagu</h4></div>
<div class="lirik-full">
Lirik Lagu "<strong><?php echo $data['title']; ?></strong>" oleh <strong><?php echo $data['artist']; ?></strong><br /><br />
<div id="search-result">
<script> let query = "<?php echo $data['artist']; ?> - <?php echo $data['title']; ?>"; </script> <script> let result = document.getElementById("search-result"); function showCard(e) { return `
${e.lyric}`; } document.addEventListener("DOMContentLoaded", function() { fetch("/grab/lyric.php?s=" + query).then((response) => { if (response.ok) { return response.json(); } else { console.log(response); return result.innerHTML = ` <h2 class="judul"> OOpss.. </h2> Ada masalah dengan pencarian <br/> "<strong>${query}</strong>" <br/> Error ${response.status} ${response.statusText}<br/> <h2 class="judul"> Cari dengan pencarian lain <</h2> `; } }).then(e => { t = "", e.forEach(e => { t += showCard(e) }), result.innerHTML = ` ${t}`;}) }) ;</script>
</div></div>
<div id="share" class="nxt-share download">
<h4 class="widget-title"><span>Bagikan halaman ini:</span></h4>
<a rel="nofollow noreferrer" href="https://www.facebook.com/sharer/sharer.php?url=<?php echo canonical_url(); ?>" target="_blank"><img src="/themes/golagu/images/fb.png" title="Share to Facebook" alt="Share to Facebook" width="40" height="40"></a>
<a rel="nofollow noreferrer" href="https://twitter.com/intent/tweet?text=&url=<?php echo canonical_url(); ?>" target="_blank"><img src="/themes/golagu/images/tw.png" title="Share to Twitter" alt="Share to Twitter" width="40" height="40"></a>
<a rel="nofollow noreferrer" href="https://api.whatsapp.com/send?text=<?php echo canonical_url(); ?>" target="_blank"><img src="/themes/golagu/images/wa.png" title="Share to WhatsApp" alt="Share to WhatsApp" width="40" height="40"></a>
<a rel="nofollow noreferrer" href="https://social-plugins.line.me/lineit/share?url=<?php echo canonical_url(); ?>" target="_blank"><img src="/themes/golagu/images/line.png" title="Share to Line" alt="Share to Line" width="40" height="40"></a>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-3 widget-area">
<aside class="widget toplist">
<h4 class="widget-title">Lagu Terpopuler</h4>
<ul>
<?php if ( $by_artist ) { ?>
<?php foreach ( $by_artist as $item ) { ?>
<li>
<a href="<?php echo post_permalink($item['slug']); ?>"><img class="nxt-img" src="<?php echo $item['image'];?>?resize=320,100" alt="<?php echo $item['artist'];?> - <?php echo $item['title'];?>" /> <span class="nxt-title"><?php echo $item['artist'];?> - <?php echo $item['title'];?></span> <span class="duration"><?php echo $item['duration'];?></span></a>
</li>
<?php } unset( $item ); ?>
<?php } ?>
</ul>
</aside>
<?php if ( $searches ) { ?>
<aside class="widget toplist">
<h4 class="widget-title">Lagu Terbaru</h4>
<ul>
<?php foreach( $searches as $item ) { ?>
<li><a href="<?php echo search_permalink( $item['q'] ); ?>" title="<?php echo $item['q']; ?>"><?php echo $item['q']; ?></a></li>
<?php } ?>
</ul>
</aside>
<?php } ?>
</div>
</div>