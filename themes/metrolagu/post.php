<div class="ngiri">
<div class="menu">
<center>
<table width="100%">
<tr><td width="150px"><img width="150px" src="<?php echo $data['image']; ?>"></td>
<td valign="top" style="padding-left:10px">
<b><?php echo $data['artist']; ?> - <?php echo $data['title']; ?></b> <br />
Album: <?php echo $data['album']; ?><br />
Genre: <?php echo $data['genre']; ?><br />
Sample Rate: 48kHz<br />
Size: <?php echo $data['size']; ?><br />
Audio Channels: Stereo
<br />
</td></tr>
</table>
</center>
<br /><center>
<audio src="https://www.youtube.com/watch?v=<?php echo $result[0]['id']; ?>" type="video/youtube" controls style="width: 100%">Your browser does not support the audio element</audio>
<br />
<br />
<a style="width:auto;" href="<?php echo convert_permalink($result[0]['id']); ?>" class="download-album" rel="nofollow noopener noreferrer"> Download MP3 </a>
<br />
<br /><br />
<div class="lirik" align="center">Jika link download error/muncul iklan, coba sekali lagi :p<br /><br />
Lirik Lagu "<strong><?php echo $data['title']; ?></strong>" oleh <strong><?php echo $data['artist']; ?></strong>
<div id="search-result">
<script> let query = "<?php echo $data['artist']; ?> - <?php echo $data['title']; ?>"; </script> <script> let result = document.getElementById("search-result"); function showCard(e) { return `
${e.lyric}`; } document.addEventListener("DOMContentLoaded", function() { fetch("/grab/lyric.php?s=" + query).then((response) => { if (response.ok) { return response.json(); } else { console.log(response); return result.innerHTML = ` <h2 class="judul"> OOpss.. </h2> Ada masalah dengan pencarian <br/> "<strong>${query}</strong>" <br/> Error ${response.status} ${response.statusText}<br/> <h2 class="judul"> Cari dengan pencarian lain <</h2> `; } }).then(e => { t = "", e.forEach(e => { t += showCard(e) }), result.innerHTML = ` ${t}`;}) }) ;</script>
</div>
</div>
<br /><br /> Bagikan <a class="share-btn facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo canonical_url(); ?>">Facebook</a><a class="share-btn twitter" href="https://twitter.com/share?url=<?php echo canonical_url(); ?>&text=<?php echo $data['artist']; ?> - <?php echo $data['title']; ?>">Twitter</a>
</center></div></div>
<div class="nganan">
<div class="menu"><h3>Lagu <?php echo $data['artist']; ?> lainnya</h3>
<?php if ( $by_artist ) { ?>
<?php foreach ( $by_artist as $item ) { ?>
<div class="laguterkait"><a href="<?php echo post_permalink($item['slug']); ?>"> <?php echo $item['artist']; ?> - <?php echo $item['title']; ?> </a><br />
<span><?php echo timeline($item['date']); ?></span>
</div>
<?php } unset( $item ); ?>
<?php } ?>
</div></div></div></div>