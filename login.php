<?php
	$con = new MongoClient();
	$db = $con-> test4->users;
	$log = false;
	$data = array("mail" => $_POST['mail'], 
				  "password" => $_POST['password']);
	
	if ($db->findOne($data)) {
		echo "You are online!";
		echo "<br>";
		echo "Your login: ".$db->findOne($data)['mail'];
		echo "<br>";
		$log = true;
	} else {
		echo "<h1>Неправильный логин или пароль</h1>";
		echo "<br>";
		echo "<a href='test.php'>На главную</a>";
	}

	echo "<div>"
	if ($log !== null) {
		$notes = $db->notes;
		$id = $db->findOne($data)["_id"];

		foreach ($db->notes->find() as $not){
			if ($not["id"] == $id) {
				$div = "<div style='margin-top: 30 px'><p><b>".$note["title"]."</b></p><p>".$note["text"]."</p></div>";
				print($div);
			}
		}
	}
?>