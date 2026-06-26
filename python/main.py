from api import check_access
from voice import speak

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

    elif result.get("status") == "denied":

        print("Access Denied")

        speak("You are not authorized")

    else:

        print(result.get("message"))

        speak("System error")