hardware_status = {

    "relay": "OFF",

    "maglock": "LOCKED",

    "door": "CLOSED",

    "green_led": "OFF",

    "red_led": "OFF",

    "buzzer": "OFF"

}



def update_status(component, value):

    hardware_status[component] = value



def get_status():

    return hardware_status