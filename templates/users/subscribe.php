<?php
$log = new logmein();
$router = new AltoRouter();
?>
<body>
    <div class="topbar">
        <a href="" class="logo">
            <img src="assets/img/gazr.png" alt="">
        </a>
        <div class="login-box">         
            <?php 
                $log->loginform('','login-form','');
            ?>
        </div>
    </div>
    <section class="content">
        <article  class="register-box">
            <h2>Join gleenr now!</h2>
            <?php $log->registerform('','register-form', ''); //, $router->generate('user_create') ?>
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
    </section>
</body>