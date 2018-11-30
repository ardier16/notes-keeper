<?php
    require "modules.php";
    print $boot;
    
    if ($_POST['sub'] == 'Удалить') {
        remove_note($_POST['idd']);
        echo '<h1 id="header1">Notes</h1>
            <h1 id="header2">Keeper</h1>
        <h2 id="msg">УДАЛЕНО</h2>';
        echo "<br>";
        echo "<script>window.location='main.php';</script>"; 
    } else if ($_POST['sub'] == 'Изменить') {
        $upd = '<h1 id="header1">Notes</h1>
            <h1 id="header2">Keeper</h1>
        <form class="form-signin" action="" method="post">
                  <h2 style="text-align: center; font-size: 36; font-family: cursive;"> Редактирование </h2>
                  <center><input type="text" maxlength=17 style="margin-top: 100 px;" name="title" value='.$_POST['title1'].' placeholder="Title" required><br>
                  <textarea name="note" placeholder="Note" rows="3" required>'.$_POST['note1'].'</textarea>
                  <input type="hidden" name="idd" value='.$_POST['idd'].'><br>
                  <input type="submit" class="btn btn-success btn-large" name="upd" value="Обновить">
                  <a href="main.php" class="btn btn-success btn-large">Главная</a>
                  </form></center>';

        print $upd;
    } else if ($_POST['upd'] == 'Обновить') {
        update_note($_POST['idd'], $_POST['title'], $_POST['note']);
        
		echo '<h1 id="header1">Notes</h1>
            <h1 id="header2">Keeper</h1>
        <h2 id="msg">ОБНОВЛЕНО</h2>';
        echo "<br>";
        echo "<script>window.location='main.php';</script>"; 
    } else if ($_POST['add'] == 'Добавить заметку') {
        add_note($_POST['id'], $_POST['title'], $_POST['note']);
        
		echo '<h1 id="header1">Notes</h1>
            <h1 id="header2">Keeper</h1>
        <h2 id="msg">ДОБАВЛЕНО</h2>';
        echo "<br>";
        echo "<script>window.location='main.php';</script>"; 
    }    
?>