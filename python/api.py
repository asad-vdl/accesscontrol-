import requests

from config import (
    API_URL,
    REQUEST_TIMEOUT
)


def check_access(
    credential_type,
    credential_value,
    device_code,
    device_token
):

    headers = {

        "X-Device-Token": device_token,

        "Accept": "application/json",

        "Content-Type": "application/json"

    }

    data = {

        "device_code": device_code,

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


def get_devices(device_type=None):

    try:

        url = API_URL.replace(
            "/access-check",
            "/devices"
        )

        if device_type:

            url += f"?type={device_type}"

        response = requests.get(
            url,
            timeout=REQUEST_TIMEOUT
        )

        return response.json()

    except Exception:

        return []