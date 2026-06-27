import threading

from api import check_access
from voice import speak
from hardware.hardware import grant_access, deny_access
from heartbeat import start_heartbeat


# Start heartbeat in background
heartbeat_thread = threading.Thread(
    target=start_heartbeat,
    daemon=True
)

heartbeat_thread.start()


print("===================================")
print(" Smart Access Control System ")
print("===================================")


while True:

    uid = input("\nEnter Card UID (or 'exit'): ")

    if uid.lower() == "exit":
        break


    result = check_access("card", uid)

    print(result)


    if result.get("status") == "granted":

        user = result.get("user_name")

        message = f"Welcome {user}"

        print(message)

        speak(message)

        grant_access()


    elif result.get("status") == "denied":

        print("Access Denied")

        speak("You are not authorized")

        deny_access()


    else:

        print(result.get("message"))

        speak("System error")