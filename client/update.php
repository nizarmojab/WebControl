
<!DOCTYPE html>
<html>
<head>
	<title>Données de température et d'humidité</title>
	<style type="text/css">
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
			margin: 0;
			padding: 0;
		}
		h1 {
			text-align: center;
			margin-top: 50px;
		}
		table {
			margin: auto;
			border-collapse: collapse;
			border: 1px solid #ddd;
			width: 80%;
			background-color: #fff;
			box-shadow: 0px 0px 8px #ddd;
		}
		th, td {
			padding: 12px;
			text-align: center;
			border: 1px solid #ddd;
		}
		th {
			background-color: #f2f2f2;
		}
		tr:nth-child(even) {
			background-color: #f2f2f2;
		}
		 .button {
			display: inline-block;
			padding: 8px 16px;
			font-size: 16px;
			cursor: pointer;
			text-align: center;
			text-decoration: none;
			outline: none;
			color: #fff;
			background-color: #4CAF50;
			border: none;
			border-radius: 5px;
			box-shadow: 0 4px #999;
		}
		.button:hover {background-color: #3e8e41}
		.button:active {
			background-color: #3e8e41;
			box-shadow: 0 2px #666;
			transform: translateY(4px);
		}
	</style>
</head>
<body>
	<h1>Données de température et d'humidité</h1>
	<table>
		<tr>
			<th>Date/Heure</th>
			<th>Température</th>
			<th>Humidité</th>
		</tr>
		<?php
		// Ouvrir la base de données SQLite3
		$db = new SQLite3('temperature_humidite.db');

		// Récupérer les 10 dernières valeurs de température, d'humidité et de date
		$query = "SELECT temperature, humidite, date FROM temperature_humidite ORDER BY id DESC LIMIT 10";
		$result = $db->query($query);

		// Afficher les valeurs sous forme de tableau HTML
		while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
			echo "<tr>";
			echo "<td>" . $row['date'] . "</td>";
			echo "<td>" . $row['temperature'] . " °C</td>";
			echo "<td>" . $row['humidite'] . " %</td>";
			echo "</tr>";
		}

		// Fermer la connexion à la base de données
		$db->close();
		?>
	</table>
	<div style="text-align: center; margin-top: 20px;">
		<a href="temperature_humidite2.php" class="button">Afficher le Graphe</a>
		<a href="afficher_toutes_donnees.php" class="button">Afficher toutes les données</a>
	</div>
</body>
</html>
