from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware

from hardware.status import get_status
from hardware.hardware import grant_access, deny_access
from hardware.events import get_events


app = FastAPI(
    title="Smart Access Control Hardware API",
    description="Hardware Controller API",
    version="1.0"
)

# =========================
# CORS (IMPORTANT)
# =========================
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)


# =========================
# BASIC ROUTES
# =========================

@app.get("/")
def home():
    return {
        "system": "Smart Access Control",
        "api_status": "running"
    }


@app.get("/hardware/status")
def hardware_status():
    return {
        "device": "Main Gate Reader",
        "hardware_status": get_status()
    }


@app.get("/hardware/events")
def hardware_events():
    return {
        "events": get_events()
    }


@app.post("/hardware/grant")
def access_granted():
    grant_access()
    return {
        "status": "success",
        "message": "Access Granted"
    }


@app.post("/hardware/deny")
def access_denied():
    deny_access()
    return {
        "status": "success",
        "message": "Access Denied"
    }