<?php
    require "modules.php";
    
    $page = $boot.'<style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      } </style>
             ';

    print $page;

    $id = login($_POST['login'], md5($_POST['password']));

    $form = '<!doctype html>
            <head>
            </head>
            
            <form class="form-signin" action="" method="post">
                <h2> Log In </h2>
                <div class="control-group">
                <input class="input-block-level" type="text" name="login" placeholder="Your login" autofocus required>
                </div><p></p>
                <div class="control-group">
                <input class="input-block-level" type="password" name="password" placeholder="Your password" required>
                </div><p></p>
                <input class="btn btn-success btn-large" type="submit" value="Log In">
                <a class="btn btn-success btn-large" href="signup.php">Sign Up</a>
            </form>';


    if ($id)
    {
        echo "<h2>Добро пожаловать, ";
        echo "<i>".$_POST['login']."</i></h2>";
        echo "<form action=''><a class='btn btn-primary' name='logout' href='main.php'>Log out</a></form>";
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
            
            <form class="form-signin" action="" method="post">
                <h2> Sign In </h2>
                <div class="control-group error"><div class="controls">
                <input class="input-block-level" type="text" name="login" id="inputError" placeholder="Your login" autofocus required>
                </div></div><p></p>
                <div class="control-group">
                <input class="input-block-level" type="password" name="password" id="inputError" placeholder="Your password" required>
                </div><p></p>
                <p class="text-error">Неправильный логин или пароль</p>
                <input class="btn btn-success btn-large" type="submit" value="Log In">
                <a class="btn btn-success btn-large" href="signup.php">Sign Up</a>
            </form>';
        }

        else
            print $form;
    }





?>