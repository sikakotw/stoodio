<?php if (isset($_SESSION['login']) && $_SESSION['login'] == $hash) { ?>
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php?logout=true">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Changelog Modal-->
  <div class="modal fade" id="changelogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">BejoLite Changelogs</h5>
        </div>
        <div class="modal-body">
		<b>Changelog version 1.3</b><br/>
	- Add total inject<br/>
	- Add Wipe Cache<br/>
	- Add more themes dan delete old themes<br/>
	- Delete junk files<br/>
	- Fix sime bugs<br/>
	<b>Changelog version 1.2</b><br/>
	- Semi AGC <br/>
    - Support Nginx <br/>
    - Ajax loader search <br/>
	- Spintax <br/>
	- Widget Playlist <br/>
	- Move downloader into theme <br/>
	- Add more themes <br/>
    - Fix some bugs <br/>
    <b>Changelog version 1.0</b><br/>
		- Release </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="//cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="//startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="/assets/js/sb-admin-2.min.js"></script>
  <!-- Page level plugins -->
  <script src="//startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="//startbootstrap.github.io/startbootstrap-sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Page level custom scripts -->
  <script src="/assets/js/demo/datatables-demo.js"></script>
<?php }else{ ?>
</div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="//cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/assets/js/sb-admin-2.min.js"></script>
<?php } ?>
</body>
</html>