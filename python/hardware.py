
import time
from config import RELAY_DELAY, SIMULATION_MODE

def green_led_on():
    print("[GREEN LED] ON")


def green_led_off():
    print("[GREEN LED] OFF")


def red_led_on():
    print("[RED LED] ON")


def red_led_off():
    print("[RED LED] OFF")

def buzzer_success():
    print("[BUZZER] BEEP")


def buzzer_error():
    print("[BUZZER] BEEP BEEP")

def relay_on():

    if SIMULATION_MODE:

        print("[RELAY] ON")

    else:

        # Raspberry Pi GPIO Code
        pass

def relay_off():

    if SIMULATION_MODE:

        print("[RELAY] OFF")

    else:

        # Raspberry Pi GPIO Code
        pass


def door_open():
    print("[DOOR ] OPEN")


def door_close():
    print("[DOOR ] CLOSED")


def grant_access():

    green_led_on()

    buzzer_success()

    relay_on()

    door_open()

    print("Checking Door Sensor...")

    print("Door Closed Successfully")

    print("Waiting 3 seconds...")

    time.sleep(RELAY_DELAY)

    relay_off()

    door_close()

    green_led_off()

    print("System Ready\n")

def deny_access():

    red_led_on()

    buzzer_error()

    relay_off()

    print("Door LOCKED")

    red_led_off()

    print("System Ready\n")

