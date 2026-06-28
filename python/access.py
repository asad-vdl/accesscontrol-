from api import check_access
from voice import speak
from hardware.hardware import grant_access, deny_access


def process_access(credential_type, credential_value):

    result = check_access(credential_type, credential_value)

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


    return result