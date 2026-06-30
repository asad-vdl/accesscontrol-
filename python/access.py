import requests

from api import check_access
from voice import speak


HARDWARE_API = "http://127.0.0.1:8001"



def grant_hardware_access():

    try:

        response = requests.post(
            f"{HARDWARE_API}/hardware/grant"
        )

        return response.json()


    except Exception as e:

        return {
            "status": "error",
            "message": str(e)
        }



def deny_hardware_access():

    try:

        response = requests.post(
            f"{HARDWARE_API}/hardware/deny"
        )

        return response.json()


    except Exception as e:

        return {
            "status": "error",
            "message": str(e)
        }



def process_access(credential_type, credential_value):


    result = check_access(
        credential_type,
        credential_value
    )


    print(result)



    if result.get("status") == "granted":


        user = result.get("user_name")


        message = f"Welcome {user}"


        print(message)


        speak(message)


        hardware_result = grant_hardware_access()


        print(hardware_result)



    elif result.get("status") == "denied":


        print("Access Denied")


        speak("You are not authorized")


        hardware_result = deny_hardware_access()


        print(hardware_result)



    else:


        print(result.get("message"))


        speak("System error")



    return result