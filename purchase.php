<?php
    //session_start();
	require 'conectbd.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h2>Покупка</h2>
	<form method="post" action=""> <!--addPurchase.php-->
		<table>
			<tr>
				<td>Название бумаги</td>
				<td><select name = "paper">
					<option>Выберите бумагу</option>
					<?php
	        		$query = "SELECT * FROM papers"; 
					$result = mysqli_query($link, $query);
					while($row = $result->fetch_assoc())
					{
					    echo '<option value ='.$row['id_paper'].'>'.$row['name_paper'].'</option>';
					}
				?>
				</select></td>
				<td><a href="addPaperName.php">Добавить</a></td>
			</tr>
			<tr>
				<td>Количество</td>
				<td><input type="number" name="lot"></td>
			</tr>
			<tr>
				<td>Дата покупки</td>
				<td><input type="date" name="date"></td>
			</tr>
			<tr>
				<td>Цена за 1 шт</td>
				<td><input type="text" name="price"></td>
			</tr>
			<tr>
				<td>Комиссия брокера</td>
				<td><input type="text" name="award"></td>
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

	// var_dump($_POST);

	if(isset($_POST["paper"]) && !empty($_POST["paper"])) {
	    $name = $_POST["paper"];
	} else {
		die( "Неуказано название бумаги.");
	}

	// Определем количество бумаг в одном лоте 

	$query1 = "SELECT * FROM papers WHERE id_paper = '$name'"; // WHERE id = 3
	$result = mysqli_query($link, $query1);
	$res = mysqli_fetch_assoc($result);
	
	$count = $res['lot_paper'];
		
	$transactPurch = 1; // номер транзакции 1 - покупка
	$transactComm = 2; // номер транзакции 2 - комиссия брокера

	if(isset($_POST["date"]) && !empty($_POST["date"])){
		$date = $_POST['date'];
	} else {
		die( "Неверно указана дата покупки.");
	}

	if(is_numeric($_POST['lot']) && $_POST['lot'] > 0){
		$lot = $_POST['lot'];
	} else {
		die( "Неверно указано количество купленных бумаг.");
	}

	if(is_numeric($_POST['price']) && $_POST['price'] > 0){
		$price = $_POST['price'];
	} else {
		die( "Неверно указана цена купленных бумаг.");
	}

	if(is_numeric($_POST['award']) && $_POST['award'] > 0){
		$award = $_POST['award'];
	} else {
		die( "Неверно указана цена купленных бумаг.");
	}

	$sum = $count * $lot * $price;

	$sql_purch = "INSERT INTO actions (id_paper, id_transac, lot, date_action, price_paper, sum_action) VALUES ('$name', '$transactPurch',  '$lot', '$date', '$price', $sum)";

	$result_purch = mysqli_query($link, $sql_purch) or die( mysqli_error($link) );

	$sql_comm = "INSERT INTO actions (id_paper, id_transac, date_action, sum_action) VALUES ('$name', '$transactComm',  '$date', $award)";

	$result_comm = mysqli_query($link, $sql_comm) or die( mysqli_error($link) );

	if (isset($result_purch) && isset($result_comm)) {
		echo '<h4>Запрос на добавление в базу данных прошел.</h4>';
	}
}


?>