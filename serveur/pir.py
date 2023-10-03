import RPi.GPIO as GPIO
import time

# Configuration des broches GPIO
GPIO.setmode(GPIO.BCM)
PIR_PIN = 17
LED_PIN = 18
GPIO.setup(PIR_PIN, GPIO.IN)
GPIO.setup(LED_PIN, GPIO.OUT)

try:
    while True:
        if GPIO.input(PIR_PIN):
            GPIO.output(LED_PIN, GPIO.HIGH)
            print("Mouvement détecté !")
        else:
            GPIO.output(LED_PIN, GPIO.LOW)
            print("Aucun mouvement détecté.")
        time.sleep(0.1)

except KeyboardInterrupt:
    # Nettoyage des broches GPIO en cas d'interruption par l'utilisateur
    GPIO.cleanup()

