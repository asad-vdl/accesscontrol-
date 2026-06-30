from .status import update_status



def relay_on():

    update_status("relay", "ON")

    print("[SIMULATION] RELAY ON")



def relay_off():

    update_status("relay", "OFF")

    print("[SIMULATION] RELAY OFF")



def green_led_on():

    update_status("green_led", "ON")

    print("[SIMULATION] GREEN LED ON")



def green_led_off():

    update_status("green_led", "OFF")

    print("[SIMULATION] GREEN LED OFF")



def red_led_on():

    update_status("red_led", "ON")

    print("[SIMULATION] RED LED ON")



def red_led_off():

    update_status("red_led", "OFF")

    print("[SIMULATION] RED LED OFF")



def buzzer_ok():

    update_status("buzzer", "BEEP")

    print("[SIMULATION] BUZZER BEEP")



def buzzer_error():

    update_status("buzzer", "ERROR")

    print("[SIMULATION] BUZZER ERROR")



def door_open():

    update_status("door", "OPEN")

    print("[SIMULATION] DOOR OPEN")



def door_close():

    update_status("door", "CLOSED")

    print("[SIMULATION] DOOR CLOSE")



# MAGLOCK SIMULATION


def maglock_release():

    update_status("maglock", "RELEASED")

    print("[SIMULATION] MAGLOCK RELEASED")



def maglock_lock():

    update_status("maglock", "LOCKED")

    print("[SIMULATION] MAGLOCK LOCKED")