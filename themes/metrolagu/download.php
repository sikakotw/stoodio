<div class="ngiri">
<div class="menu">
<center>
<table width="100%">
<tr><td width="150px"><img class="lazy" width="150px" src="/themes/metrolagu/images/blank.jpg" data-src="<?php echo $result['image']; ?>"></td>
<td valign="top" style="padding-left:10px">
<b><?php echo $result['title']; ?></b> <br />
Sample Rate: 48kHz<br />
Audio Channels: Stereo
<br />
</td></tr>
</table>
</center>
<br /><center>
<audio src="https://www.youtube.com/watch?v=<?php echo $result['id']; ?>" type="video/youtube" controls style="width: 100%">Your browser does not support the audio element</audio>
<br />
<br />
<a style="width:auto;" href="<?php echo convert_permalink($result['id']); ?>" class="download-album" rel="nofollow noopener noreferrer"> Download MP3 </a>
<br />
<br /><br />
<div class="lirik" align="center">Jika link download error/muncul iklan, coba sekali lagi :p<br /><br />

</div>
<br /><br /> Bagikan <a class="share-btn facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo canonical_url(); ?>">Facebook</a><a class="share-btn twitter" href="https://twitter.com/share?url=<?php echo canonical_url(); ?>&text=<?php echo $result['title']; ?>">Twitter</a>
</center></div></div>
<div class="nganan">
<div class="menu"><h3>Related</h3>
<?php if ( $related ) { ?>
<?php foreach ( $related as $item ) { ?>
<div class="laguterkait"><a href="<?php echo download_permalink( $item['title'], '--' . $item['id'] ); ?>"> <?php echo $item['title']; ?> </a><br />
<span><?php echo $item['date']; ?></span>
</div>
<?php } unset( $item ); ?>
<?php } ?>
</div></div></div></div>