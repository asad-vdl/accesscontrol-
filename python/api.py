import requests
from config import API_URL, DEVICE_TOKEN, REQUEST_TIMEOUT


def check_access(credential_type, credential_value):

    headers = {
    "X-Device-Token": DEVICE_TOKEN
}

    data = {
        "credential_type": credential_type,
        "credential_value": credential_value
    }

    try:

        response = requests.post(
            API_URL,
            headers=headers,
            json=data,
            timeout=REQUEST_TIMEOUT
        )

        return response.json()

    except Exception as e:

        return {
            "status": "error",
            "message": str(e)
        }