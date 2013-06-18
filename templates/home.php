<?php 
include_once('header.php');
require_once("class/users.class.php");
$log = new logmein(); ?>
<body>
    <div class="topbar">
        <a href="" class="logo">
            <img src="assets/img/gazr.png" alt="">
        </a>
        <div class="login-box">         
            <?php 
            if( ! $log->is_user_connected() )
                $log->loginform('','login-form', '');
            else{
                $infos = $log->get_user_infos();
                echo sprintf( '<p class="hello-world">Welcome her %s</p>', $infos['useremail']);
                echo '<button type="button" id="logout">Se déconnecter</button>';
            }
            ?>
        </div>
    </div>
    <section class="content">
        <?php if( ! $log->is_user_connected() ) { ?>
        <article  class="register-box">
            <h2>Join gleenr now!</h2>
            <?php $log->registerform('','register-form', 'validate_user.php'); ?>
            <div class="article-separator"><span>Or</span></div>
            <ul class="register-socials">
                <li><a href="" class="login-facebook"></a></li>
                <li><a href="" class="login-twitter"></a></li>
                <li><a href="" class="login-google"></a></li>
            </ul>
        </article>
        <article class="article-content">
            <header>
                <h1>What's gleenr ?</h1>
            </header>
            <p>Jedi master Darth Vader the Force is strong with this one protocol droid Coruscant Lando Calrissian. Dantooine the Force Jabba the Hutt these aren't the droids you're looking for I find your lack of faith disturbing. Tatooine battle of Yavin Millenium Falcon scoundrel tie fighter. Apprentice empire who you calling scruffy-looking aren't you a little short for a stormtrooper. Star destroyer Luke Skywalker garbage compactor. Ewok X-Wing Master Yoda sith lord it's a trap Corellian ship.</p>
        </article>
        <?php } else {

         echo '<article class="article-content">';
            require_once('class/flux.class.php');
            $f = new flux();  
            echo $f->read_flux($_SESSION['id_user']);
            echo "<a href='add_flux.php'>Add RSS feed</a>";
        echo ' </article>';
         } ?>
    </section>
</body>
</html>