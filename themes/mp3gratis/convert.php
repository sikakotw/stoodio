<div id="main">
  <div  style="background: #fff;margin: 10px 1%;box-shadow: 0 0 10px 0 rgb(0 0 0 / 16%);box-sizing: border-box;">
	<center>
	  <div class="bh-top"> <h1 class="ht"> Download lagu <?php echo $result['title']; ?> </h1></div>
	  <br><img class="aligncenter" src="<?php echo $result['image']; ?>?resize=180,180"><br>
	  <p class="alert alert-block btn-box alert-info"><b>Panduan :</b> Tunggu 3 detik hingga muncul tombol <b>DOWNLOAD MP3</b> > Klik > Initialize > Klik ulang tombol <b>DOWNLOAD MP3</b></p>
	  <br><b>↓↓↓↓ SERVER MP3 ↓↓↓↓</b><br>
	  <iframe id="myiframedl" src="//<?php echo $_SERVER["HTTP_HOST"]; ?>/mp3.php?link=<?php echo $result['id']; ?>" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="300" height="40"></iframe>
	  <br>↑↑↑↑↑↑↑↑<br><br>
	  <b>↓↓↓↓ SERVER MP4 ↓↓↓↓</b><br>
	  <iframe id="myiframedl" src="//<?php echo $_SERVER["HTTP_HOST"]; ?>/mp4.php?link=<?php echo $result['id']; ?>" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="300" height="40"></iframe>
	  <br>↑↑↑↑↑↑↑↑<br><br>
	</center>
  </div>
</div>