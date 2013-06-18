<?php
require_once("../class/users.class.php");
require_once('../class/flux.class.php');
include_once("header.php");
$log = new logmein();

if( ! $log->is_user_connected()){
    die ('U R no connected U no ?');
}

echo "<form action='' method='post'>
<label>Add RSS feed : <input type='url' name='url'></label>
<input type='submit' value='submit'>
</form>";

if(isset($_POST['url'])){
	$f = new flux();  
echo $f->add_flux($log->get_user_infos('userid'),$_POST['url']);

}

echo "<a href='view_flux.php'>See RSS feed</a>";
?>
