<?php
	$boot = '<link href="css/bootstrap.min.css" rel="stylesheet">
			<link href="css/bootstrap-theme.min.css" rel="stylesheet">
			<link href="css/bootstrap-responsive.css" rel="stylesheet">  
            <link href="css/main.css" rel="stylesheet"> 
            <link href="css/notes.css" rel="stylesheet"> 		
             <script src="jquery-2.2.3.js"></script>
             <script src="js/bootstrap.min.js"></script>
    			';


	function signup($login, $mail, $password, $password2)
	{
		$con = new MongoClient();
		$db = $con-> db->users;

		$data = array(
						"login" => $login,
						"mail" => $mail,
						"password" => $password,
					 );


		if (!$db->findOne(array("login" => $login)) 
		 && !$db->findOne(array("mail" => $mail))
		 && $password == $password2)
        {
			$db->insert($data);
			echo "<h1 style='text-align: center; font-size: 42; font-family: cursive;'>Вы успешно зарегистрированы!</h1>";
            echo "<br>";
            echo "<h2 style='text-align: center; font-size: 24; font-family: cursive;'>Ваш логин: ".$db->findOne($data)['login'];
            echo "<br>";
            echo "<h3 style='text-align: center; font-size: 24; font-family: cursive;'><a href='main.php'>Вернуться на главную</a></h3>";
		}
			
		else
		{
            print("<h1 id='header1'>Notes</h1>
            <h1 id='header2'>Keeper</h1>");

			if ($db->findOne(array("login" => $login)))
			{
				print('<form class="form-signin" action="" method="post">
                <h2 style="text-align: center; font-size: 36; font-family: cursive;"> Регистрация </h2>
                <div class="control-group error">
                <input class="input-block-level" type="text" id="inputError" name="login" placeholder="Логин" autofocus required>
                </div><p></p>
                <input class="input-block-level" type="email" name="mail" placeholder="E-mail" required><p></p>
                <input class="input-block-level" type="password" name="password" placeholder="Пароль" required>
                <input class="input-block-level" type="password" name="password2" placeholder="Повторите пароль" required>
                <p></p>
                <h4>Такой логин уже используется.</h4>
                <input class="btn btn-success btn-large" style="width: 300" type="submit" value="&nbsp; Зарегистрироваться &nbsp;"><p></p>
                <a class="btn btn-success btn-large" style="width: 260" href="main.php">Вернуться на главную &nbsp;</a>
            </form>

            ');
			}

			else if ($db->findOne(array("mail" => $mail)))
			{
				print('<form class="form-signin" action="" method="post">
                <h2 style="text-align: center; font-size: 36; font-family: cursive;"> Регистрация </h2>
                <div class="control-group">
                <input class="input-block-level" type="text" name="login" placeholder="Логин" autofocus required>
                </div><p></p>
                <div class="control-group">
                <input class="input-block-level" type="email" id="inputError" name="mail" placeholder="E-mail" required>
                </div><p></p>
                <input class="input-block-level" type="password" name="password" placeholder="Пароль" required>
                <p></p>
                <input class="input-block-level" type="password" name="password2" placeholder="Повторите пароль" required><p></p>
                <h4>Такой e-mail уже используется.</h4>
                <input class="btn btn-success btn-large" style="width: 300" type="submit" value="&nbsp; Зарегистрироваться &nbsp;"><p></p>
                <a class="btn btn-success btn-large" style="width: 260" href="main.php">Вернуться на главную &nbsp;</a>
            </form>');				
			}
			else if ($password != $password2)
			{
				print('<form class="form-signin" action="" method="post">
                <h2 style="text-align: center; font-size: 36; font-family: cursive;"> Регистрация </h2>
                <div class="control-group">
                <input class="input-block-level" type="text" name="login" placeholder="Логин" autofocus required>
                </div><p></p>
                <div class="control-group">
                <input class="input-block-level" type="email" name="mail" placeholder="E-mail" required>
                </div><p></p>
                <div class="control-group">
                <input class="input-block-level" type="password" id="inputError" name="password" placeholder="Пароль" required>
                </div><p></p>
                <div class="control-group">
                <input class="input-block-level" type="password" id="inputError" name="password2" placeholder="Повторите пароль" required>
                </div><p></p>
                <h4>Пароли не совпадают.</h4>
                <input class="btn btn-success btn-large" style="width: 300" type="submit" value="&nbsp; Зарегистрироваться &nbsp;"><p></p>
                <a class="btn btn-success btn-large" style="width: 260" href="main.php">Вернуться на главную &nbsp;</a>
            </form>');					
			}
		}
	}

	function login($login, $password)
	{
		$con = new MongoClient();
		$db = $con-> db->users;
		$log = false;
		$data = array("login" => $login, 
					  "password" => $password);

		if ($db->findOne($data))
		{
			$filter=array("login" => $login);
			$person = $db->findOne($filter);
			return $person["_id"];
		}

        return $log;
	}	
	

	function add_note($id, $title, $text)
	{
		$con = new MongoClient();
		$notes = $con-> db->notes;
		$note = array("id" => $id,
					  "title" => $title,
					  "text" => $text);

		$notes->insert($note);
	}

	function remove_note($_id)
	{
		$con = new MongoClient();
		$notes = $con-> db->notes;
		$info = array("_id" => new MongoId($_id));
		$notes->remove($info, array('justOne' => true));
	}

	function update_note($_id, $title, $text)
	{
		$con = new MongoClient();
		$notes = $con-> db->notes;
		$old = array("_id" => new MongoId($_id));
		$new = array("title" => $title, "text" => $text);
		$notes->update($old, array('$set' => $new), array("upsert" => true));
	}

	function show_notes($id)
    {
        $con = new MongoClient();
        $notes = $con-> db->notes;

        $filter = array("id"=>$id);
        $data = $notes->find();

        echo "<div id='notes'>";
        $h = 0;
        $w = 0;
        $count = 0;
        while($document = $data->getNext())
        {
            if ($document["id"] == $id)
            {
                $div = "<div id='note' style='margin-top:".$h."px; margin-left:".$w."px; background-color: ".get_color($count % 6)."'>
                <p><h2 id='title'>".htmlentities($document["title"])."</h2></p><p><h4 id='text'>".htmlentities($document["text"])."</h4></p>";
               
                $res = $document["_id"];
                print $div.'<form action="remove.php" method="post">'.'  
                      <input type="submit" style="margin-left: 5px;height: 40px;width: 140px; font-size: 20" class="btn btn-danger" name="sub" value="Удалить">
                      <input type="submit" style="margin-left: 5px;height: 40px;width: 140px; font-size: 20" class="btn btn-primary" name="sub" value="Изменить">                    
                      <input type="hidden" name="idd" value='.$res.'>
                      <input type="hidden" name="title1" value='.htmlentities($document["title"]).'>
                      <input type="hidden" name="note1" value='.htmlentities($document["text"]).'>
                      </form></div>';
                
                $w += 320;
                $count++;
                if (!$check)
                {
                    $check = !$check;
                    $h = -206;

                }

                if ($count % 4 == 0)
                {
                    $h += 226;
                    $w = 0;
                    $check = !$check;
                }


                    
            }
            
        }

        print '<div id="note" style="
                    margin-top:'.$h.'px;
                    margin-left:'.$w.'px;
                    
                    background-color: '.get_color($count % 6).';
                "><center><form action="remove.php" method="post">
                  <h2 style="
                    margin-top: 5px;
                ">Новая заметка</h2>
                  <input type="text" maxlength=17 style="
                    margin-top: -5px;
                    height: 30px;
                    font-size: 22;
                    width: 250px;
                " name="title" placeholder="Заголовок" required>
                  <textarea name="note" placeholder="Заметка" required style="
                    margin-top: 0px;
                    width: 250px;
                    margin-left: 5px;
                "></textarea>
                  <input type="hidden" name="id" value='.$id.'><br>
                  <input type="submit" style="width: 280px; font-size: 20" class="btn btn-large btn-success" name="add" value="Добавить заметку">
                  </form></center></div>';
    }

    function get_color($number)
    {
        switch ($number) {
            case 0:
                return "rgba(244, 239, 173, 0.74)";
                break;
            case 1:
                return "rgba(255, 186, 186, 0.8)";
                break;
            case 2:
                return "lightcyan";
                break;
            case 3:
                return "rgba(144, 238, 144, 0.68)";
                break;
            case 4:
                return "rgba(148, 43, 166, 0.34)";
                break;
            case 5:
                return "rgba(143, 255, 0, 0.61)";
                break;                            
            default:
                break;
        }
    }
?>


