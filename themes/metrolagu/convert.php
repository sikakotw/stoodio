<div style="padding:10px">
<div class="text-center m-3"> <h1 class="text-xl"> Download lagu <?php echo $result['title']; ?> </h1></div>
<br><img class="aligncenter" src="<?php echo $result['image']; ?>?resize=180,180">
<center><br>
<p class="alert alert-block btn-box alert-info"><b>Panduan :</b> Tunggu 3 detik hingga muncul tombol <b>DOWNLOAD MP3</b> > Klik > Initialize > Klik ulang tombol <b>DOWNLOAD MP3</b></p>
<br>
<b>↓↓↓↓ SERVER MP3 ↓↓↓↓</b><br>
<iframe id="myiframedl" src="//<?php echo $_SERVER["HTTP_HOST"]; ?>/mp3.php?link=<?php echo $result['id']; ?>" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="300" height="40"></iframe>
<br>↑↑↑↑↑↑↑↑
<br><br>
<b>↓↓↓↓ SERVER MP4 ↓↓↓↓</b><br>
<iframe id="myiframedl" src="//<?php echo $_SERVER["HTTP_HOST"]; ?>/mp4.php?link=<?php echo $result['id']; ?>" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="300" height="40"></iframe>
<br>↑↑↑↑↑↑↑↑
<br><br>
</div>