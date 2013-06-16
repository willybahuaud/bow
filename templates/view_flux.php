<?php
require_once("../class/users.class.php");
require_once('../class/flux.class.php');
include_once("header.php");
$log = new logmein();

if( ! isset( $_SESSION['loggedin'] ) || $log->logincheck($_SESSION['loggedin'], "users", "passwd", "useremail") == false){
    die ('U R no connected U no ?');
}

$f = new flux();  
echo $f->read_flux($_SESSION['id_user']);
echo "<a href='add_flux.php'>Add RSS feed</a>";

?>
<script>
jQuery(document).ready(function($){


$(document).on('click','.delete',function(){


var id_flux = $('ul').attr('data-flux');

$.ajax({
   type: "POST",
   url: "../ajax_requests.php",
   data: "id="+id_flux,
   success: function(msg){
     $('ul[data-flux="'+id_flux+'"]').remove();
   }
 });

});

});
</script>