<?php
	$boot = '<link href="css/bootstrap.min.css" rel="stylesheet">
			<link href="css/bootstrap-theme.min.css" rel="stylesheet">
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
			echo "<h1>Вы успешно зарегистрированы!</h1>";
            echo "<br>";
            echo "Ваш логин: ".$db->findOne($data)['login'];
            echo "<br>";
            echo "<h3><a href='main.php'>Вернуться на главную</a></h3>";
		}
			
		else
		{
			if ($db->findOne(array("login" => $login)))
				echo "<h1>Такой логин уже используется.</h1>";
			else if ($db->findOne(array("mail" => $mail)))
				echo "<h1>Такой e-mail уже используется.</h1>";
			else if ($password != $password2)
				echo "<h1>Пароли не совпадают.</h1>";

            echo "<br>";
			echo "<h3><a href='main.php'>Вернуться на главную</a></h3>";
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

        while($document = $data->getNext())
        {
            if ($document["id"] == $id)
            {
                echo "<p><h2><b> Title: </b>" . $document["title"] . "</h2>";
                echo "<h3><b>Text: </b>" . $document["text"] . "</h3></p>";
                $res = $document["_id"];
                print '<form action="remove.php" method="post">'.
                      '
                      <input type="submit" class="btn btn-danger" name="sub" value="remove">
                      <input type="submit" class="btn btn-primary" name="sub" value="update">
                      <input type="hidden" name="idd" value='.$res.'>
                      <input type="hidden" name="title1" value='.$document["title"].'>
                      <input type="hidden" name="note1" value='.$document["text"].'>
                      </form>';
            }
            
        }

        print '<form action="remove.php" method="post">
                  <h2> Add Note</h2>
                  <input type="text" name="title" placeholder="Title" required><br><br>
                  <input type="text" name="note" placeholder="Note" required>
                  <input type="hidden" name="id" value='.$id.'><br>
                  <input type="submit" name="add" value="add">
                  </form>';
    }
?>


