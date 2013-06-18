<?php

//http://www.emirplicanic.com/php/simple-phpmysql-authentication-class

//For security reasons, don't display any errors or warnings. Comment out in DEV.
// error_reporting(0);
class logmein {

    public function __construct() {
        session_start();
        require_once( realpath( dirname( dirname( __FILE__ ) ) ) . '/connect.php' );
        $sql = new sql();
        $this->dbh = new PDO( "mysql:host={$sql->hostname};dbname={$sql->database}", $sql->username, $sql->password );
        $this->salt = $sql->salt;

        // try to connect
        $this->try_to_connect_user();
    }

 
    //login function
    function login( $username, $password ) {

        $password = md5( $this->salt . $password );

        $result = $this->dbh->prepare( "SELECT * FROM users WHERE useremail = ? AND password = ?" );
        $result->execute( array( $username, $password ) );
        $user = $result->fetch(PDO::FETCH_OBJ);

        if( $user ) {

            $_SESSION['gleenruser'] = (array) $user;
            $key = sha1( $user->useremail . $user->password . $_SERVER['REMOTE_ADDR'] );
            if( isset( $_POST[ 'remember' ] ) )
                $this->setcookieuser( $user->userid, $key, 86400 * 3 );

            return true;
        }else{
            session_destroy();
            return false;
        }
    }
 
    //logout function
    function logout() {
        $this->setcookieuser( $user->userid, '', -1 );
        session_destroy();
        return;
    }
 
 
    //login form
    function loginform( $formname, $formclass, $formaction ) {
        echo'<form name="'.$formname.'" method="post" id="'.$formname.'" class="'.$formclass.'" enctype="application/x-www-form-urlencoded" action="'.$formaction.'">
                <input type="email" class="input-text" placeholder="email" name="username">
                <input name="action" id="action" value="login" type="hidden">
                <input type="password" class="input-text" placeholder="password" name="passwd">
                <input type="checkbox" id="remember" class="" value="1" name="remember"> <label for="remember">Remember me</label>
                <input type="submit" value="Log in">
            </form>';
    }

    function createuser( $email, $passwd ) {
        $passwd = md5( $this->salt . $passwd );
        
        $result = $this->dbh->prepare("INSERT INTO users ( useremail, password, userlevel) VALUES ( ?, ?, 1 )");
        $result->execute( array( $email, $passwd ) );
        // var_dump($result);
        //erreur ?
        if( ! $result ){
            //utilisateur existe ?
            $errorcode = $this->dbh->errorInfo();
            $errorcode = $errorcode[1];
            if( $errorcode == 1062 )
                return 'exist';
            else {
                var_dump($this->dbh->errorInfo());
                return 'pb';
            }
        }

        //sinon ok :-)
        // $this->mail_to_user($this->dbh->lastInsertId(), 'Welcome to Gazr', 'You just subscribe a Gazr account');
        return 'success';
    }

    function registerform($formname, $formclass, $formaction){
        echo'
        <form name="'.$formname.'" method="post" id="'.$formname.'" class="'.$formclass.'" enctype="application/x-www-form-urlencoded" action="'.$formaction.'">
            <input type="email" class="input-text" placeholder="email" name="useremail">
            <input name="action" id="action" value="join" type="hidden">
            <input type="password" class="input-text" placeholder="password" name="passwd">
            <input type="submit" value="Join">
        </form> 
        ';
    }

    function try_to_connect_user() {
        if( isset( $_COOKIE[ 'gleenrauth' ] ) && ! isset( $_SESSION[ 'gleenruser' ] ) ) {
            $auth = $_COOKIE[ 'gleenrauth' ];
            $auth = explode( '-->', $auth );
            $user = $this->get_user_infos();
            $key  = sha1( $user->useremail . $user->password . $_SERVER['REMOTE_ADDR'] );
            if( $key = $auth[1] ) {
                $_SESSION[ 'gleenruser' ] = (array) $user;
                $this->setcookieuser( $user->userid, $key, 86400 * 3 );
            } else
                $this->setcookieuser( $user->userid, '', -1 );
        } elseif( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] == 'login')
            $this->login( $_POST[ 'username' ], $_POST[ 'passwd' ] );
    }

    function setcookieuser( $id, $cle ,$time ) {
        setcookie('gleenrauth', $id .'-->'. $cle, time() + $time, '/', 'localhost', false, true );
    }

    function is_user_connected() {
        if( isset( $_SESSION[ 'gleenruser' ][ 'userid' ] ) )
            return true;
        else
            return false;
    }

    function get_user_infos( $field = false ){
        if( $this->is_user_connected() ) {
            $id = $_SESSION[ 'gleenruser' ][ 'userid' ];
            $fields = $this->dbh->prepare( "SELECT * FROM users WHERE userid = ?" );
            $fields->execute( array( $id ) );
            $fields = $fields->fetch(PDO::FETCH_OBJ);
            if( false !== $field )
                return $fields->$field;
            else
                return $fields;
        } else return false;
    }

    function profile_form(){
        $infos = $this->get_user_infos();
        echo '<form action="" method="post">';
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

    function mail_to_user( $id_user, $subject, $message ) {
        //retrieve user mail
        $email = $this->dbh->prepare( "SELECT useremail FROM users WHERE userid = ?" );
        $email->execute( array( $id_user ) );
        $email = $email->fetch(PDO::FETCH_ASSOC);

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Gazr <noreplay@gazr.com>'. "\r\n";
        $send = @mail( $email[ 'useremail' ], $subject, $message, $headers );
        return $send;
    }
}
?>