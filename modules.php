<?php
	function signup($mail, $password)
	{
		$con = new MongoClient();
		$db = $con-> db->users;

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

	function login($mail, $password)
	{
		$con = new MongoClient($mail, $password);
		$db = $con-> db->users;
		$log = false;
		$data = array("mail" => $mail, 
					  "password" => $password);

		if ($db->findOne($data))
		{
			echo "Вы успешно вошли!";
			echo "<br>";
			echo "Ваш логин: ".$db->findOne($data)['mail'];
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
?>


