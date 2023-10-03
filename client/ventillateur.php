<?php 
$slowdown = false; 

if (isset($_POST['demarrer'])) { 
    $duration = ($_POST['duree']); 
    $command = "python3 ventilo.py $duration"; 
    shell_exec($command); 
    $slowdown = true; 
} 

if (isset($_POST['arreter'])) { 
    $kill_process = "pkill -f ventilo.py"; 
    shell_exec($kill_process); 
    $slowdown = false; 
} 
?> 

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrôle du ventilateur</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 30px;
        }

        .form-control {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .form-control label {
            font-size: 20px;
            font-weight: bold;
            margin-right: 20px;
            margin-bottom: 10px;
            display: block;
            width: 100%;
        }

        .form-control input[type="text"] {
            font-size: 20px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #f2f2f2;
            flex: 1;
        }

        .form-control button {
            font-size: 20px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
            margin-left: 20px;
        }

        .form-control button:hover {
            background-color: #3E8E41;
        }

        .form-control button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .form-control button:last-of-type {
            margin-left: 0;
        }

        @media (max-width: 768px) {
            .form-control {
                flex-direction: column;
            }
            .form-control label {
                margin-bottom: 5px;
            }
            .form-control input[type="text"] {
                margin-bottom: 10px;
                flex: none;
                width: 100%;
            }
            .form-control button {
                margin-left: 0;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <h1>Contrôle du ventilateur</h1>
    <div class="form-container">
        <form method="post">
            <div class="form-control">
                <label for="duree">Durée (en secondes) :</label>
                <input type="text" name="duree" id="duree" required>
                <button type="submit" name="demarrer">Démarrer</button>
                <?php if ($slowdown) { echo "<button type='submit' name='arreter'>Arrêter</button>"; } ?>
            </div>
        </form>
    </div>
</body>
</html>

