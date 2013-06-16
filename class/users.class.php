<?php

//http://www.emirplicanic.com/php/simple-phpmysql-authentication-class

//For security reasons, don't display any errors or warnings. Comment out in DEV.
// error_reporting(0);
//start session
session_start();
class logmein {

    //database setup
       //MAKE SURE TO FILL IN DATABASE INFO
    var $hostname_logon = 'localhost';      //Database server LOCATION
    var $database_logon = 'bow';       //Database NAME
    var $username_logon = 'root';       //Database USERNAME
    var $password_logon = '';       //Database PASSWORD
 
    //table fields
    var $user_table  = 'users';          //Users table name
    var $user_column = 'useremail';     //USERNAME column (value MUST be valid email)
    var $pass_column = 'password';      //PASSWORD column
    var $user_level  = 'userlevel';      //(optional) userlevel column
 
    //encryption
    var $encrypt = true;       //set to true to use md5 encryption for the password
 

    public function __construct()
    {
        $this->dbh = new PDO("mysql:host={$this->hostname_logon};dbname={$this->database_logon}",$this->username_logon,$this->password_logon);
    }

 
    //login function
    function login($table, $username, $password){

        //make sure table name is set
        if($this->user_table == ""){
            $this->user_table = $table;
        }
        //check if encryption is used
        if($this->encrypt == true){
            $password = md5($password);
        }
        //execute login via qry function that prevents MySQL injections
        $result = $this->dbh->query("SELECT * FROM users WHERE useremail = '$username' AND password = '$password'");
        $row = $result->fetch(PDO::FETCH_ASSOC);

        if($row['useremail'] !="" && $row['password'] !=""){
            //register sessions
            //you can add additional sessions here if needed
            $_SESSION['loggedin'] = $row['password'];
            //userlevel session is optional. Use it if you have different user levels
            $_SESSION['userlevel'] = $row['userlevel'];
            $_SESSION['id_user'] = $row['userid'];
            return true;
        }else{
            session_destroy();
            return false;
        }
    }
 
    //prevent injection
    function qry($query) {
      $this->dbconnect();
      $args  = func_get_args();
      $query = array_shift($args);
      $query = str_replace("?", "%s", $query);
      $args  = array_map('mysql_real_escape_string', $args);
      array_unshift($args,$query);
      $query = call_user_func_array('sprintf',$args);
      $result = mysql_query($query) or die(mysql_error());
          if($result){
            return $result;
          }else{
             $error = "Error";
             return $result;
          }
    }
 
    //logout function
    function logout(){
        session_destroy();
        return;
    }
 
    //check if loggedin
    function logincheck($logincode, $user_table, $pass_column, $user_column){

        //make sure password column and table are set
        if($this->pass_column == ""){
            $this->pass_column = $pass_column;
        }
        if($this->user_column == ""){
            $this->user_column = $user_column;
        }
        if($this->user_table == ""){
            $this->user_table = $user_table;
        }
        //exectue query
        $result = $this->dbh->query("SELECT COUNT(*) FROM ".$this->user_table." WHERE ".$this->pass_column." = ' $logincode'");
        $rownum = count($result);
        // var_dump($rownum);
        // $rownum = mysql_num_rows($result);
        // //return true if logged in and false if not
        // if($row != "Error"){
            if($rownum > 0){
                return true;
            }else{
                return false;
            }
        // }
    }
 
    //reset password
    function passwordreset($username, $user_table, $pass_column, $user_column){
        //conect to DB
        $this->dbconnect();
        //generate new password
        $newpassword = $this->createPassword();
 
        //make sure password column and table are set
        if($this->pass_column == ""){
            $this->pass_column = $pass_column;
        }
        if($this->user_column == ""){
            $this->user_column = $user_column;
        }
        if($this->user_table == ""){
            $this->user_table = $user_table;
        }
        //check if encryption is used
        if($this->encrypt == true){
            $newpassword_db = md5($newpassword);
        }else{
            $newpassword_db = $newpassword;
        }
 
        //update database with new password
        $qry = "UPDATE {$this->user_table} SET {$this->pass_column} = '{$newpassword_db}' WHERE {$this->user_column} = '" . stripslashes($username) . "'";
        $result = mysql_query($qry) or die(mysql_error());
 
        $to = stripslashes($username);
        //some injection protection
        $illegals=array("%0A","%0D","%0a","%0d","bcc:","Content-Type","BCC:","Bcc:","Cc:","CC:","TO:","To:","cc:","to:");
        $to = str_replace($illegals, "", $to);
        $getemail = explode("@",$to);
 
        //send only if there is one email
        if(sizeof($getemail) > 2){
            return false;
        }else{
            //send email
            $from = $_SERVER['SERVER_NAME'];
            $subject = "Password Reset: ".$_SERVER['SERVER_NAME'];
            $msg = "
 
Your new password is: ".$newpassword."
 
";
 
            //now we need to set mail headers
            $headers = "MIME-Version: 1.0 rn" ;
            $headers .= "Content-Type: text/html; \r\n" ;
            $headers .= "From: $from  \r\n" ;
 
            //now we are ready to send mail
            $sent = mail($to, $subject, $msg, $headers);
            if($sent){
                return true;
            }else{
                return false;
            }
        }
    }
 
    //create random password with 8 alphanumerical characters
    function createPassword() {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;
        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        return $pass;
    }
 
    //login form
    function loginform($formname, $formclass, $formaction){
        //conect to DB
        echo'
<form name="'.$formname.'" method="post" id="'.$formname.'" class="'.$formclass.'" enctype="application/x-www-form-urlencoded" action="'.$formaction.'">
<div><label for="username">Username</label>
<input name="username" id="username" type="text"></div>
<div><label for="password">Password</label>
<input name="passwd" id="passwd" type="password"></div>
<input name="action" id="action" value="login" type="hidden">
<div>
<input name="submit" id="submit" value="Login" type="submit"></div>
</form>
 
';
    }
    //reset password form
//     function resetform($formname, $formclass, $formaction){
//         //conect to DB
//         $this->dbconnect();
//         echo'
// <form name="'.$formname.'" method="post" id="'.$formname.'" class="'.$formclass.'" enctype="application/x-www-form-urlencoded" action="'.$formaction.'">
// <div><label for="username">Username</label>
// <input name="username" id="username" type="text"></div>
// <input name="action" id="action" value="resetlogin" type="hidden">
// <div>
// <input name="submit" id="submit" value="Reset Password" type="submit"></div>
// </form>
 
// ';
//     }

    function createuser($email,$passwd){
        $passwd = md5( $passwd );
        
        $result = $this->dbh->exec("INSERT INTO users (userid, useremail, password, userlevel) VALUES ('','$email', '$passwd', 1)");
        // var_dump($result);
        //erreur ?
        if( ! $result ){
            //utilisateur existe ?
            $errorcode = $this->dbh->errorInfo();
            $errorcode = $errorcode[1];
            if( $errorcode == 1062 )
                return 'exist';
            else{
                var_dump($this->dbh->errorInfo());
                return 'pb';
            }
        }

        //sinon ok :-)
        $this->mail_to_user($this->dbh->lastInsertId(), 'Welcome to Gazr', 'You just subscribe a Gazr account');
        return 'success';
    }

    function registerform($formname, $formclass, $formaction){
        echo'
        <form name="'.$formname.'" method="post" id="'.$formname.'" class="'.$formclass.'" enctype="application/x-www-form-urlencoded" action="'.$formaction.'">
        <div><label for="username">email</label>
        <input name="useremail" id="useremail" type="email"></div>
        <div><label for="passwd">Passwd</label>
        <input name="passwd" id="passwd" type="passwd"></div>
        <div><input name="submit" id="submit" value="Reset Password" type="submit"></div>
        </form>
         
        ';
    }

    function is_user_connected(){
        if( ! isset( $_SESSION['loggedin'] ) || $this->logincheck($_SESSION['loggedin'], "users", "passwd", "useremail") == false)
            return false;
        else
            return true;
    }

    function get_user_infos(){
        if( isset( $_SESSION['id_user'] ) ) {
            $fields = $this->dbh->query("SELECT * FROM {$this->user_table} WHERE userid = {$_SESSION['id_user']}");
            return $fields->fetch(PDO::FETCH_ASSOC);
        }
    }

    function profile_form(){
        $infos = $this->get_user_infos();
        echo '<form action="" method="post">';
        var_dump($infos);
        foreach($infos as $k => $info) {
            switch($k){
                case 'useremail':
                    echo '<div><label for="email">Email</label>';
                    echo '<input type="email" name="email[0]" value="'.$info.'">';
                    echo '<input type="email" name="email[1]">';
                    echo '</div>';
                    break;
                case 'password':
                    echo '<div><label for="password">Password</label>';
                    echo '<input type="password" name="password[0]">';
                    echo '<input type="password" name="password[1]">';
                    echo '</div>';
                    break;
                case 'name':
                    echo '<div><label for="name">Name</label>';
                    echo '<input type="text" name="name" value="'.$info.'">';
                    echo '</div>';
                    break;
                case 'first_name':
                    echo '<div><label for="first_name">First name</label>';
                    echo '<input type="text" name="firstname" value="'.$info.'">';
                    echo '</div>';
                    break;
                case 'last_name':
                    echo '<div><label for="last_name">Lastname</label>';
                    echo '<input type="text" name="lastname" value="'.$info.'">';
                    echo '</div>';
                    break;
                case 'indice':
                    break;
                default:
            }
        }
        echo '<input type="submit" value="Update profile">';
        echo '</form>';
    }

    function mail_to_user($id_user, $subject, $message){
        //retrieve user mail
        $email = $this->dbh->query("SELECT useremail FROM users WHERE userid = '$id_user'");
        $email = $email->fetch(PDO::FETCH_ASSOC);

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Gazr <noreplay@gazr.com>'. "\r\n";
        $send = @mail( $email['useremail'], $subject, $message, $headers );
        return $send;
    }
}
?>