<?php
    require "modules.php";
    
	print $boot;

    if(isset($_POST['mail'])) {
        $pass = md5($_POST['password']);
        $pass2 = md5($_POST['password2']);
    	signup($_POST['login'], $_POST['mail'], $pass, $pass2);
    } else {
    	$form = '<!doctype html>          
           <h1 id="header1">Notes</h1>
            <h1 id="header2">Keeper</h1>
           <form class="form-signin" action="" method="post">
                <h2 style="text-align: center; font-size: 36; font-family: cursive;"> Регистрация </h2>
                <div class="control-group">
                <input class="input-block-level" type="text" name="login" placeholder="Логин" autofocus required>
                <input class="input-block-level" type="email" name="mail" placeholder="E-mail" required>
                <input class="input-block-level" type="password" name="password" placeholder="Пароль" required>
                <input class="input-block-level" type="password" name="password2" placeholder="Повторите пароль" required>
                </div><p></p>
                <input class="btn btn-success btn-large" style="width: 300" type="submit" value="&nbsp; Зарегистрироваться &nbsp;"><p></p>
                <a class="btn btn-success btn-large" style="width: 260" href="main.php">Вернуться на главную &nbsp;</a>
            </form>';

        print $form;
    }  
?>