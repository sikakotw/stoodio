<?php
$title_panel = 'Wipe Cache';
require 'includes/header.php';
if (isset($_SESSION['login']) && $_SESSION['login'] == $hash) { ?>
<div class="container-fluid">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Wipe Cache</h1>
</div>
<?php if(isset($_GET['home'])){ ?>
<?php
if ( file_exists( '../store/' . $_SERVER['HTTP_HOST'] . '/cache/home' ) ) {
$files = glob('../store/' . $_SERVER['HTTP_HOST'] . '/home/*');
foreach($files as $file){
if ( is_file( $file ) ) {
unlink($file);
header('location: cache.php');
}}
}else{
$files = glob('../store/default/cache/home/*');
foreach($files as $file){
if ( is_file( $file ) ) {
unlink($file);
header('location: cache.php');
}}
}
?>
<?php } elseif(isset($_GET['search'])){ ?>
<?php
if ( file_exists( '../store/' . $_SERVER['HTTP_HOST'] . '/cache/search' ) ) {
$files = glob('../store/' . $_SERVER['HTTP_HOST'] . '/search/*');
foreach($files as $file){
if ( is_file( $file ) ) {
unlink($file);
header('location: cache.php');
}}
}else{
$files = glob('../store/default/cache/search/*');
foreach($files as $file){
if ( is_file( $file ) ) {
unlink($file);
header('location: cache.php');
}}
}
?>
<?php } elseif(isset($_GET['download'])){ ?>
<?php
if ( file_exists( '../store/' . $_SERVER['HTTP_HOST'] . '/cache/downloads' ) ) {
$files = glob('../store/' . $_SERVER['HTTP_HOST'] . '/downloads/*');
foreach($files as $file){
if ( is_file( $file ) ) {
unlink($file);
header('location: cache.php');
}}
}else{
$files = glob('../store/default/cache/downloads/*');
foreach($files as $file){
if ( is_file( $file ) ) {
unlink($file);
header('location: cache.php');
}}
}
?>
<?php } else { ?>
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-body text-center">
<a class="btn btn-danger" href="cache.php?home" <?php echo 'onclick="javascript: return confirm(\'Delete cache home?\')"';?> data-toggle="tooltip" title="Delete">Delete Cache Home</a><br><br>
<a class="btn btn-danger" href="cache.php?download" <?php echo 'onclick="javascript: return confirm(\'Delete cache download?\')"';?> data-toggle="tooltip" title="Delete">Delete Cache Download</a><br><br>
<a class="btn btn-danger" href="cache.php?search" <?php echo 'onclick="javascript: return confirm(\'Delete cache search?\')"';?> data-toggle="tooltip" title="Delete">Delete Cache Search</a>
</div>
</div></div></div>
<?php 
}
echo'</div>';
require 'includes/footer.php';
}else{
header('Location: login.php');
}?>