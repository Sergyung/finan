<?php
    //session_start();
	require 'conectbd.php';
	function func() {
		echo '!';
	}


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
				<td colspan="5"><a href="index.php">Вернуться на главную</a></td> <!--colspan="5"-->
			</tr>
			<tr>
				<td colspan="5">
					Облигации
				</td>
			</tr>
			<?php	
				func();
				$query1 = "SELECT name_paper, SUM(lot) * lot_paper AS count, ROUND(SUM(price_paper * lot * lot_paper), 2) AS summ FROM papers INNER JOIN actions ON actions.id_paper = papers.id_paper WHERE id_typePaper = 2 GROUP BY actions.id_paper"; 
				$result1 = mysqli_query($link, $query1);
				$i = 1;
				while($row1 = $result1->fetch_assoc())
				{
					echo '<tr>
					<td width="30">'.$i.'</td>
					<td width="300">'.$row1['name_paper'].'</td>
					<td width="50">'.$row1['count'].'</td>
					<td width="100">'.$row1['summ'].'</td>
					<td width="100">'.round($row1['summ'] / $row1['count'], 2).'</td>
					</tr>';
					$i++;
				}	
			?>	
			<tr>
				<td colspan="5">
					Акции
				</td>
			</tr>
			<?php
	        	$query = "SELECT name_paper, SUM(lot) * lot_paper AS count, ROUND(SUM(price_paper * lot * lot_paper), 2) AS summ FROM papers INNER JOIN actions ON actions.id_paper = papers.id_paper WHERE id_typePaper = 1 GROUP BY actions.id_paper"; 
				$result = mysqli_query($link, $query);
				$i = 1;
				while($row = $result->fetch_assoc())
				{
					echo '<tr>
						<td width="30">'.$i.'</td>
						<td width="300">'.$row['name_paper'].'</td>
						<td width="50">'.$row['count'].'</td>
						<td width="100">'.$row['summ'].'</td>
						<td width="100">'.round($row['summ'] / $row['count'], 2).'</td>
					</tr>';
					$i++;
				}
			?>
			<tr>
				<td colspan="5">
					Фонды
				</td>
			</tr>
			<?php
	        	$query = "SELECT name_paper, SUM(lot) * lot_paper AS count, SUM(price_paper * lot) AS summ FROM papers INNER JOIN actions ON actions.id_paper = papers.id_paper WHERE id_typePaper = 3 GROUP BY actions.id_paper"; 
				$result = mysqli_query($link, $query);
				$i = 1;
				while($row = $result->fetch_assoc())
				{
					echo '<tr>
						<td width="30">'.$i.'</td>
						<td width="300">'.$row['name_paper'].'</td>
						<td width="50">'.$row['count'].'</td>
						<td width="100">'.$row['summ'].'</td>
					</tr>';
					$i++;
				}
			?>			
					
			<tr>
				<td colspan="5"><a href="index.php">Вернуться на главную</a></td>
				
			</tr>
		</table>
	</form>
</body>

<?php
	
?>