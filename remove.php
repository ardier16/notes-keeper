<?php
    require "modules.php";
    
    if ($_POST['sub'] == 'remove')
    {
        remove_note($_POST['idd']);
        echo "DELETED.";
        echo "<br>";
        echo "<script>window.location='main.php';</script>"; 
    }

    else if ($_POST['sub'] == 'update')
    {
        $upd = '<form action="" method="post">
                  <h2> Update</h2>
                  <input type="text" name="title" value='.$_POST['title1'].' placeholder="Title" required><br><br>
                  <input type="text" name="note" value='.$_POST['note1'].' placeholder="Note" required>
                  <input type="hidden" name="foo" value='.$_POST['foo'].'><br>
                  <input type="submit" name="upd" value="upd">
                  </form>';

        print $upd;
    }

    else if ($_POST['upd'] == 'upd')
    {
        update_note($_POST['foo'], $_POST['title'], $_POST['note']);
        echo "UPDATED.";
        echo "<br>";
        echo "<script>window.location='main.php';</script>"; 
    }

    else if ($_POST['add'] == 'add')
    {
        add_note($_POST['id'], $_POST['title'], $_POST['note']);
        echo "ADDED";
        echo "<br>";      
        echo "<script>window.location='main.php';</script>"; 
    }    


    echo "<h3><a href='main.php'>Вернуться на главную</a></h3>";
?>