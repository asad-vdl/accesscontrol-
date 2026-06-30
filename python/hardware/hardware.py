import platform
import time
from config import RELAY_DELAY

from .status import update_status
from .events import add_event


SYSTEM = platform.system()

if SYSTEM == "Linux":
    from . import raspberrypi as driver
else:
    from . import simulation as driver


# =========================
# LOW LEVEL HARDWARE CALLS
# =========================

def relay_on():
    driver.relay_on()
    update_status("relay", "ON")


def relay_off():
    driver.relay_off()
    update_status("relay", "OFF")


def green_led_on():
    driver.green_led_on()
    update_status("green_led", "ON")


def green_led_off():
    driver.green_led_off()
    update_status("green_led", "OFF")


def red_led_on():
    driver.red_led_on()
    update_status("red_led", "ON")


def red_led_off():
    driver.red_led_off()
    update_status("red_led", "OFF")


def buzzer_success():
    driver.buzzer_ok()
    update_status("buzzer", "BEEP")


def buzzer_error():
    driver.buzzer_error()
    update_status("buzzer", "ERROR")


def door_open():
    driver.door_open()
    update_status("door", "OPEN")


def door_close():
    driver.door_close()
    update_status("door", "CLOSED")


def maglock_release():
    driver.maglock_release()
    update_status("maglock", "RELEASED")


def maglock_lock():
    driver.maglock_lock()
    update_status("maglock", "LOCKED")


# =========================
# ACCESS CONTROL LOGIC
# =========================

def grant_access():

    print("\n========== ACCESS GRANTED ==========\n")

    add_event("🟢 Access Granted")

    green_led_on()
    buzzer_success()
    relay_on()

    maglock_release()
    add_event("🧲 Maglock Released")

    door_open()
    add_event("🚪 Door Opened")

    print("Checking Door Sensor...")
    print("Person Passing Through Door...")

    time.sleep(RELAY_DELAY)

    print("Closing Door...")

    door_close()
    add_event("🚪 Door Closed")

    maglock_lock()
    relay_off()
    green_led_off()

    add_event("🔒 System Reset")

    print("\nSystem Ready\n")


def deny_access():

    print("\n========== ACCESS DENIED ==========\n")

    add_event("🔴 Access Denied")

    red_led_on()
    buzzer_error()
    maglock_lock()

    relay_off()
    red_led_off()

    print("\nSystem Ready\n")


def manual_open():

    relay_on()
    maglock_release()
    door_open()

    add_event("🚪 Manual Open")

    print("Manual Door Open")


def manual_close():

    relay_off()
    maglock_lock()
    door_close()

    add_event("🚪 Manual Close")

    print("Manual Door Close")