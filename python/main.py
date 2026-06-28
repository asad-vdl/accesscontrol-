import threading

from access import process_access
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

    process_access("card", uid)