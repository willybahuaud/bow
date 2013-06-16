<?php

//For security reasons, don't display any errors or warnings. Comment out in DEV.
error_reporting(E_ALL);
//start session
// session_start();

class flux {

// inclusion de la classe magpierss





    var $hostname_logon = 'localhost';      //Database server LOCATION
    var $database_logon = 'bow';       //Database NAME
    var $username_logon = 'root';       //Database USERNAME
    var $password_logon = '';       //Database PASSWORD
 
    //table fields
    var $user_table = 'users';          //Users table name
    var $user_column = 'useremail';     //USERNAME column (value MUST be valid email)
    var $pass_column = 'password';      //PASSWORD column
    var $user_level = 'userlevel';      //(optional) userlevel column
 
    //encryption
    var $encrypt = true;       //set to true to use md5 encryption for the password
 
    //connect to database
public function __construct()
   {
  
       $this->dbh = new PDO("mysql:host={$this->hostname_logon};dbname={$this->database_logon}",$this->username_logon,$this->password_logon);
   }
 



function read_flux($id_user){
	$sql_read = "SELECT flux.id as id_flux,url FROM flux JOIN subscriptions ON subscriptions.id_flux = flux.id WHERE id_user='$id_user'";
	$stmt = $this->dbh->query($sql_read);
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);


	foreach($row as $key=>$r){
		
		if(!@$fluxrss=simplexml_load_file($r['url'])){
		throw new Exception('Flux introuvable');
		}
		if(empty($fluxrss->channel->title) || empty($fluxrss->channel->description) || empty($fluxrss->channel->item->title))
		throw new Exception('Flux invalide');
		echo '<ul data-flux="'.$r['id_flux'].'">';
		echo '<h3>'.(string)$fluxrss->channel->title.'</h3>
		<p>'.(string)$fluxrss->channel->description.'</p>';

		$i = 0;
		$nb_affichage = 5;
		
		echo '<input type="button" class="delete" value="Delete">';
		foreach($fluxrss->channel->item as $item){
		echo '<li><a href="'.(string)$item->link.'">'.(string)$item->title.'</a> Posted at '.(string)date('Y/m/d - G\hi',strtotime($item->pubDate)).'</li>';
		if(++$i>=$nb_affichage)
		break;
		}
		echo '</ul>';
	}
	
return;

}

function add_flux($id_user,$url){

	$sql= $this->dbh->exec("INSERT INTO flux (id,url) VALUES('','$url')");

	if( ! $sql ){
           //flux existe ?
           $errorcode = $this->dbh->errorInfo();
           $errorcode = $errorcode[1];
           if( $errorcode == 1062 ){
           }
                }


    // ON RECUPERE L'ID DU FLUX INSERE
    $sql_id_flux = "SELECT id FROM flux WHERE url = '$url'";
    $stmt = $this->dbh->query($sql_id_flux);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$id_flux  = $row['id'];

	// ON RECUPERE L'ID USER 
	$sql_check_sub = "SELECT id_user FROM subscriptions WHERE id_flux='$id_flux'";
	$stmt = $this->dbh->query($sql_check_sub);
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	foreach($row as $key=>$r){
		if($id_user ==($r['id_user'])){
			return 'you are also abonned at this RSS';
			exit;
		}	
	}

    $sql2 = $this->dbh->exec("INSERT INTO subscriptions (id,id_flux,id_user) VALUES('','$id_flux', '$id_user')");



    return 'RSS Feed added with success !';
      

     
   }

 function remove_flux(){

 	$id_flux = $_POST['id'];
 	$sql_delete=  $this->dbh->exec("DELETE FROM flux WHERE id='$id_flux'");
 	$sql_delete2 = $this->dbh->exec("DELETE FROM subscriptions WHERE id_flux='$id_flux'");

 	return;

 }



}
?>