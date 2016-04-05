<?php
    require "modules.php";

    $log = login($_POST['mail'], $_POST['password']);

    $form = '<!doctype html>
            <head>
            </head>
            
            <h1> Sign Up </h1>
            <form action="signup.php" method="post">
                Почта: <input type="email" name="mail" placeholder="Your mail">
                Пароль: <input type="password" name="password" placeholder="Your password" required>
                <input type="submit" value="Sign Up">
            </form>
            <br>
            <h2> Log In </h2>
            <form action="" method="post">
                Почта: <input type="email" name="mail" placeholder="Your mail" autofocus>
                Пароль: <input type="password" name="password" placeholder="Your password">
                <input type="submit" value="Log In" onclick="document.write()">
            </form>';

    if ($log)
    {
        echo "<h2>Вы успешно вошли!</h2><br>";
        echo "<h3>Ваш логин: ";
        echo "<i>".$_POST['mail']."</i></h3>";
        echo "<br>";
        echo "<a href='main.php'>Log out</a>";
    }

    else
    {
        if ($_POST['mail'])
        {
            print  $form;
            echo "<br>";
            echo "Неправильный логин или пароль";
        }

        else
            print $form;
    }


?>