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
			
			<?php
	        	$query = "SELECT * FROM actions LEFT JOIN papers ON papers.id_paper = actions.id_paper INNER JOIN transactions ON transactions.id = actions.id_transac ORDER BY actions.id"; 
				$result = mysqli_query($link, $query);
				while($row = $result->fetch_assoc())
				{
					echo '<tr>
					<td>'.$row['name_paper'].'</td>
					<td>'.$row['code'].'</td>
					<td>'.$row['date_action'].'</td>
					<td>'.$row['sum_action'].'</td>
					</tr>';
				    //echo '<option value ='.$row['id_paper'].'>'..'</option>';
				}
			?>
			
					
			
			<tr>
				<td colspan="2"><a href="index.php">Вернуться на главную</a></td>
				
			</tr>
		</table>
	</form>
</body>