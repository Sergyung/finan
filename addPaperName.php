<?php
    //session_start();
	require 'conectbd.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Добавление</title>
	<style>
   select {
    width: 177px; /* Ширина списка в пикселах */
   }
  </style>
</head>
<body>

	<h2>Добавление</h2>
	<form method="post" action=""> <!--addPurchase.php-->
		<table>
			<tr>
				<td>Название бумаги</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>ISIN</td>
				<td><input type="text" name="code"></td>
			</tr>
			<tr>
				<td>Тизер</td>
				<td><input type="text" name="tizer"></td>
			</tr>
			<tr>
				<td>Вид бумаги</td>
				<td><select name = "type">
					<?php
	        		$query = "SELECT * FROM typePapers"; 
					$result = mysqli_query($link, $query);
					 
					while($row = $result->fetch_assoc())
					{
					    echo '<option value ='.$row['id'].'>'.$row['typePaper'].'</option>';
					}
				?>
				</select></td>
			</tr>
			<tr>
				<td>Бумаг в лоте</td>
				<td><select name = "lot">
					<option>1</option>
					<option>10</option>
					<option>100</option>
					<option>1000</option>
					<option>10000</option>
				</select></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="submit"></td>
			</tr>
		</table>
	</form>
</body>
</html>

<?php

if(isset($_POST['submit'])){

	if(isset($_POST["name"]) && !empty($_POST["name"])) {
	    $name = $_POST["name"];
	} else {
		die( "Неуказано название бумаги.");
	}

	if(isset($_POST["code"]) && !empty($_POST["code"])) {
	    $code = $_POST["code"];
	} else {
		die( "Неуказан ISIN бумаги.");
	}

	if(isset($_POST["tizer"]) && !empty($_POST["tizer"])) {
	    $tizer = $_POST["tizer"];
	} else {
		die( "Неуказано Тизер бумаги.");
	}

	if(isset($_POST["type"]) && !empty($_POST["type"])) {
	    $type = $_POST["type"];
	} else {
		die( "Неуказан тип бумаги.");
	}

	$lot = $_POST["lot"];

	$sql_akt = "INSERT INTO papers (name_paper, code_paper, tizer_paper, id_typePaper, lot_paper) VALUES ('$name', '$code', '$tizer', '$type', '$lot')";

	$result = mysqli_query($link, $sql_akt) or die( mysqli_error($link) );

	if (isset($result)) {
		echo '<h4>Запрос на добавление в базу данных прошел. <a href="purchase.php">Вернуться на страницу покупки</a></h4>';
	}
}


?>

