<div class="wrapper"><div class="menu top"><div class="img-flex" style="margin:0 10px 10px 0"><img src="<?php echo $result['image']; ?>?resize=80,80"/></div><h1><?php echo str_replace( '%title%', $result['title'], get_option( 'download_page_title' ) ); ?></h1><div class="small"><i>Upload on <?php echo timeline($result['date']); ?></i></div></div></div><div class="wrapper"><div class="kiri"><div class="menu"><h3 class="title-class">File Info</h3><p> Channel: <b><?php echo $result['channel']; ?></b></p><p> Title: <b><?php echo $result['title']; ?></b></p><p> Album: <b>-</b></p><p> Genre: <b>-</b></p><p> Released: <b><?php echo $result['date']; ?></b></p><p> Size: <b><?php echo $result['size']; ?></b></p><p> Duration: <b><?php echo $result['duration']; ?></b></p><br><div id="playing" align="center"><p style="padding:0 0 10px;"><a class="download" href="<?php echo convert_permalink($result['id']); ?>" rel="nofollow noopener noreferrer">Download MP3</a><br></p></div></div><div class="menu"><h3 class="title-class">Lirik lagu <?php echo $result['title']; ?></h3><div id="search-result"><script> let query = "<?php echo $result['title']; ?>"; </script> <script> let result = document.getElementById("search-result"); function showCard(e) { return `${e.lyric}`; } document.addEventListener("DOMContentLoaded", function() { fetch("/grab/lyric.php?s=" + query).then((response) => { if (response.ok) { return response.json(); } else { console.log(response); return result.innerHTML = ` <h2 class="judul"> OOpss.. </h2> Ada masalah dengan pencarian <br/> "<strong>${query}</strong>" <br/> Error ${response.status} ${response.statusText}<br/> <h2 class="judul"> Cari dengan pencarian lain <</h2> `; } }).then(e => { t = "", e.forEach(e => { t += showCard(e) }), result.innerHTML = ` ${t}`;}) }) ;</script></div></div></div><div class="kanan"><div class="menu"><?php if ( $related ) { ?><h3 class="title-class">Related</h3><?php foreach ( $related as $item ) { ?><div class="track"><div class="img-flex"></div><div class="item-flex"><h3 class="title"><a href="<?php echo download_permalink( $item['title'], '--' . $item['id'] ); ?>" title="<?php echo htmlentities( $item['title'], ENT_QUOTES ); ?> mp3 lyrics"><?php echo $item['title']; ?></a></h3><div class="small"><span><?php echo timeline($item['date']); ?></span></div></div></div><?php } unset( $item ); ?><?php } ?></div></div><div class="clear"></div></div>