import threading

from access import process_access
from heartbeat import start_heartbeat
from hardware.status import get_status



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

        print("System Shutdown")

        break



    process_access("card", uid)


    print("\n========== HARDWARE STATUS ==========")

    print(get_status())

    print("====================================\n")