<?php
$title_panel = 'Multi Posts';
require 'includes/header.php';

require '../config/init.php';

require '../core/functions/general.php';
require '../core/uri.php';
require '../core/router.php';
require '../libraries/ua.class.php';
require '../libraries/simple_html_dom.php';
require '../core/functions/options.php';
require '../core/functions/cache.php';
require '../core/functions/permalinks.php';
require '../core/functions/common.php';
require '../core/functions/site.php';

if (isset($_SESSION['login']) && $_SESSION['login'] == $hash) { ?>
<?php if(isset($_GET['create'])){?>
<div class="container-fluid">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Multi Posts</h1>
</div>
<div class="row">
<div class="col-md-12">
<div class="card">
<form method="post" action=""><center>
<div class="card-body">
<div class="form-group">
<div class="col-md-6">
<div class="input-group">
<input type="text" name="q" class="form-control bg-light border-0" placeholder="Search artist/music for inject...">
<input class="form-control bg-light border-0" style="flex: 0;width:80px!important;display:inline-block;" type="number" name="limit" value="10">
<div class="input-group-append">
<button class="btn btn-primary" type="submit">
<i class="fas fa-search fa-sm"></i>
</button>
</div>
</div>
</div>
</div>
</div>
</center></form>
<div class="card-body" id="search-result">
<script> let query = "<?php echo $_POST['q'];?>"; </script> <script> let result = document.getElementById("search-result"); function showCard(e) { return `
${e.artist} - ${e.title}<br>`; } document.addEventListener("DOMContentLoaded", function() { fetch("/grab/inject.php?s=<?php echo $_POST['q'];?>&l=<?php echo $_POST['limit'];?>").then((response) => { if (response.ok) { return response.json(); } else { console.log(response); return result.innerHTML = ` <h2 class="judul"> OOpss.. </h2> Ada masalah dengan pencarian <br/> "<strong>${query}</strong>" <br/> Error ${response.status} ${response.statusText}<br/> <h2 class="judul"> Cari dengan pencarian lain <</h2> `; } }).then(e => { t = "", e.forEach(e => { t += showCard(e) }), result.innerHTML = ` ${t}`;}) }) ;</script>
</div>
<div class="card-footer">
<a class="btn btn-danger" href="posts.php">Back</a>
</div>
</div>
</div>
</div>
<?php } elseif(isset($_GET['delete'])){ ?>
<?php
$delete = $_GET['delete'];
if ( file_exists( '../store/' . $_SERVER['HTTP_HOST'] . '/inject/'.$delete.'' ) ) {
$file = '../store/' . $_SERVER['HTTP_HOST'] . '/inject/'.$delete.'';
if ( file_exists( $file ) ) {
unlink('../store/' . $_SERVER['HTTP_HOST'] . '/inject/'.$delete.'');
header('location: posts.php');
}else{
echo'<script>
 alert("Page not found!");
</script>';
}
}else{
$file = '../store/default/inject/'.$delete.'';
if ( file_exists( $file ) ) {
unlink('../store/default/inject/'.$delete.'');
header('location: posts.php');
}else{
echo'<script>
 alert("Page not found!");
</script>';
}
}
?>
<?php } elseif(isset($_GET['reset'])){ ?>
<?php
if ( file_exists( '../store/' . $_SERVER['HTTP_HOST'] . '/inject' ) ) {
$files = glob('../store/' . $_SERVER['HTTP_HOST'] . '/inject/*');
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
	header('location: posts.php');
}
}else{
$files = glob('../store/default/inject/*');
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
	header('location: posts.php');
}
}
?>
<?php } elseif(isset($_GET['update'])){ ?>

<?php
$delete = $_GET['delete'];
if ( file_exists( '../store/' . $_SERVER['HTTP_HOST'] . '/cache/home/home-post.json' ) ) {
$file = '../store/' . $_SERVER['HTTP_HOST'] . '/cache/home/home-post.json';
if ( file_exists( $file ) ) {
unlink('../store/' . $_SERVER['HTTP_HOST'] . '/cache/home/home-post.json');
header('location: posts.php');
}else{
echo'<script>
 alert("Tidak ada yang diupdate!");
</script>';
}
}else{
$file = '../store/default/cache/home/home-post.json';
if ( file_exists( $file ) ) {
unlink('../store/default/cache/home/home-post.json');
header('location: posts.php');
}else{
echo'<script>
 alert("Tidak ada yang diupdate!");
</script>';
}
}
?>
<?php } else { ?>
<div class="container-fluid">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Multi Posts</h1>
</div>
<?php
if ( file_exists( '../store/' . $_SERVER['HTTP_HOST'] . '/inject' ) ) {
$folder = '../store/' . $_SERVER['HTTP_HOST'] . '/inject';
}else{
$folder = '../store/default/inject';
}
chdir($folder);
array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_DESC, $files);
?>
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<a class="btn btn-primary" href="?create">Create</a>
<a class="btn btn-success" href="?update" <?php echo 'onclick="javascript: return confirm(\'Update Homepage data?\')"';?>>Update Homepage</a>
<a class="btn btn-danger" href="?reset" <?php echo 'onclick="javascript: return confirm(\'Clear all data?\')"';?>>Clear</a>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>No</th>
<th>Title</th>
<th>Album</th>
<th>Genre</th>
<th>Published</th>
<th>Action</th>
</tr>
</thead>
<tfoot>
<tr>
<th width="1%">No</th>
<th>Title</th>
<th>Album</th>
<th>Genre</th>
<th>Published</th>
<th>Action</th>
</tr>
</tfoot>
<tbody>
<?php
$i = 0;
foreach($files as $filename) {
$i++;
if ( file_exists( $filename ) ) {
$data = json_decode( file_get_contents( $filename ), true );
}
?>
<tr>
<td><?php echo $i; ?></td>
<td><b><i><?php echo $data['artist']; ?></i></b> - <?php echo $data['title']; ?></td>
<td><?php echo $data['album']; ?></td>
<td><?php echo $data['genre']; ?></td>
<td><?php echo timeline($data['added']); ?></td>
<td><center><a href="?delete=<?php echo $filename; ?>" <?php echo 'onclick="javascript: return confirm(\'Delete post '.$data["artist"].' - '.$data["title"].'?\')"';?> data-toggle="tooltip" title="Remove">
<i class="fas fa-times"></i>
</a></center></td>
</tr>

<?php } ?>
</tbody>
</table>
</div>
</div>

</div>
</div>
</div>
</div>
<?php } ?>
</div>
<?php 
require 'includes/footer.php';
}else{
header('Location: login.php');
}?>