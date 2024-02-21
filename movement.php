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
		<table border="1">
			<tr>
				<td colspan="5"><a href="index.php">Вернуться на главную</a></td>
				
			</tr>

			<?php
	        	$query = "SELECT * FROM actions LEFT JOIN papers ON papers.id_paper = actions.id_paper INNER JOIN transactions ON transactions.id = actions.id_transac ORDER BY actions.id"; 
				$result = mysqli_query($link, $query);
				while($row = $result->fetch_assoc())
				{
					echo '<tr>
					<td width="100">'.$row['date_action'].'</td>
					<td width="170">'.$row['code'].'</td>
					<td width="300">'.$row['name_paper'].'</td>
					<td width="100">'.$row['sum_action'].'</td>
					<td width="100">'.$row['balance'].'</td>
					</tr>';
				    //echo '<option value ='.$row['id_paper'].'>'..'</option>';
				}
			?>
						
			<tr>
				<td colspan="5"><a href="index.php">Вернуться на главную</a></td>
				
			</tr>
		</table>
	</form>
</body>