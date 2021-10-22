<div class="clear"></div>
<?php if ( $route['name'] == 'home' ) { ?>
<div class="yts">
  <font color="red" size="4"><b>&nbsp;Search</b></font>
  <div class="search">
	<form id="qr" action="<?php echo site_url(); ?>" method="get">
	  <input id="q" type="text" name="search" placeholder="Masukkan nama video..." autocomplete="off" />
	  <button type="submit" class="search_btn">CARI</button>
	</form>
	<i class="search_arrow"></i>
 </div>
</div>
<br>
<?php } ?>
<div id="footer">
  <div class="center"> 
	<h3 class="f15">Situs download lagu, download lagu mp3, download lagu terbaru gratis dan lengkap</h3>
	<p align="center"><b><a href="/"><?php echo get_option( 'site_name' ); ?></a></b> adalah situs <i><u>Download lagu,</u></i>, <b>download lagu mp3,</b> Download mp3 gratis berkualitas, situs download lagu terlengkap, <i><u>situs mp3 lagu</u></i> terbesar untuk anda.</p>
	<br>
	<br />
	<p class="center">
	  <a href="#" style="color:blue">Disclaimers</a> | <a href="#" style="color:blue">Terms</a> | <a href="#" style="color:blue">Privacy</a> | <a href="#" style="color:blue">About Us</a>
	  <br /><br />
	  <?php echo str_replace( [ '%year%', '%site_name%' ], [ date( 'Y' ), get_option( 'site_name' ) ], get_option( 'footer_copyright' ) ); ?>
	</p>
  </div>
  <div id="uptop">
	<a href="#"><span class="up_arrow"></span>Top</a>
  </div>
</body>
</html>