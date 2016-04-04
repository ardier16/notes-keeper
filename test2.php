<?php
	function signup($mail, $password)
	{
		$con = new MongoClient();
		$db = $con-> test4->users;

		$data = array(
						"mail" => $mail,
						"password" => $password
					 );


		if (!$db->findOne(array("mail" => $mail))){
			$db->insert($data);
			echo "<h1>Вы успешно зарегистрированы!</h1>";
		}
			
		else
		{
			echo "<h1>Такой логин уже используется.</h1>";
		}
	}

	function login()
	{
		$con = new MongoClient($mail, $password);
		$db = $con-> test4->users;
		$log = false;
		$data = array("mail" => $mail, 
					  "password" => $password);

		if ($db->findOne($data))
		{
			echo "You are online!";
			echo "<br>";
			echo "Your login: ".$db->findOne($data)['mail'];
			echo "<br>";
			$log = true;
		}
		else
		{
			echo "<h1>Неправильный логин или пароль</h1>";
		}	
	}	
	

	function add_note($id, $title, $text)
	{
		$con = new MongoClient();
		$notes = $con-> test4->notes;
		$note = array("id" => $id,
					  "title" => $title,
					  "text" => $text);

		$notes->insert($note);
	}

	function remove_note($id, $title, $text)
	{
		$con = new MongoClient();
		$notes = $con-> test4->notes;
		$info = array("id" => $id, "title" => $title, "text" => $text);
		$notes->remove($info, array('justOne' => true));
	}

	function update_note($id, $oldtitle, $oldtext, $title, $text)
	{
		$con = new MongoClient();
		$notes = $con-> test4->notes;
		$old = array("id" => $id, "title" => $oldtitle, "text" => $oldtext);
		$new = array("id" => $id, "title" => $title, "text" => $text);
		$notes->update($old, $new, array("upsert" => true));
	}		
?>


