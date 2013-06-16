<?php
require_once('../class/flux.class.php');
include("../class/users.class.php");
include_once("header.php");
$log = new logmein();

if( ! isset( $_SESSION['loggedin'] ) || $log->logincheck($_SESSION['loggedin'], "users", "passwd", "useremail") == false){
    die ('U R no connected U no ?');
}

echo "<form action='' method='post'>
<label>Add RSS feed : <input type='url' name='url'></label>
<input type='submit' value='submit'>
</form>";

if(isset($_POST['url'])){
	$f = new flux();  
echo $f->add_flux($_SESSION['id_user'],$_POST['url']);

}

echo "<a href='view_flux.php'>See RSS feed</a>";
?>
