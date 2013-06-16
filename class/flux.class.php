<?php

//For security reasons, don't display any errors or warnings. Comment out in DEV.
error_reporting(E_ALL);
//start session
// session_start();

class flux {





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
 

function read_flux($table,$id,$url){

}

function add_flux($url,$id_user){

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

	$id_user = 1;
	foreach($row as $key=>$r){
		if($id_user ==($r['id_user'])){
			return 'you are also abonned at this RSS';
			exit;
		}	
	}

    $sql2 = $this->dbh->exec("INSERT INTO subscriptions (id,id_flux,id_user) VALUES('','$id_flux', 1)");



    return 'RSS Feed added with success !';
      

     
   }


}
?>