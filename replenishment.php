<?php
    //session_start();
	require 'conectbd.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Пополенение счета</title>
</head>
<body>
	<h2>Пополнение счета</h2>
	<form method="post" action="">
		<table>
			<tr>
				<td>Дата покупки</td>
				<td><input type="date" name="date"></td>
			</tr>
			<tr>
				<td>Сумма пополнения</td>
				<td><input type="text" name="sum"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="submit"></td>
			</tr>
			<tr>
				<td colspan="2"><a href="index.php">Вернуться на главную</a></td>
				
			</tr>
		</table>
	</form>
</body>
</html>

<?php

if(isset($_POST['submit'])){

	// Определяем остаток баланса после последней сделки

	$query2 = "SELECT id, balance FROM actions ORDER BY id DESC LIMIT 0, 1";
	$result2 = mysqli_query($link, $query2);
	$res2 = mysqli_fetch_assoc($result2);

	$restMoney = $res2['balance'];
		
	$transact = 3; // номер транзакции 3 - пополнение счета
	
	if(isset($_POST["date"]) && !empty($_POST["date"])){
		$date = $_POST['date'];
	} else {
		die( "Неверно указана дата покупки.");
	}

	if(is_numeric($_POST['sum']) && $_POST['sum'] > 0){
		$sum = $_POST['sum'];
	} else {
		die( "Неверно указана цена купленных бумаг.");
	}

	$balans = $restMoney + $sum;

	
	$sql_replen = "INSERT INTO actions (id_transac, date_action, sum_action, balance) VALUES ('$transact', '$date', $sum, $balans)";

	$result_replen = mysqli_query($link, $sql_replen) or die( mysqli_error($link) );

	if (isset($result_replen)) {
		echo '<h4>Запрос на добавление в базу данных прошел.</h4>';
	}
}


?>