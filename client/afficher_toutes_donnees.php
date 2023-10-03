
<!DOCTYPE html>
<html>
<head>
	<title>Historique complet des données de température et d'humidité</title>
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
			border-radius: 8px;
			box-shadow: 0px 0px 4px #888;
		}
		.button:hover {
			background-color: #3e8e41;
		}
		.button:active {
			background-color: #3e8e41;
			box-shadow: 0px 0px 2px #888;
			transform: translateY(2px);
		}
	</style>
</head>
<body>
	<h1>Historique complet des données de température et d'humidité</h1>
	<table>
		<tr>
			<th>ID</th>
			<th>Date/Heure</th>
			<th>Température</th>
			<th>Humidité</th>
		</tr>
		<?php
		// Ouvrir la base de données SQLite3
		$db = new SQLite3('temperature_humidite.db');

		// Récupérer toutes les données de température, d'humidité et de date
		$query = "SELECT id, temperature, humidite, date FROM temperature_humidite ORDER BY id DESC";
		$result = $db->query($query);

			// Afficher les valeurs sous forme de tableau HTML
		while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
			echo "<tr>";
			echo "<td>" . $row['id'] . "</td>";
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
		<a href="update.php" class="button">Retour à la page de mise à jour</a>
	</div>
</body>
</html>
