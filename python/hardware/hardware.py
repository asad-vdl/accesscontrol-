import platform
import time
from config import RELAY_DELAY


SYSTEM = platform.system()


if SYSTEM == "Linux":
    from . import raspberrypi as driver
else:
    from . import simulation as driver



def relay_on():
    driver.relay_on()


def relay_off():
    driver.relay_off()



def green_led_on():
    driver.green_led_on()


def green_led_off():
    driver.green_led_off()



def red_led_on():
    driver.red_led_on()


def red_led_off():
    driver.red_led_off()



def buzzer_success():
    driver.buzzer_ok()


def buzzer_error():
    driver.buzzer_error()



def door_open():
    driver.door_open()


def door_close():
    driver.door_close()



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