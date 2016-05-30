<?php
    require "modules.php";

    print $boot;

    $id = login($_POST['login'], md5($_POST['password']));

    $form = '<!doctype html>
            <head>
            </head>
            <h1 id="header1">Notes</h1>
            <h1 id="header2">Keeper</h1>

            <form class="form-signin" action="" method="post">
                <h2 style="text-align: center; font-size: 36; font-family: cursive;"> Вход </h2>
                <div class="control-group">
                <input class="input-block-level" type="text" name="login" placeholder="Ваш логин" autofocus required>
                </div><p></p>
                <div class="control-group">
                <input class="input-block-level" type="password" name="password" placeholder="Ваш пароль" required>
                </div><p></p>
                <input class="btn btn-success btn-large" style="width: 150" type="submit" value="Войти">
                <a class="btn btn-success btn-large"" href="signup.php">Регистрация</a>
            </form>';


    if ($id)
    {
        echo "<h2 id='welcome'>Добро пожаловать, ";
        echo "<i>".$_POST['login']."</i></h2>
             <h1 id='header1'>Notes</h1>
            <h1 id='header2'>Keeper</h1>";
        echo "<form action=''><a class='btn btn-primary' id='logout' name='logout' href='main.php'>Выйти</a></form>";
        echo "<br>";

        show_notes($id);
        
    }

    else
    {
        if ($_POST['login'])
        {
            print '<!doctype html>
            <head>
            </head>
            <h1 id="header1">Notes</h1>
            <h1 id="header2">Keeper</h1>
            <form class="form-signin" action="" method="post">
                <h2 style="text-align: center; font-size: 36; font-family: cursive;"> Вход </h2>
                <div class="control-group error"><div class="controls">
                <input class="input-block-level" type="text" name="login" id="inputError" placeholder="Ваш логин" autofocus required>
                </div><p></p>
                <div class="control-group">
                <input class="input-block-level" type="password" name="password" id="inputError" placeholder="Ваш пароль" required>
                </div></div><p></p>
                <p class="text-error">Неправильный логин или пароль</p>
                <input class="btn btn-success btn-large" style="width: 150" type="submit" value="Войти">
                <a class="btn btn-success btn-large"" href="signup.php">Регистрация</a>
            </form>';
        }

        else
            print $form;
    }

?>