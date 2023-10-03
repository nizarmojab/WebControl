
import sqlite3
import Adafruit_DHT
import datetime
import matplotlib.pyplot as plt
# Connecter à la base de données
conn = sqlite3.connect('temperature_humidite.db')
c = conn.cursor()

# Créer la table s'il n'existe pas encore
c.execute('''CREATE TABLE IF NOT EXISTS temperature_humidite
             (id INTEGER PRIMARY KEY AUTOINCREMENT,
              temperature REAL,
              humidite REAL,
              date TEXT)''')

# Lire 10 valeurs de température et d'humidité
for i in range(10):
    humidity, temperature = Adafruit_DHT.read_retry(11, 4)
    date_time = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
    
    # Insérer les valeurs dans la base de données
    c.execute("INSERT INTO temperature_humidite (temperature, humidite, date) VALUES (?, ?, ?)",
              (temperature, humidity, date_time))
    conn.commit()

# Récupérer les 10 dernières valeurs de température, d'humidité et de date
c.execute("SELECT temperature, humidite, date FROM temperature_humidite ORDER BY id DESC LIMIT 10")
rows = c.fetchall()

# Fermer la connexion à la base de données
conn.close()

# Extraire les valeurs de température, d'humidité et de date dans trois listes séparées
temperatures = [row[0] for row in rows]
humidites = [row[1] for row in rows]
dates = [row[2] for row in rows]

# Dessiner le graphique de température
plt.subplot(2, 1, 1)
plt.plot(dates, temperatures, 'ro-')
plt.title('Température')

# Dessiner le graphique d'humidité
plt.subplot(2, 1, 2)
plt.plot(dates, humidites, 'bo-')
plt.title('Humidité')

# Ajuster la taille des graphiques
plt.gcf().autofmt_xdate()

# Afficher les graphiques
plt.tight_layout()
plt.show(block=True)
