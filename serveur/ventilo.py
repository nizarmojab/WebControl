import RPi.GPIO as GPIO
import time
import sys

# Configuration du pin GPIO 
GPIO.setmode(GPIO.BCM) 
ventilateur_pin = 26 
GPIO.setup(ventilateur_pin, GPIO.OUT) 

# La durée est reçue en tant qu'argument 
duree = int(sys.argv[1]) 

# Activation du ventilateur pendant la durée spécifiée 
GPIO.output(ventilateur_pin, GPIO.HIGH) 
time.sleep(duree) 
GPIO.output(ventilateur_pin, GPIO.LOW) 

# Nettoyage des pins GPIO 
GPIO.cleanup() 
