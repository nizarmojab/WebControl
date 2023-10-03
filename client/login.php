
<!DOCTYPE html>
<html>
<head>
	<title>Page de connexion</title>
	<style>
		body {
			background-color: #f2f2f2;
			font-family: Arial, sans-serif;
		}

		.container {
			margin: 50px auto;
			padding: 20px;
			width: 400px;
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0px 0px 10px #ccc;
		}

		h1 {
			text-align: center;
			color: #555;
		}

		input[type=text], input[type=password] {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			box-sizing: border-box;
			border-radius: 4px;
		}

		button {
			background-color: #4CAF50;
			color: #fff;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			width: 100%;
		}

		button:hover {
			background-color: #45a049;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Connexion</h1>
		<form method="POST" action="traitement.php">
			<label for="username">Nom d'utilisateur</label>
			<input type="text" id="username" name="username" placeholder="Entrer votre nom d'utilisateur">

			<label for="password">Mot de passe</label>
			<input type="password" id="password" name="password" placeholder="Entrer votre mot de passe">

			<button type="submit" action="acceuil.php">Continuer</button>
		</form>
	</div>
</body>
</html>
