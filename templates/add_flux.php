<?php
require_once('../class/flux.class.php');


echo "<form action='' method='post'>
<label>Add RSS feed : <input type='text'name='url'></label>
<input type='submit' value='submit'>
</form>";

if(isset($_POST['url'])){
	$f = new flux();  
echo $f->add_flux( $_POST['url']);

}
?>
