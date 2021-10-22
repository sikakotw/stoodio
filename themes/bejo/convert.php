<div class="wrapper-menu"><div class="menu top" style="border-radius:50px"><h3 class="title-class" align="center"><b><?php echo $result['title']; ?></b></h3></div></div>
<div class="wrapper"><div class="menu" align="center"><img style="border-radius:6px;" src="<?php echo $result['image']; ?>?resize=150,150"><br><br><b>Panduan :</b> Tunggu 3 detik hingga muncul tombol <b>DOWNLOAD MP3</b> > Klik > Initialize > Klik ulang tombol <b>DOWNLOAD MP3</b>
<br><br>
<b>↓↓↓↓ SERVER MP3 ↓↓↓↓</b><br>
<iframe id="myiframedl" src="//<?php echo $_SERVER["HTTP_HOST"]; ?>/mp3.php?link=<?php echo $result['id']; ?>" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="300" height="40"></iframe>
<br>↑↑↑↑↑↑↑↑
<br><br>
<b>↓↓↓↓ SERVER MP4 ↓↓↓↓</b><br>
<iframe id="myiframedl" src="//<?php echo $_SERVER["HTTP_HOST"]; ?>/mp4.php?link=<?php echo $result['id']; ?>" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="300" height="40"></iframe>
<br>↑↑↑↑↑↑↑↑