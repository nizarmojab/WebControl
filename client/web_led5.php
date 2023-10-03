<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>LED Control</title>
  <style>
    body {
      font-family: 'Helvetica', sans-serif;
      font-size: 16px;
      background-color: #f5f5f5;
    }
    
    h1 {
      text-align: center;
      font-size: 32px;
      margin-top: 50px;
    }
    
    table {
      width: 400px;
      margin: 0 auto;
      border-collapse: collapse;
      border: 1px solid #ccc;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
      background-color: #fff;
    }
    
    th, td {
      text-align: center;
      padding: 10px;
      border: 1px solid #ccc;
    }
    
    button {
      width: 75px;
      margin: 2px auto;
      border: none;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
      background-color: #4CAF50;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
    }
    
    button:hover {
      background-color: #3e8e41;
    }
    
    input[type="number"] {
      width: 50px;
      text-align: center;
      border: none;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
      background-color: #f5f5f5;
      font-size: 16px;
    }
    
    @keyframes blink {
      0% {
        background-color: #f00; /* rouge */
      }
      50% {
        background-color: #fff; /* blanc */
      }
      100% {
        background-color: #f00; /* rouge */
      }
    }
    
    button[type="button"][onclick*="clignotement"] {
      animation: blink 1s infinite;
    }
  </style>
</head>
<body>
  <h1>LED Control</h1>
  
  <table>
    <tr>
      <th>LED #0</th>
      <td><button onclick="location.href='web_led5.php?led=0&onOff=1&clignotement=0'" type="button">ON</button></td>
      <td><button onclick="location.href='web_led5.php?led=0&onOff=0&clignotement=0'" type="button">OFF</button></td>
      <td><input type="number" min="0" max="10" value="0" id="led0clignotement" /></td>
      <td><button onclick="location.href='web_led5.php?led=0&onOff=1&clignotement='+document.getElementById('led0clignotement').value" type="button">Blink</button></td>
    </tr>
    <tr>
      <th>LED #1</th>
      <td><button onclick="location.href='web_led5.php?led=1&onOff=1&clignotement=0'" type="button">ON</button></td>
      <td><button onclick="location.href='web_led5.php?led=1&onOff=0&clignotement=0'" type="button">OFF</button></td>
      <td><input type="number" min="0" max="10" value="0" id="led1clignotement" /></td>
      <td><button onclick="location.href='web_led5.php?led=1&onOff=1&clignotement='+document.getElementById('led1clignotement').value" type="button">Blink</button></td>
    </tr>
    <tr>
      <th>LED #2</th>
      <td><button onclick="location.href='web_led5.php?led=2&onOff=1&clignotement=0'" type="button">ON</button></td>
      <td><button onclick="location.href='web_led5.php?led=2&onOff=0&clignotement=0'" type="button">OFF</button></td>
      <td><input type="number" min="0" max="10" value="0" id="led2clignotement" /></td>
      <td><button onclick="location.href='web_led5.php?led=2&onOff=1&clignotement='+document.getElementById('led2clignotement').value" type="button">Blink</button></td>
    </tr>
    <tr>
      <th>LED #3</th>
      <td><button onclick="location.href='web_led5.php?led=3&onOff=1&clignotement=0'" type="button">ON</button></td>
      <td><button onclick="location.href='web_led5.php?led=3&onOff=0&clignotement=0'" type="button">OFF</button></td>
      <td><input type="number" min="0" max="10" value="0" id="led3clignotement" /></td>
      <td><button onclick="location.href='web_led5.php?led=3&onOff=1&clignotement='+document.getElementById('led3clignotement').value" type="button">Blink</button></td>
    </tr>
  </table>
  
  <?php
  if (isset($_GET['led']) && isset($_GET['onOff']) && isset($_GET['clignotement'])) {
      $led = $_GET['led'];
      $onOff = $_GET['onOff'];
      $clignotement = $_GET['clignotement'];
      exec("/www/c-bin/web_led4 $led $onOff $clignotement");
  }
  ?>
</body>
</html>
