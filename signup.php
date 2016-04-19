<?php
    require "modules.php";
    print $boot;


    if(isset($_POST['mail']))
    {
        $pass = md5($_POST['password']);
        $pass2 = md5($_POST['password2']);
    	signup($_POST['login'], $_POST['mail'], $pass, $pass2);
    }
    else
    {
    	    $form = '<!doctype html>          
           
           <form class="form-signup" action="" method="post">
                <h2> Sign Up </h2>
                <div class="control-group">
                <input class="input-block-level" type="text" name="login" placeholder="Логин" autofocus required>
                </div><p></p>
                <div class="control-group">
                <input class="input-block-level" type="email" name="mail" placeholder="E-mail" required>
                </div><p></p>
                <div class="control-group">
                <input class="input-block-level" type="password" name="password" placeholder="Пароль" required>
                </div><p></p>
                <div class="control-group">
                <input class="input-block-level" type="password" name="password2" placeholder="Повторите пароль" required>
                </div><p></p>
                <input class="btn btn-success btn-large" type="submit" value="Зарегистрироваться">
            </form>';

            print $form;
    }

    
?>