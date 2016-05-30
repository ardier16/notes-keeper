<!-- <script type="text/javascript" src="jquery-2.2.3.js"></script>

<script type="text/javascript">
	$(function(){
		$('#button').on('click', function(){
			$get("pract.php", 
				{
					s: $('#s').val), 
					t: $('#t').val)
				}, function(html){
					$('#v').val = html;
				}


		})
	})
</script>
<?php
	if (isset($_GET['s']) && isset($_GET['t']))
	{
		echo $_GET['s']/$_GET['t'];
	}
	else
		echo "Data not found";
?>
<center><form>
	<p>S <input type='text' id='s'></p>
	<p>T <input type='text' id='t'></p>
	<p>V <input type='text' id='v' readonly></p>	
	<p><input type='button' id='button' value='submit'></p>		
</form></center> -->

<?php
	if(isset($_POST['n'])){
		$res = 1;

		for ($i = 2; $i <= $_POST['n']; $i++) { 
			$res *= $i;
		}

		echo $res;
	}
	else
		echo "Data not found";

	?>

<script type="text/javascript" src="jquery-2.2.3.js"></script>

<script type="text/javascript">
	$(function()
	{
		$('#btn').on('click', function()
		{
			$post('pract.php', n: $('#n').val)
		}, function(data)
		{
			$('#f').html(data);
		})
	})
</script>

<form>
	<p>Num<input type='number' id='n'></p>
	<p>Factorial<input type='text' id='f'></p>
	<input type='button' id='btn' value='submit'>
</form>