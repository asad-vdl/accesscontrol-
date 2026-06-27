import requests
import time
from config import HEARTBEAT_URL, DEVICE_TOKEN, DEVICE_CODE


def send_heartbeat():

    try:

        response = requests.post(
            HEARTBEAT_URL,
            json={
                "device_code": DEVICE_CODE
            },
            headers={
                "Authorization": f"Bearer {DEVICE_TOKEN}"
            }
        )

        print("[HEARTBEAT] Device Online")


    except Exception as e:

        print("Heartbeat Error:", e)



def start_heartbeat():

    while True:

        send_heartbeat()

        time.sleep(30)



if __name__ == "__main__":
    send_heartbeat()