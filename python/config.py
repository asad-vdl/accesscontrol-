# ==========================================
# Smart Access Control Configuration
# ==========================================

# Laravel API URL
API_URL = "http://127.0.0.1:8000/api/access-check"

# Laravel Heartbeat API URL
HEARTBEAT_URL = "http://127.0.0.1:8000/api/device/heartbeat"



# Request Timeout (seconds)
REQUEST_TIMEOUT = 10

# Voice Settings
VOICE_ENABLED = True


# ==========================================
# Hardware Configuration
# ==========================================

# Relay Open Time (seconds)
RELAY_DELAY = 10

# Raspberry Pi GPIO Pins
RELAY_PIN = 17
GREEN_LED_PIN = 27
RED_LED_PIN = 22
BUZZER_PIN = 23
DOOR_SENSOR_PIN = 24

# Hardware Simulation
SIMULATION_MODE = True
