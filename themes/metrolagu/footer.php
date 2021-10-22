<?php if ( $route['name'] == 'download' || $route['name'] == 'post' || $route['name'] == 'home' ) { ?>
<script type="text/javascript">document.addEventListener("DOMContentLoaded",function(){var e=[].slice.call(document.querySelectorAll("img.lazy, iframe.lazy"));if("IntersectionObserver"in window){let t=new IntersectionObserver(function(e,n){e.forEach(function(e){if(e.isIntersecting){let n=e.target;n.src=n.dataset.src,n.classList.remove("lazy"),t.unobserve(n)}})});e.forEach(function(e){t.observe(e)})}else e.forEach(function(e,t){e.src=e.dataset.src,e.classList.remove("lazy")})});</script>
<?php }else{ ?>
<footer class="footer">
<div class="copyright">
<div class="container">
<div class="footercredits" align="center"><strong>Download Lagu Mp3 Terbaik <?php echo date( 'Y' );?>, GudangLagu Terbaru Gratis
Download Lagu Mp3 Terbaru <?php echo date( 'Y' );?>, STAFABAND. Gudang lagu Mp3 Indonesia, lagu barat terbaik.</strong><br>
<?php echo str_replace( [ '%year%', '%site_name%' ], [ date( 'Y' ), get_option( 'site_name' ) ], get_option( 'footer_copyright' ) ); ?></div>
</div>
</div>
</footer>
</div> 
</div></div>
<?php } ?>
</body>
</html>